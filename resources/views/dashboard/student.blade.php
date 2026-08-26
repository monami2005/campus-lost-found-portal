@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Dashboard</li>
@endsection

@section('content')
<div class="container py-4">
    <!-- Welcome Banner -->
    <div class="glass-card p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden" data-aos="fade-down">
        <div class="position-absolute top-0 end-0 bg-primary opacity-10 rounded-circle" style="width: 250px; height: 250px; transform: translate(80px, -80px);"></div>
        <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
            <div class="col-md-8">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-2 rounded-pill">
                    <i class="fa-solid fa-graduation-cap me-1"></i>Student Workspace
                </span>
                <h1 class="fw-bold display-6 mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-muted-custom mb-0">Track your lost and found reports, view live campus statistics, and manage claim verification status.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('items.create') }}" class="btn btn-premium px-4 py-2 me-2">
                    <i class="fa-solid fa-plus me-2"></i>Report Item
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-premium-outline px-3 py-2">
                    <i class="fa-solid fa-user-gear"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Grid -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-danger h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Lost Items Reported</span>
                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger p-2">
                        <i class="fa-solid fa-circle-exclamation fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1">{{ $lostItems }}</h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-arrow-trend-up text-danger me-1"></i>Active lost listings</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-success h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Found Items Reported</span>
                    <div class="rounded-3 bg-success bg-opacity-10 text-success p-2">
                        <i class="fa-solid fa-hand-holding-heart fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1">{{ $foundItems }}</h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-check text-success me-1"></i>Safe in custody</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-info h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Reunited & Claimed</span>
                    <div class="rounded-3 bg-info bg-opacity-10 text-info p-2">
                        <i class="fa-solid fa-circle-check fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1">{{ $claimedItems }}</h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-hands-clapping text-info me-1"></i>Successful claims</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-warning h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Pending Verification</span>
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-2">
                        <i class="fa-solid fa-clock fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1">{{ $pendingItems }}</h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-spinner text-warning me-1"></i>Awaiting verification</div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Monthly Lost/Found Line Chart -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="glass-card p-4 rounded-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-chart-line text-primary me-2"></i>Monthly Reports Trend</h5>
                        <small class="text-muted-custom">Lost vs Found items reported over time</small>
                    </div>
                </div>
                <div style="height: 280px; position: relative;">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Category Distribution Doughnut Chart -->
        <div class="col-lg-4" data-aos="fade-left">
            <div class="glass-card p-4 rounded-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-chart-pie text-secondary me-2"></i>Category Breakdown</h5>
                        <small class="text-muted-custom">Items grouped by category</small>
                    </div>
                </div>
                <div style="height: 250px; position: relative;" class="d-flex align-items-center justify-content-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Card & Quick Actions & Feeds -->
    <div class="row g-4">
        <!-- Resolution Progress & Notifications -->
        <div class="col-lg-6" data-aos="fade-up">
            <!-- Progress Card -->
            <div class="glass-card p-4 rounded-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-bullseye text-success me-2"></i>Resolution Efficiency</h5>
                    <span class="badge bg-success-subtle text-success fw-bold px-3 py-1 rounded-pill">{{ $resolutionRate }}%</span>
                </div>
                <div class="progress mb-2" style="height: 12px; border-radius: 50px;">
                    <div class="progress-bar bg-gradient" role="progressbar" style="width: {{ $resolutionRate }}%; background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);" aria-valuenow="{{ $resolutionRate }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted-custom">Percentage of total reported items successfully reunited with verified owners.</small>
            </div>

            <!-- Notifications Feed -->
            <div class="glass-card p-4 rounded-4">
                <h5 class="fw-bold mb-3 pb-2 border-bottom border-card"><i class="fa-solid fa-bell text-warning me-2"></i>Recent Notifications</h5>
                @forelse($notifications as $notif)
                    <div class="p-3 rounded-3 bg-body-tertiary mb-2 border border-card d-flex align-items-start gap-3">
                        <i class="fa-solid fa-circle-info text-primary mt-1"></i>
                        <div>
                            <div class="fw-bold small">{{ $notif->title }}</div>
                            <div class="text-muted-custom small">{{ $notif->message }}</div>
                            <div class="text-muted small mt-1">{{ $notif->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted-custom small mb-0">No new notifications at this time.</p>
                @endforelse
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-card p-4 rounded-4 h-100">
                <h5 class="fw-bold mb-3 pb-2 border-bottom border-card"><i class="fa-solid fa-clock-rotate-left text-info me-2"></i>Recent Campus Activity</h5>
                <div class="timeline d-flex flex-column gap-3">
                    @forelse($recentActivities as $act)
                        <div class="p-3 rounded-3 bg-body-tertiary border border-card d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="fa-solid fa-bolt small"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $act->description }}</div>
                                    <div class="text-muted small">by {{ $act->user->name ?? 'System' }}</div>
                                </div>
                            </div>
                            <span class="text-muted small ms-2">{{ $act->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-muted-custom small mb-0">No recent activity recorded.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = @json($chartData);

        // 1. Monthly Trend Chart
        const ctxTrend = document.getElementById('monthlyTrendChart');
        if (ctxTrend) {
            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: chartData.months,
                    datasets: [
                        {
                            label: 'Lost Items',
                            data: chartData.monthlyLost,
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Found Items',
                            data: chartData.monthlyFound,
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // 2. Category Doughnut Chart
        const ctxCategory = document.getElementById('categoryChart');
        if (ctxCategory && chartData.categories.length > 0) {
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: chartData.categories,
                    datasets: [{
                        data: chartData.categoryCounts,
                        backgroundColor: [
                            '#2563eb', '#7c3aed', '#10b981', '#f59e0b', '#ef4444', '#06b6d4', '#8b5cf6', '#ec4899'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 12 } }
                    }
                }
            });
        }
    });
</script>
@endsection
