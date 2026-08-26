@extends('layouts.app')

@section('title', 'Submit New Item Report')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-decoration-none text-muted-custom">Listings</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">New Report</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9" data-aos="fade-up">
            <div class="glass-card p-4 p-md-5 rounded-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-card">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-file-circle-plus fs-3"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Report an Item</h2>
                        <p class="text-muted-custom mb-0">Fill in the details to submit a new lost or found listing.</p>
                    </div>
                </div>

                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Type Selector (Lost / Found) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom mb-2">Report Type <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-lost" value="lost" {{ old('type', 'lost') === 'lost' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-danger w-100 p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 fw-semibold" for="type-lost">
                                    <i class="fa-solid fa-circle-exclamation fs-5"></i> I Lost Something
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-found" value="found" {{ old('type') === 'found' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success w-100 p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 fw-semibold" for="type-found">
                                    <i class="fa-solid fa-hand-holding-heart fs-5"></i> I Found Something
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <!-- Title -->
                        <div class="col-md-8">
                            <label for="title" class="form-label fw-semibold text-muted-custom">Item Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="e.g. Blue Dell Laptop Bag, Silver iPhone 15" 
                                   value="{{ old('title') }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-md-4">
                            <label for="category_id" class="form-label fw-semibold text-muted-custom">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <label for="location" class="form-label fw-semibold text-muted-custom">Location <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="location" 
                                   id="location" 
                                   class="form-control @error('location') is-invalid @enderror" 
                                   placeholder="e.g. Central Library 2nd Floor, Science Auditorium" 
                                   value="{{ old('location') }}" 
                                   required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold text-muted-custom">Date Lost / Found <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date', date('Y-m-d')) }}" 
                                   required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-semibold text-muted-custom">Contact Email or Phone <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="contact" 
                                   id="contact" 
                                   class="form-control @error('contact') is-invalid @enderror" 
                                   placeholder="e.g. student@campus.edu or 01700-000000" 
                                   value="{{ old('contact', auth()->user()->email) }}" 
                                   required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Reward (Optional) -->
                        <div class="col-md-6">
                            <label for="reward" class="form-label fw-semibold text-muted-custom">Reward / Note (Optional)</label>
                            <input type="text" 
                                   name="reward" 
                                   id="reward" 
                                   class="form-control @error('reward') is-invalid @enderror" 
                                   placeholder="e.g. $20 reward or Treat at cafeteria" 
                                   value="{{ old('reward') }}">
                            @error('reward')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <input type="hidden" name="status" value="pending">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold text-muted-custom">Detailed Description <span class="text-danger">*</span></label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Describe distinguishing marks, color, serial numbers, or contents..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Drag & Drop Multi-Image Upload Zone -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom">Upload Photos (Drag & Drop Supported)</label>
                        
                        <div class="upload-dropzone" id="dropzone">
                            <i class="fa-solid fa-cloud-arrow-up text-primary display-5 mb-2"></i>
                            <h5 class="fw-bold mb-1">Drag & Drop photos here</h5>
                            <p class="text-muted-custom small mb-0">or click to browse from device (JPEG, PNG, WebP up to 3MB)</p>
                            <input type="file" name="images[]" id="file-input" class="d-none" multiple accept="image/jpeg,image/png,image/jpg,image/webp">
                        </div>

                        <!-- Live Preview Grid -->
                        <div class="upload-preview-grid" id="preview-grid"></div>
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-3 pt-3 border-top border-card">
                        <a href="{{ route('items.index') }}" class="btn btn-premium-outline px-4">Cancel</a>
                        <button type="submit" class="btn btn-premium px-5 py-2">
                            <i class="fa-solid fa-paper-plane me-2"></i>Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
