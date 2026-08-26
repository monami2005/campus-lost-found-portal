<?php $__env->startSection('title', 'Edit Report - ' . $item->title); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('items.index')); ?>" class="text-decoration-none text-muted-custom">Listings</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('items.show', $item)); ?>" class="text-decoration-none text-muted-custom"><?php echo e(Str::limit($item->title, 20)); ?></a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Edit</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                        <p class="text-muted-custom mb-0">Update information for "<?php echo e($item->title); ?>"</p>
                    </div>
                </div>

                <form action="<?php echo e(route('items.update', $item)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Type Selector -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom mb-2">Report Type <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-lost" value="lost" <?php echo e(old('type', $item->type) === 'lost' ? 'checked' : ''); ?> required>
                                <label class="btn btn-outline-danger w-100 p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 fw-semibold" for="type-lost">
                                    <i class="fa-solid fa-circle-exclamation fs-5"></i> Lost Item
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="type" id="type-found" value="found" <?php echo e(old('type', $item->type) === 'found' ? 'checked' : ''); ?>>
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
                                   class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('title', $item->title)); ?>" 
                                   required>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Category -->
                        <div class="col-md-4">
                            <label for="category_id" class="form-label fw-semibold text-muted-custom">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="" disabled>Select category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $item->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <label for="location" class="form-label fw-semibold text-muted-custom">Location <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="location" 
                                   id="location" 
                                   class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('location', $item->location)); ?>" 
                                   required>
                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold text-muted-custom">Date Reported <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('date', $item->date)); ?>" 
                                   required>
                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label for="status" class="form-label fw-semibold text-muted-custom">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="pending" <?php echo e(old('status', $item->status) === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="claimed" <?php echo e(old('status', $item->status) === 'claimed' ? 'selected' : ''); ?>>Claimed</option>
                                <option value="resolved" <?php echo e(old('status', $item->status) === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Contact -->
                        <div class="col-md-4">
                            <label for="contact" class="form-label fw-semibold text-muted-custom">Contact Email/Phone <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="contact" 
                                   id="contact" 
                                   class="form-control <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('contact', $item->contact)); ?>" 
                                   required>
                            <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Reward -->
                        <div class="col-md-4">
                            <label for="reward" class="form-label fw-semibold text-muted-custom">Reward (Optional)</label>
                            <input type="text" 
                                   name="reward" 
                                   id="reward" 
                                   class="form-control <?php $__errorArgs = ['reward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('reward', $item->reward)); ?>">
                            <?php $__errorArgs = ['reward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold text-muted-custom">Description <span class="text-danger">*</span></label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  required><?php echo e(old('description', $item->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Current Photo & Upload Zone -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted-custom">Current Photo(s)</label>
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <?php
                                $images = [];
                                if ($item->image) {
                                    if (str_starts_with($item->image, '[')) {
                                        $images = json_decode($item->image, true) ?? [];
                                    } else {
                                        $images = [$item->image];
                                    }
                                }
                            ?>
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="rounded-3 border" style="width: 80px; height: 80px; object-fit: cover;">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <a href="<?php echo e(route('items.show', $item)); ?>" class="btn btn-premium-outline px-4">Cancel</a>
                        <button type="submit" class="btn btn-premium px-5 py-2">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\items\edit.blade.php ENDPATH**/ ?>