@extends('layouts.app')

@section('title', '403 - Forbidden Access')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6" data-aos="zoom-in">
            <div class="glass-card p-5 rounded-4 shadow-lg">
                <div class="display-1 fw-bold text-danger mb-2"><i class="fa-solid fa-lock me-2"></i>403</div>
                <h3 class="fw-bold mb-3">Access Forbidden</h3>
                <p class="text-muted-custom mb-4">You do not have administrative permissions to view or execute actions on this portal resource.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-premium px-4"><i class="fa-solid fa-gauge me-2"></i>Go to Dashboard</a>
                    <a href="{{ route('home') }}" class="btn btn-premium-outline px-4"><i class="fa-solid fa-house me-2"></i>Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
