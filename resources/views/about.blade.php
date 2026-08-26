@extends('layouts.app')

@section('title', 'About Us')

@section('breadcrumb')
    <li class="breadcrumb-item active text-primary" aria-current="page">About</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6" data-aos="fade-right">
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-3 rounded-pill">Our Core Mission</span>
            <h2 class="fw-bold mb-4">Connecting Campus Essentials</h2>
            <p class="text-muted-custom lead">
                The Campus Lost & Found Portal is an automated web utility built specifically for college networks to facilitate swift recovery of misplaced property.
            </p>
            <p class="text-muted-custom mb-4">
                Misplacing key items like laptop chargers, bags, books, and identification cards can cause significant disruption during busy academic semesters. Our application acts as a centralized dashboard to report found items, catalog details, request claim permissions, and verify ownership in a transparent environment.
            </p>
            <div class="d-flex gap-3">
                <a href="{{ route('items.index') }}" class="btn btn-premium">Search Listings</a>
                <a href="{{ route('contact') }}" class="btn btn-premium-outline">Contact Support</a>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <div class="card glass-card border-0 p-4">
                <h5 class="fw-bold mb-4 text-gradient"><i class="fa-solid fa-list-check me-2"></i>Core Portal Features</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem; flex-shrink: 0;">
                            <i class="fa-solid fa-user-lock"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Secure Sign-On</h6>
                            <p class="text-muted-custom small mb-0">Role-based controls separating students and operational admins.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem; flex-shrink: 0;">
                            <i class="fa-solid fa-magnifying-glass-chart"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Instant Filters & suggestions</h6>
                            <p class="text-muted-custom small mb-0">Locate listings instantly filtering categories, dates, and spots.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem; flex-shrink: 0;">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Dynamic Analytics Panel</h6>
                            <p class="text-muted-custom small mb-0">Visualizes claim matching success rates and monthly categories.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 text-center mt-5">
        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
            <div class="card glass-card border-0 p-4">
                <h3 class="fw-bold text-gradient mb-1">100%</h3>
                <div class="text-muted small">CSRF Protection</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
            <div class="card glass-card border-0 p-4">
                <h3 class="fw-bold text-gradient mb-1">128-bit</h3>
                <div class="text-muted small">Pass Encryption</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
            <div class="card glass-card border-0 p-4">
                <h3 class="fw-bold text-gradient mb-1">AJAX</h3>
                <div class="text-muted small">Autocomplete API</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
            <div class="card glass-card border-0 p-4">
                <h3 class="fw-bold text-gradient mb-1">V2</h3>
                <div class="text-muted small">Breeze Auth</div>
            </div>
        </div>
    </div>
</div>
@endsection
