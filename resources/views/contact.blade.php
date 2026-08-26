@extends('layouts.app')

@section('title', 'Contact Support')

@section('breadcrumb')
    <li class="breadcrumb-item active text-primary" aria-current="page">Contact</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-8" data-aos="zoom-in">
            <div class="card glass-card border-0 p-4 shadow-lg">
                <div class="card-body">
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-3 rounded-pill">Get In Touch</span>
                    <h2 class="fw-bold mb-3">Contact the Campus Operations Team</h2>
                    <p class="text-muted-custom mb-4">
                        Have inquiries regarding listing verification, policy disputes, or technical support? Fill out the form below, and our administration staff will get back to you shortly.
                    </p>
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input name="name" class="form-control border-start-0 @error('name') is-invalid @enderror" placeholder="John Doe" value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input name="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="johndoe@campus.edu" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message Description</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" placeholder="Specify details regarding your listing or issue..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <button class="btn btn-premium w-100 mt-4 py-3"><i class="fa-solid fa-paper-plane me-2"></i>Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
