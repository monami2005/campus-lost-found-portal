@extends('layouts.app')

@section('title', 'Welcome to Campus Lost & Found Portal')

@section('content')
<!-- Hero Section -->
<div class="hero py-5 mb-5 position-relative overflow-hidden">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-3 rounded-pill">
                    <i class="fa-solid fa-circle-check me-1"></i>Secure · Fast · Campus Verified
                </span>
                <h1 class="display-4 fw-bold mb-4" style="line-height: 1.15;">
                    Reunite lost essentials <br>
                    <span class="text-gradient">with their owners.</span>
                </h1>
                <p class="lead text-muted-custom mb-4" style="font-size: 1.15rem;">
                    Campus Lost & Found helps students and staff report, locate, and verify misplaced items quickly through a secure, automated university network.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-premium btn-lg px-4"><i class="fa-solid fa-gauge me-2"></i>Go to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-premium btn-lg px-4"><i class="fa-solid fa-user-plus me-2"></i>Get Started</a>
                    @endauth
                    <a href="{{ route('items.index') }}" class="btn btn-premium-outline btn-lg px-4"><i class="fa-solid fa-magnifying-glass me-2"></i>Browse Listings</a>
                </div>
                
                <div class="mt-5 pt-3 d-flex gap-5 flex-wrap">
                    <div>
                        <h3 class="fw-bold mb-0 text-gradient">2,500+</h3>
                        <div class="text-muted-custom small fw-semibold">Resolved Items</div>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0 text-gradient">98.4%</h3>
                        <div class="text-muted-custom small fw-semibold">Success Match</div>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0 text-gradient">&lt; 24h</h3>
                        <div class="text-muted-custom small fw-semibold">Average Match Time</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5" data-aos="fade-left">
                <div class="glass-card p-4 rounded-4 position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 bg-primary opacity-10 rounded-circle" style="width: 150px; height: 150px; transform: translate(50px, -50px);"></div>
                    <h5 class="fw-bold mb-4"><i class="fa-solid fa-bullseye text-primary me-2"></i>Network Action Center</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 text-center">
                                <i class="fa-solid fa-magnifying-glass fs-3 mb-2"></i>
                                <div class="fw-semibold small">Smart Search</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10 text-center">
                                <i class="fa-solid fa-bell fs-3 mb-2"></i>
                                <div class="fw-semibold small">Live Claims</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-success bg-opacity-10 text-success border border-success border-opacity-10 text-center">
                                <i class="fa-solid fa-shield-halved fs-3 mb-2"></i>
                                <div class="fw-semibold small">Secure Verify</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-purple bg-opacity-10 text-secondary border border-purple border-opacity-10 text-center" style="--purple: #7c3aed;">
                                <i class="fa-solid fa-chart-line fs-3 mb-2"></i>
                                <div class="fw-semibold small">Live Statistics</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-2 rounded-pill">Platform Perks</span>
        <h2 class="fw-bold">Designed for Campus Ecosystems</h2>
        <p class="text-muted-custom">Advanced utilities providing students, staff, and admins a premium experience.</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card glass-card border-0 h-100 p-3">
                <div class="card-body">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mb-4" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-people-group fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Community First</h5>
                    <p class="text-muted-custom">Only verified university students and faculty can access listings and claim items, ensuring safety and authenticity.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card glass-card border-0 h-100 p-3">
                <div class="card-body">
                    <div class="rounded-3 bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center mb-4" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-images fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Rich Media Support</h5>
                    <p class="text-muted-custom">Upload multiple images with drag-and-drop actions. Showcases items clearly so owners can recognize them instantly.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card glass-card border-0 h-100 p-3">
                <div class="card-body">
                    <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mb-4" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-lock fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Rate Limited & Secure</h5>
                    <p class="text-muted-custom">Equipped with strict rate limits, authorization rules, and CSRF protection to safeguard database assets and user profiles.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Listings Section -->
<section class="container py-5">
    <div class="row g-4 align-items-center mb-5">
        <div class="col-md-8" data-aos="fade-right">
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-2 rounded-pill">Latest Reports</span>
            <h2 class="fw-bold mb-0">Recent Postings</h2>
            <p class="text-muted-custom mb-0">Browse through the most recently reported items on campus.</p>
        </div>
        <div class="col-md-4 text-md-end" data-aos="fade-left">
            <a href="{{ route('items.index') }}" class="btn btn-premium-outline">View All Listings<i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
    
    <div class="row g-4">
        @forelse($featuredItems as $item)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card glass-card border-0 h-100 overflow-hidden">
                    <div class="position-relative">
                        @php
                            $images = [];
                            if ($item->image) {
                                if (str_starts_with($item->image, '[')) {
                                    $images = json_decode($item->image, true) ?? [];
                                } else {
                                    $images = [$item->image];
                                }
                            }
                            $firstImg = !empty($images) ? $images[0] : 'items/placeholder.jpg';
                        @endphp
                        <img src="{{ asset('storage/' . $firstImg) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $item->title }}" loading="lazy">
                        <span class="position-absolute top-3 end-3 badge rounded-pill {{ $item->type === 'lost' ? 'bg-danger' : 'bg-success' }}" style="top: 1rem; right: 1rem;">
                            {{ ucfirst($item->type) }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-truncate mb-2">{{ $item->title }}</h5>
                        <p class="text-muted-custom small mb-3">{{ Str::limit($item->description, 80) }}</p>
                        
                        <div class="d-flex flex-column gap-2 mb-4">
                            <div class="small text-muted-custom d-flex align-items-center">
                                <i class="fa-solid fa-location-dot text-primary me-2" style="width: 15px;"></i>{{ $item->location }}
                            </div>
                            <div class="small text-muted-custom d-flex align-items-center">
                                <i class="fa-solid fa-calendar-days text-primary me-2" style="width: 15px;"></i>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                            </div>
                            <div class="small text-muted-custom d-flex align-items-center">
                                <i class="fa-solid fa-tag text-primary me-2" style="width: 15px;"></i>{{ $item->category ? $item->category->name : 'Unknown' }}
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top border-card">
                            <span class="badge {{ $item->status === 'pending' ? 'bg-warning text-dark' : ($item->status === 'claimed' ? 'bg-info text-white' : 'bg-secondary text-white') }} rounded-pill px-3 py-2 small">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('items.show', $item) }}" class="btn btn-premium-outline btn-sm px-3">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="glass-card p-5">
                    <i class="fa-solid fa-folder-open text-muted-custom fs-1 mb-3"></i>
                    <h5>No items reported yet</h5>
                    <p class="text-muted-custom">Get started by reporting a lost or found item from the dashboard.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection
