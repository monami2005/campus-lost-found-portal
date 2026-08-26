<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = $this->filterQuery($request)->paginate(12)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function searchAjax(Request $request)
    {
        if ($request->filled('suggest')) {
            $query = Item::query();
            if ($request->filled('q')) {
                $q = $request->q;
                $query->where('title', 'like', "%{$q}%")
                    ->orWhereHas('category', function ($catQuery) use ($q) {
                        $catQuery->where('name', 'like', "%{$q}%");
                    })
                    ->orWhere('location', 'like', "%{$q}%");
            }
            $suggestions = $query->with('category')->latest()->take(5)->get(['id', 'title', 'category_id', 'type', 'location']);
            return response()->json($suggestions);
        }

        $items = $this->filterQuery($request)->paginate(12)->withQueryString();
        return view('items.partials.items_grid', compact('items'))->render();
    }

    private function filterQuery(Request $request)
    {
        $query = Item::with('user')->latest();

        if ($request->filled('type') && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'claimed', 'resolved'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'oldest') {
                $query->reorder('created_at', 'asc');
            } elseif ($request->sort === 'newest') {
                $query->reorder('created_at', 'desc');
            }
        }

        return $query;
    }

    public function create()
    {
        $this->authorize('create', Item::class);
        $categories = \App\Models\Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:lost,found',
            'status' => 'required|in:pending,claimed,resolved',
            'reward' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imagePaths = [];

        // Handle multiple files if uploaded via images[]
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('items', 'public');
            }
        } elseif ($request->hasFile('image')) {
            $imagePaths[] = $request->file('image')->store('items', 'public');
        }

        if (!empty($imagePaths)) {
            $validated['image'] = count($imagePaths) === 1 ? $imagePaths[0] : json_encode($imagePaths);
        } else {
            $validated['image'] = 'items/placeholder.jpg';
        }

        $validated['user_id'] = Auth::id();
        $item = Item::create($validated);

        ActivityLog::log("Reported new {$item->type} item: {$item->title}");

        return redirect()->route('items.index')->with('success', 'Your item report has been submitted successfully.');
    }

    public function show(Item $item)
    {
        $item->load('user', 'claims.user');
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        $categories = \App\Models\Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:lost,found',
            'status' => 'required|in:pending,claimed,resolved',
            'reward' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('items', 'public');
            }
        } elseif ($request->hasFile('image')) {
            $imagePaths[] = $request->file('image')->store('items', 'public');
        }

        if (!empty($imagePaths)) {
            $validated['image'] = count($imagePaths) === 1 ? $imagePaths[0] : json_encode($imagePaths);
        }

        $item->update($validated);

        ActivityLog::log("Updated item listing: {$item->title}");

        return redirect()->route('items.show', $item)->with('success', 'Listing updated successfully.');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $title = $item->title;
        $item->delete();

        ActivityLog::log("Removed item listing: {$title}");

        return redirect()->route('items.index')->with('success', 'The item listing was removed.');
    }

    public function claim(Request $request, Item $item)
    {
        // 1. Prevent owner from claiming their own item
        if ($item->user_id === Auth::id()) {
            return back()->with('error', 'You cannot claim an item you reported.');
        }

        // 2. Prevent claiming if not pending
        if ($item->status !== 'pending') {
            return back()->with('error', 'This item is no longer available for claims.');
        }

        // 3. Prevent duplicate claims
        if (Claim::where('item_id', $item->id)->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already submitted a claim for this item.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Claim::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        Notification::create([
            'user_id' => $item->user_id,
            'title' => 'New claim request',
            'message' => 'A user requested to claim your item: ' . $item->title,
        ]);

        ActivityLog::log("Submitted claim for item: {$item->title}");

        return back()->with('success', 'Claim request sent successfully.');
    }

    public function adminAction(Request $request, Item $item)
    {
        if (!Auth::user()?->isAdmin()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:pending,claimed,resolved']);
        $item->update(['status' => $request->status]);

        ActivityLog::log("Admin updated status of item '{$item->title}' to '{$request->status}'");

        return back()->with('success', 'Item status updated.');
    }
}
