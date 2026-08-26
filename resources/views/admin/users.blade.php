@extends('layouts.app')

@section('title', 'Manage Users - Admin Console')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-decoration-none text-muted-custom">Admin</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Users</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="fw-bold display-6 mb-1">User Management</h1>
            <p class="text-muted-custom mb-0">View all registered students, inspect departments, and manage access roles.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="btn btn-premium-outline">Back to Overview</a>
    </div>

    <div class="glass-card p-4 rounded-4" data-aos="fade-up">
        <!-- Search bar -->
        <form action="{{ route('admin.users') }}" method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, email, department..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-premium px-4">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th>User Details</th>
                        <th>Department & Semester</th>
                        <th>Contact Phone</th>
                        <th>Role / Status</th>
                        <th>Joined Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <div class="small text-muted-custom">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="small">
                                <div>{{ $user->department ?? 'N/A' }}</div>
                                <div class="text-muted-custom">{{ $user->semester ?? 'N/A' }}</div>
                            </td>
                            <td class="small">{{ $user->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->status === 'suspended' ? 'bg-secondary' : 'bg-primary') }} rounded-pill px-3 py-1">
                                    {{ $user->status === 'suspended' ? 'Suspended' : ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="small text-muted-custom">{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                @if(!$user->isAdmin())
                                    @if($user->status === 'suspended')
                                        <form action="{{ route('admin.users.restore', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">Restore</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.suspend', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Suspend</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-muted small fw-semibold">Super Admin</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
