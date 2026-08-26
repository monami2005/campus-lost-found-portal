<div class="row g-4">
    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 40); ?>">
            <div class="card glass-card interactive border-0 h-100 overflow-hidden d-flex flex-column">
                <div class="position-relative">
                    <?php
                        $images = [];
                        if ($item->image) {
                            if (str_starts_with($item->image, '[')) {
                                $images = json_decode($item->image, true) ?? [];
                            } else {
                                $images = [$item->image];
                            }
                        }
                        $firstImg = !empty($images) ? $images[0] : 'items/placeholder.jpg';
                    ?>
                    
                    <img src="<?php echo e(asset('storage/' . $firstImg)); ?>" 
                         class="card-img-top" 
                         style="height: 220px; object-fit: cover;" 
                         alt="<?php echo e($item->title); ?>" 
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?auto=format&fit=crop&w=600&q=80';">
                         
                    <span class="position-absolute top-3 end-3 badge rounded-pill px-3 py-2 fw-semibold shadow-sm <?php echo e($item->type === 'lost' ? 'bg-danger text-white' : 'bg-success text-white'); ?>" style="top: 1rem; right: 1rem;">
                        <i class="fa-solid <?php echo e($item->type === 'lost' ? 'fa-circle-exclamation' : 'fa-hand-holding-heart'); ?> me-1"></i>
                        <?php echo e(ucfirst($item->type)); ?>

                    </span>

                    <?php if(count($images) > 1): ?>
                        <span class="position-absolute bottom-3 start-3 badge bg-dark bg-opacity-75 text-white rounded-pill px-2 py-1 small" style="bottom: 0.75rem; left: 0.75rem;">
                            <i class="fa-solid fa-images me-1"></i>+<?php echo e(count($images) - 1); ?> photos
                        </span>
                    <?php endif; ?>
                </div>

                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-truncate mb-0 me-2" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></h5>
                    </div>

                    <p class="text-muted-custom small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        <?php echo e($item->description); ?>

                    </p>
                    
                    <div class="d-flex flex-column gap-2 mb-4">
                        <div class="small text-muted-custom d-flex align-items-center">
                            <i class="fa-solid fa-location-dot me-2 text-primary" style="width: 16px;"></i>
                            <span class="text-truncate"><?php echo e($item->location); ?></span>
                        </div>
                        <div class="small text-muted-custom d-flex align-items-center">
                            <i class="fa-solid fa-calendar-days me-2 text-primary" style="width: 16px;"></i>
                            <span><?php echo e(\Carbon\Carbon::parse($item->date)->format('F d, Y')); ?></span>
                        </div>
                        <div class="small text-muted-custom d-flex align-items-center">
                            <i class="fa-solid fa-tag me-2 text-primary" style="width: 16px;"></i>
                            <span><?php echo e($item->category ? $item->category->name : 'Unknown'); ?></span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-card mt-auto">
                        <span class="badge rounded-pill px-3 py-2 small fw-semibold <?php echo e($item->status === 'pending' ? 'bg-warning text-dark' : ($item->status === 'claimed' ? 'bg-info text-white' : 'bg-secondary text-white')); ?>">
                            <i class="fa-solid fa-circle me-1" style="font-size: 0.5rem;"></i>
                            <?php echo e(ucfirst($item->status)); ?>

                        </span>
                        
                        <a href="<?php echo e(route('items.show', $item)); ?>" class="btn btn-premium-outline btn-sm px-3">
                            Details <i class="fa-solid fa-arrow-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 py-5 text-center" data-aos="fade-up">
            <div class="glass-card p-5 max-w-lg mx-auto rounded-4">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 4.5rem; height: 4.5rem;">
                    <i class="fa-solid fa-magnifying-glass-minus fs-1"></i>
                </div>
                <h4 class="fw-bold mb-2">No items found</h4>
                <p class="text-muted-custom mb-4">We couldn't find any reports matching your current search parameters. Try adjusting your filters or search term.</p>
                <a href="<?php echo e(route('items.index')); ?>" class="btn btn-premium btn-sm px-4">
                    <i class="fa-solid fa-arrows-rotate me-2"></i>Reset All Filters
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Styled Pagination -->
<?php if($items->hasPages()): ?>
    <div class="d-flex justify-content-center mt-5">
        <?php echo e($items->links('pagination::bootstrap-5')); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\items\partials\items_grid.blade.php ENDPATH**/ ?>