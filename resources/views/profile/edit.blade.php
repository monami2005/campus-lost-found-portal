@extends('layouts.app')

@section('title', 'Profile Settings')

@section('breadcrumb')
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Profile Settings</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row g-4 justify-content-center">
        <!-- Profile Details Card -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="glass-card p-4 p-md-5 rounded-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-card">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-user-gear fs-3"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Personal Profile</h3>
                        <p class="text-muted-custom small mb-0">Update your campus details and profile avatar.</p>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Avatar Preview & Upload -->
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <div class="position-relative">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle border border-3 border-primary" style="width: 90px; height: 90px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-3" style="width: 90px; height: 90px;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="form-label fw-semibold text-muted-custom mb-1">Change Profile Picture</label>
                            <input type="file" name="avatar" id="avatar" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                            <small class="text-muted-custom">Recommended square JPEG, PNG or WebP under 3MB.</small>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-muted-custom">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-muted-custom">Campus Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4">
                            <label for="phone" class="form-label fw-semibold text-muted-custom">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. +8801700000000" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="col-md-4">
                            <label for="department" class="form-label fw-semibold text-muted-custom">Department / Faculty</label>
                            <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror" placeholder="e.g. Computer Science" value="{{ old('department', $user->department) }}">
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="col-md-4">
                            <label for="semester" class="form-label fw-semibold text-muted-custom">Semester / Year</label>
                            <input type="text" name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" placeholder="e.g. 6th Semester" value="{{ old('semester', $user->semester) }}">
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <label for="bio" class="form-label fw-semibold text-muted-custom">Short Bio / Note</label>
                        <textarea name="bio" id="bio" rows="3" class="form-control @error('bio') is-invalid @enderror" placeholder="Share your campus role or contact preference...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-premium px-4 py-2">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security & Password Card -->
            <div class="glass-card p-4 p-md-5 rounded-4" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-card">
                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-key fs-3"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Change Password</h3>
                        <p class="text-muted-custom small mb-0">Ensure your account is using a secure password.</p>
                    </div>
                </div>

                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold text-muted-custom">Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold text-muted-custom">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold text-muted-custom">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2">
                            <i class="fa-solid fa-lock me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
