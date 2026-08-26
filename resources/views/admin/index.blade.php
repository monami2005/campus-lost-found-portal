@extends('layouts.app')

@section('title', 'Admin Overview')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-custom">Dashboard</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Admin Overview</li>
@endsection

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row align-items-center mb-4" data-aos="fade-down">
        <div class="col-md-8">
            <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2 mb-2 rounded-pill">
                <i class="fa-solid fa-shield-halved me-1"></i>Administrative Command
            </span>
            <h1 class="fw-bold display-6 mb-1">Admin Overview & Claims Verification</h1>
            <p class="text-muted-custom mb-0">Review pending verification claims, manage user authorizations, and process portal listings.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.users') }}" class="btn btn-premium-outline me-2"><i class="fa-solid fa-users me-2"></i>Users</a>
            <a href="{{ route('admin.items') }}" class="btn btn-premium"><i class="fa-solid fa-boxes-stacked me-2"></i>Listings</a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-card p-4 rounded-4 text-center">
                <div class="text-muted-custom fw-semibold small mb-1">Total Users</div>
                <h3 class="fw-bold text-gradient mb-0">{{ $stats['users'] }}</h3>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="glass-card p-4 rounded-4 text-center">
                <div class="text-muted-custom fw-semibold small mb-1">Total Items</div>
                <h3 class="fw-bold text-gradient mb-0">{{ $stats['items'] }}</h3>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="glass-card p-4 rounded-4 text-center">
                <div class="text-muted-custom fw-semibold small mb-1">Total Claims</div>
                <h3 class="fw-bold text-gradient mb-0">{{ $stats['claims'] }}</h3>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="glass-card p-4 rounded-4 text-center">
                <div class="text-muted-custom fw-semibold small mb-1">Pending Reports</div>
                <h3 class="fw-bold text-gradient mb-0">{{ $stats['pending'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Pending Claims Verification Table -->
    <div class="glass-card p-4 rounded-4 mb-4" data-aos="fade-up">
        <h5 class="fw-bold mb-3 pb-2 border-bottom border-card"><i class="fa-solid fa-clock-rotate-left text-warning me-2"></i>Pending Claim Requests</h5>
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Claimant</th>
                        <th>Verification Message</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingClaims as $claim)
                        <tr>
                            <td>
                                <a href="{{ route('items.show', $claim->item) }}" class="fw-bold text-primary text-decoration-none">
                                    {{ $claim->item->title }}
                                </a>
                                <div class="small text-muted-custom">{{ $claim->item->category ? $claim->item->category->name : 'Unknown' }} · {{ ucfirst($claim->item->type) }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold small">{{ $claim->user->name }}</div>
                                <div class="small text-muted-custom">{{ $claim->user->email }}</div>
                            </td>
                            <td style="max-width: 300px;">
                                <div class="small text-muted-custom text-truncate" title="{{ $claim->message }}">{{ $claim->message }}</div>
                            </td>
                            <td class="small text-muted-custom">{{ $claim->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.claims.update', $claim) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.claims.update', $claim) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill">Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted-custom py-4">No pending claims awaiting admin decision.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
