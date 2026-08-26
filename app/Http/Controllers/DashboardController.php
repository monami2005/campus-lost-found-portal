<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Key metrics
        $lostItems = Item::where('type', 'lost')->count();
        $foundItems = Item::where('type', 'found')->count();
        $claimedItems = Claim::where('status', 'approved')->count();
        $pendingItems = Item::where('status', 'pending')->count();
        $totalItems = Item::count();

        // Calculate resolution progress percentage
        $resolutionRate = $totalItems > 0 ? round(($claimedItems / $totalItems) * 100, 1) : 0;

        // Recent items & activities
        $recentItems = Item::with('user')->latest()->take(6)->get();
        $recentActivities = ActivityLog::with('user')->latest()->take(6)->get();
        $notifications = Notification::where('user_id', $user->id)->latest()->take(5)->get();

        // Category breakdown for Doughnut Chart
        $categoriesData = Item::with('category')
            ->select('category_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->category ? $item->category->name : 'Unknown' => $item->total];
            })
            ->toArray();

        // Monthly trends for Line Chart (Last 6 Months)
        $months = [];
        $monthlyLost = [];
        $monthlyFound = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabel = $date->format('M Y');
            $months[] = $monthLabel;

            $monthlyLost[] = Item::where('type', 'lost')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $monthlyFound[] = Item::where('type', 'found')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Claim Statistics
        $claimStats = [
            'pending' => Claim::where('status', 'pending')->count(),
            'approved' => Claim::where('status', 'approved')->count(),
            'rejected' => Claim::where('status', 'rejected')->count(),
        ];

        $chartData = [
            'months' => $months,
            'monthlyLost' => $monthlyLost,
            'monthlyFound' => $monthlyFound,
            'categories' => array_keys($categoriesData),
            'categoryCounts' => array_values($categoriesData),
            'claimStats' => array_values($claimStats),
        ];

        if ($user->isAdmin()) {
            $stats = [
                'users' => User::count(),
                'lost' => $lostItems,
                'found' => $foundItems,
                'claims' => Claim::count(),
                'resolutionRate' => $resolutionRate,
            ];
            $latestUsers = User::latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'stats',
                'recentItems',
                'notifications',
                'recentActivities',
                'chartData',
                'latestUsers'
            ));
        }

        return view('dashboard.student', compact(
            'lostItems',
            'foundItems',
            'claimedItems',
            'pendingItems',
            'recentItems',
            'notifications',
            'recentActivities',
            'resolutionRate',
            'chartData'
        ));
    }
}
