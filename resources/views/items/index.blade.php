@extends('layouts.app')

@section('title', 'Browse Campus Lost & Found Listings')

@section('breadcrumb')
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Listings</li>
@endsection

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row align-items-center mb-4" data-aos="fade-down">
        <div class="col-md-8">
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-2 rounded-pill">
                <i class="fa-solid fa-list me-1"></i>Active Campus Directory
            </span>
            <h1 class="fw-bold display-6 mb-1">Lost & Found Listings</h1>
            <p class="text-muted-custom mb-0">Search, filter, and track reported items across university departments.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            @auth
                <a href="{{ route('items.create') }}" class="btn btn-premium px-4 py-2">
                    <i class="fa-solid fa-plus me-2"></i>Submit New Report
                </a>
            @endauth
        </div>
    </div>

    <!-- Filter & Listings Row -->
    <div class="row g-4">
        <!-- Sidebar Filter Form -->
        <div class="col-lg-3" data-aos="fade-right">
            <div class="glass-card p-4 rounded-4 position-sticky" style="top: 100px;">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-card">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-sliders text-primary me-2"></i>Filter Items</h5>
                    <a href="{{ route('items.index') }}" class="text-decoration-none small text-muted-custom hover-primary">Clear</a>
                </div>

                <form id="filter-form" action="{{ route('items.index') }}" method="GET">
                    <!-- Search Input with Live Suggestions Dropdown -->
                    <div class="mb-3 position-relative">
                        <label class="form-label small fw-semibold text-muted-custom">Keyword Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" 
                                   id="ajax-search-input" 
                                   name="search" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Search items, locations..." 
                                   value="{{ request('search') }}"
                                   autocomplete="off">
                        </div>
                        <div id="search-suggestions" class="search-suggestions-container"></div>
                    </div>

                    <!-- Type Filter -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted-custom">Report Type</label>
                        <select name="type" class="form-select">
                            <option value="">All Types (Lost & Found)</option>
                            <option value="lost" {{ request('type') === 'lost' ? 'selected' : '' }}>Lost Items</option>
                            <option value="found" {{ request('type') === 'found' ? 'selected' : '' }}>Found Items</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted-custom">Category</label>
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted-custom">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="claimed" {{ request('status') === 'claimed' ? 'selected' : '' }}>Claimed</option>
                            <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <!-- Location Input -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted-custom">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. Library, Cafe, Block C" value="{{ request('location') }}">
                    </div>

                    <!-- Date Filter -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted-custom">Date Reported</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>

                    <!-- Sort Order -->
                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted-custom">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-premium w-100 py-2">
                        <i class="fa-solid fa-filter me-2"></i>Apply Filters
                    </button>
                </form>
            </div>
        </div>

        <!-- Dynamic Listings Grid Container -->
        <div class="col-lg-9">
            <div id="listings-grid">
                @include('items.partials.items_grid')
            </div>
        </div>
    </div>
</div>
@endsection
