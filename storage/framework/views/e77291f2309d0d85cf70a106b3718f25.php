<?php $__env->startSection('title', '404 - Page Not Found'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6" data-aos="zoom-in">
            <div class="glass-card p-5 rounded-4 shadow-lg">
                <div class="display-1 fw-bold text-gradient mb-2">404</div>
                <h3 class="fw-bold mb-3">Page Not Found</h3>
                <p class="text-muted-custom mb-4">The campus page or report listing you are searching for does not exist or has been removed.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-premium px-4"><i class="fa-solid fa-house me-2"></i>Return Home</a>
                    <a href="<?php echo e(route('items.index')); ?>" class="btn btn-premium-outline px-4"><i class="fa-solid fa-magnifying-glass me-2"></i>Browse Listings</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views/errors/404.blade.php ENDPATH**/ ?>