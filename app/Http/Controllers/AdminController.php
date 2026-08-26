<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $stats = [
            'users' => User::count(),
            'items' => Item::count(),
            'claims' => Claim::count(),
            'pending' => Item::where('status', 'pending')->count(),
            'claimed' => Item::where('status', 'claimed')->count(),
            'resolved' => Item::where('status', 'resolved')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentItems = Item::with('user')->latest()->take(8)->get();
        $pendingClaims = Claim::with('item', 'user')->where('status', 'pending')->latest()->take(8)->get();
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('admin.index', compact('stats', 'recentUsers', 'recentItems', 'pendingClaims', 'recentLogs'));
    }

    public function users(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();
        return view('admin.users', compact('users'));
    }

    public function items(Request $request)
    {
        $query = Item::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(15)->withQueryString();
        return view('admin.items', compact('items'));
    }

    public function suspend(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Administrator accounts cannot be suspended.');
        }

        $user->update(['status' => 'suspended']);
        ActivityLog::log("Suspended user: {$user->email}");

        return back()->with('success', "User account {$user->name} has been suspended.");
    }

    public function restore(User $user)
    {
        $user->update(['status' => 'active']);
        ActivityLog::log("Restored user: {$user->email}");

        return back()->with('success', "User account {$user->name} has been restored.");
    }

    public function deleteItem(Item $item)
    {
        $title = $item->title;
        $item->delete();
        ActivityLog::log("Admin deleted item: {$title}");

        return back()->with('success', "Item '{$title}' was deleted successfully.");
    }

    public function claimDecision(Request $request, Claim $claim)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $claim->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $claim->item->update(['status' => 'claimed']);
        }

        Notification::create([
            'user_id' => $claim->user_id,
            'title' => 'Claim Status Update',
            'message' => "Your claim request for '{$claim->item->title}' was {$request->status}.",
        ]);

        ActivityLog::log("Admin set claim #{$claim->id} to {$request->status}");

        return back()->with('success', 'Claim decision updated.');
    }
}
