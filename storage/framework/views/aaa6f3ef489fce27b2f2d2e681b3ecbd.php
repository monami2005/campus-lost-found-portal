<?php $__env->startSection('title', '403 - Forbidden Access'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6" data-aos="zoom-in">
            <div class="glass-card p-5 rounded-4 shadow-lg">
                <div class="display-1 fw-bold text-danger mb-2"><i class="fa-solid fa-lock me-2"></i>403</div>
                <h3 class="fw-bold mb-3">Access Forbidden</h3>
                <p class="text-muted-custom mb-4">You do not have administrative permissions to view or execute actions on this portal resource.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-premium px-4"><i class="fa-solid fa-gauge me-2"></i>Go to Dashboard</a>
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-premium-outline px-4"><i class="fa-solid fa-house me-2"></i>Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\errors\403.blade.php ENDPATH**/ ?>