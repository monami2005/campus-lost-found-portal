@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6" data-aos="zoom-in">
            <div class="glass-card p-5 rounded-4 shadow-lg">
                <div class="display-1 fw-bold text-warning mb-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>500</div>
                <h3 class="fw-bold mb-3">Server Exception</h3>
                <p class="text-muted-custom mb-4">An unexpected system exception occurred on the campus server. Please try again shortly or contact portal administrators.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-premium px-4"><i class="fa-solid fa-house me-2"></i>Return Home</a>
                    <a href="{{ route('contact') }}" class="btn btn-premium-outline px-4"><i class="fa-solid fa-envelope me-2"></i>Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
