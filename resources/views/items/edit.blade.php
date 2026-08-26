@extends('layouts.app')

@section('title', 'Edit Report - ' . $item->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-decoration-none text-muted-custom">Listings</a></li>
    <li class="breadcrumb-item"><a href="{{ route('items.show', $item) }}" class="text-decoration-none text-muted-custom">{{ Str::limit($item->title, 20) }}</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9" data-aos="fade-up">
            <div class="glass-card p-4 p-md-5 rounded-4">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-card">
                    <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 3.5rem; height: 3.5rem;">
                        <i class="fa-solid fa-pen-to-square fs-3"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Edit Report</h2>
                        <p class="text-muted-custom mb-0">Update information for "{{ $item->title }}"</p>
                    </div>
                </div>

                <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Type Selector -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom mb-2">Report Type <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-lost" value="lost" {{ old('type', $item->type) === 'lost' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-danger w-100 p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 fw-semibold" for="type-lost">
                                    <i class="fa-solid fa-circle-exclamation fs-5"></i> Lost Item
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-found" value="found" {{ old('type', $item->type) === 'found' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success w-100 p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 fw-semibold" for="type-found">
                                    <i class="fa-solid fa-hand-holding-heart fs-5"></i> Found Item
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
                                   value="{{ old('title', $item->title) }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-md-4">
                            <label for="category_id" class="form-label fw-semibold text-muted-custom">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled>Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                                   value="{{ old('location', $item->location) }}" 
                                   required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold text-muted-custom">Date Reported <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date', $item->date) }}" 
                                   required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label for="status" class="form-label fw-semibold text-muted-custom">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $item->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="claimed" {{ old('status', $item->status) === 'claimed' ? 'selected' : '' }}>Claimed</option>
                                <option value="resolved" {{ old('status', $item->status) === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div class="col-md-4">
                            <label for="contact" class="form-label fw-semibold text-muted-custom">Contact Email/Phone <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="contact" 
                                   id="contact" 
                                   class="form-control @error('contact') is-invalid @enderror" 
                                   value="{{ old('contact', $item->contact) }}" 
                                   required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Reward -->
                        <div class="col-md-4">
                            <label for="reward" class="form-label fw-semibold text-muted-custom">Reward (Optional)</label>
                            <input type="text" 
                                   name="reward" 
                                   id="reward" 
                                   class="form-control @error('reward') is-invalid @enderror" 
                                   value="{{ old('reward', $item->reward) }}">
                            @error('reward')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold text-muted-custom">Description <span class="text-danger">*</span></label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  required>{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Photo & Upload Zone -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom">Current Photo(s)</label>
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            @php
                                $images = [];
                                if ($item->image) {
                                    if (str_starts_with($item->image, '[')) {
                                        $images = json_decode($item->image, true) ?? [];
                                    } else {
                                        $images = [$item->image];
                                    }
                                }
                            @endphp
                            @foreach($images as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="rounded-3 border" style="width: 80px; height: 80px; object-fit: cover;">
                            @endforeach
                        </div>

                        <label class="form-label fw-semibold text-muted-custom">Replace / Add New Photos</label>
                        <div class="upload-dropzone" id="dropzone">
                            <i class="fa-solid fa-cloud-arrow-up text-primary display-5 mb-2"></i>
                            <h5 class="fw-bold mb-1">Drag & Drop new photos</h5>
                            <p class="text-muted-custom small mb-0">or click to browse from device</p>
                            <input type="file" name="images[]" id="file-input" class="d-none" multiple accept="image/jpeg,image/png,image/jpg,image/webp">
                        </div>
                        <div class="upload-preview-grid" id="preview-grid"></div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 pt-3 border-top border-card">
                        <a href="{{ route('items.show', $item) }}" class="btn btn-premium-outline px-4">Cancel</a>
                        <button type="submit" class="btn btn-premium px-5 py-2">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
