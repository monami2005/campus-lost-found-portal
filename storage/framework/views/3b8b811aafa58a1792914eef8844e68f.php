<?php $__env->startSection('title', $item->title . ' - Details'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('items.index')); ?>" class="text-decoration-none text-muted-custom">Listings</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page"><?php echo e(Str::limit($item->title, 25)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row g-4">
        <!-- Left Column: Photos Gallery & Details -->
        <div class="col-lg-8" data-aos="fade-right">
            <!-- Gallery & Info Card -->
            <div class="glass-card p-4 p-md-5 rounded-4 mb-4">
                <?php
                    $images = [];
                    if ($item->image) {
                        if (str_starts_with($item->image, '[')) {
                            $images = json_decode($item->image, true) ?? [];
                        } else {
                            $images = [$item->image];
                        }
                    }
                    if (empty($images)) {
                        $images = ['items/placeholder.jpg'];
                    }
                ?>

                <!-- Gallery Carousel / Display -->
                <div class="mb-4 position-relative overflow-hidden rounded-4 shadow-sm">
                    <div id="itemGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                        <?php if(count($images) > 1): ?>
                            <div class="carousel-indicators">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" data-bs-target="#itemGalleryCarousel" data-bs-slide-to="<?php echo e($idx); ?>" class="<?php echo e($idx === 0 ? 'active' : ''); ?>"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($idx === 0 ? 'active' : ''); ?>">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" 
                                         class="d-block w-100" 
                                         style="max-height: 420px; object-fit: cover;" 
                                         alt="<?php echo e($item->title); ?>"
                                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?auto=format&fit=crop&w=800&q=80';">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($images) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#itemGalleryCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#itemGalleryCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Badges Row -->
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge rounded-pill px-3 py-2 fw-semibold fs-6 <?php echo e($item->type === 'lost' ? 'bg-danger text-white' : 'bg-success text-white'); ?>">
                        <i class="fa-solid <?php echo e($item->type === 'lost' ? 'fa-circle-exclamation' : 'fa-hand-holding-heart'); ?> me-1"></i>
                        <?php echo e(ucfirst($item->type)); ?> Item
                    </span>

                    <span class="badge rounded-pill px-3 py-2 fw-semibold fs-6 <?php echo e($item->status === 'pending' ? 'bg-warning text-dark' : ($item->status === 'claimed' ? 'bg-info text-white' : 'bg-secondary text-white')); ?>">
                        <i class="fa-solid fa-circle me-1" style="font-size: 0.5rem;"></i>
                        Status: <?php echo e(ucfirst($item->status)); ?>

                    </span>

                    <?php if($item->reward): ?>
                        <span class="badge bg-purple bg-opacity-20 text-secondary border border-purple border-opacity-20 rounded-pill px-3 py-2 fw-semibold fs-6">
                            <i class="fa-solid fa-gift me-1"></i>Reward: <?php echo e($item->reward); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <!-- Title & Meta -->
                <h1 class="fw-bold display-6 mb-3"><?php echo e($item->title); ?></h1>
                
                <div class="row g-3 mb-4 p-3 rounded-4 bg-body-tertiary border border-card">
                    <div class="col-sm-4">
                        <div class="small text-muted-custom">Category</div>
                        <div class="fw-semibold"><i class="fa-solid fa-tag text-primary me-2"></i><?php echo e($item->category ? $item->category->name : 'Unknown'); ?></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="small text-muted-custom">Location</div>
                        <div class="fw-semibold"><i class="fa-solid fa-location-dot text-primary me-2"></i><?php echo e($item->location); ?></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="small text-muted-custom">Date Reported</div>
                        <div class="fw-semibold"><i class="fa-solid fa-calendar-days text-primary me-2"></i><?php echo e(\Carbon\Carbon::parse($item->date)->format('M d, Y')); ?></div>
                    </div>
                </div>

                <!-- Description -->
                <h5 class="fw-bold mb-2">Description</h5>
                <p class="text-secondary leading-relaxed mb-4" style="white-space: pre-line; font-size: 1.05rem;">
                    <?php echo e($item->description); ?>

                </p>

                <!-- Admin Action Row -->
                <?php if(auth()->check() && auth()->user()->isAdmin()): ?>
                    <div class="p-3 rounded-4 bg-danger bg-opacity-10 border border-danger border-opacity-20 mb-4">
                        <h6 class="fw-bold text-danger mb-2"><i class="fa-solid fa-shield-halved me-2"></i>Administrative Controls</h6>
                        <form action="<?php echo e(route('items.admin-action', $item)); ?>" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                            <?php echo csrf_field(); ?>
                            <span class="small fw-semibold text-muted-custom">Update Status:</span>
                            <select name="status" class="form-select form-select-sm w-auto">
                                <option value="pending" <?php echo e($item->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="claimed" <?php echo e($item->status === 'claimed' ? 'selected' : ''); ?>>Claimed</option>
                                <option value="resolved" <?php echo e($item->status === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                            </select>
                            <button type="submit" class="btn btn-danger btn-sm px-3">Update Status</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Edit / Delete Controls for Owner or Admin -->
                <?php if(auth()->check() && (auth()->id() === $item->user_id || auth()->user()->isAdmin())): ?>
                    <div class="d-flex gap-3 pt-3 border-top border-card">
                        <a href="<?php echo e(route('items.edit', $item)); ?>" class="btn btn-premium-outline px-4">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Listing
                        </a>
                        
                        <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST" class="delete-confirm-form" data-message="Are you sure you want to permanently delete this listing?">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger rounded-pill px-4">
                                <i class="fa-solid fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Claim Requests History List (Visible to Reporter or Admin) -->
            <?php if(auth()->check() && (auth()->id() === $item->user_id || auth()->user()->isAdmin())): ?>
                <div class="glass-card p-4 rounded-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-clipboard-list text-primary me-2"></i>Claim Requests (<?php echo e($item->claims->count()); ?>)</h5>
                    
                    <?php $__empty_1 = true; $__currentLoopData = $item->claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-3 rounded-3 bg-body-tertiary mb-3 border border-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="fw-semibold text-primary d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-user-circle"></i>
                                    <?php echo e($claim->user->name ?? 'Student'); ?>

                                    <span class="text-muted small">(<?php echo e($claim->created_at->diffForHumans()); ?>)</span>
                                </div>
                                <span class="badge <?php echo e($claim->status === 'pending' ? 'bg-warning text-dark' : ($claim->status === 'approved' ? 'bg-success text-white' : 'bg-danger text-white')); ?> rounded-pill px-3 py-1">
                                    <?php echo e(ucfirst($claim->status)); ?>

                                </span>
                            </div>
                            <p class="mb-0 text-muted-custom small"><?php echo e($claim->message); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted-custom small mb-0">No claim requests have been filed for this item yet.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column: Reporter Card & Claim Form -->
        <div class="col-lg-4" data-aos="fade-left">
            <!-- Reporter Info Card -->
            <div class="glass-card p-4 rounded-4 mb-4">
                <h5 class="fw-bold mb-3 pb-2 border-bottom border-card"><i class="fa-solid fa-address-card text-primary me-2"></i>Reporter Details</h5>
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <?php if($item->user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $item->user->avatar)); ?>" alt="Avatar" class="rounded-circle border border-2 border-primary" style="width: 50px; height: 50px; object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 50px; height: 50px;">
                            <?php echo e(strtoupper(substr($item->user->name ?? 'User', 0, 2))); ?>

                        </div>
                    <?php endif; ?>
                    <div>
                        <h6 class="fw-bold mb-0"><?php echo e($item->user->name ?? 'Campus Member'); ?></h6>
                        <small class="text-muted-custom"><?php echo e($item->user->department ?? 'University Student'); ?></small>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 small text-muted-custom">
                    <div><i class="fa-solid fa-envelope me-2 text-primary"></i><?php echo e($item->contact); ?></div>
                    <?php if($item->user->phone): ?>
                        <div><i class="fa-solid fa-phone me-2 text-primary"></i><?php echo e($item->user->phone); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Submit Claim Card -->
            <?php if(auth()->guard()->check()): ?>
                <?php
                    $hasClaimed = \App\Models\Claim::where('item_id', $item->id)->where('user_id', auth()->id())->exists();
                ?>
                <?php if(auth()->id() !== $item->user_id && $hasClaimed): ?>
                    <div class="alert alert-success rounded-4 glass-card border-0 mb-0 position-sticky" style="top: 100px;">
                        <h6 class="fw-bold mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i>Claim request sent successfully.</h6>
                        <p class="mb-0 text-muted-custom small">We will notify you once the owner reviews your claim.</p>
                    </div>
                <?php elseif(auth()->id() !== $item->user_id && $item->status === 'pending'): ?>
                    <div class="glass-card p-4 rounded-4 position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-2"><i class="fa-solid fa-hand-holding-hand text-success me-2"></i>Claim This Item</h5>
                        <p class="text-muted-custom small mb-3">If this item belongs to you or you have information regarding it, submit verification message to the owner.</p>

                        <form action="<?php echo e(route('items.claim', $item)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="message" class="form-label small fw-semibold text-muted-custom">Verification Details <span class="text-danger">*</span></label>
                                <textarea name="message" 
                                          id="message" 
                                          rows="4" 
                                          class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          placeholder="Provide proof of ownership, unique markings, location lost, or serial number..." 
                                          required></textarea>
                                <?php $__errorArgs = ['message'];
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

                            <button type="submit" class="btn btn-premium w-100 py-2">
                                <i class="fa-solid fa-paper-plane me-2"></i>Submit Claim Request
                            </button>
                        </form>
                    </div>
                <?php elseif(auth()->id() === $item->user_id): ?>
                    <div class="alert alert-info rounded-4 glass-card border-0 mb-0">
                        <i class="fa-solid fa-info-circle me-2"></i>You are the reporter of this item.
                    </div>
                <?php elseif($item->status !== 'pending'): ?>
                    <div class="alert alert-warning rounded-4 glass-card border-0 mb-0">
                        <i class="fa-solid fa-lock me-2"></i>This item is marked as <strong><?php echo e($item->status); ?></strong>.
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="glass-card p-4 rounded-4 text-center">
                    <i class="fa-solid fa-lock text-primary display-6 mb-3"></i>
                    <h6 class="fw-bold">Login to Claim</h6>
                    <p class="text-muted-custom small mb-3">You must be logged in with your campus account to file a claim.</p>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-premium btn-sm px-4">Log In Now</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\items\show.blade.php ENDPATH**/ ?>