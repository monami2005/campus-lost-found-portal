<?php $__env->startSection('title', 'Manage Items - Admin Console'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none text-muted-custom">Admin</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Listings</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="fw-bold display-6 mb-1">Item Directory Management</h1>
            <p class="text-muted-custom mb-0">Audit, inspect, and remove reported items across campus.</p>
        </div>
        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-premium-outline">Back to Overview</a>
    </div>

    <div class="glass-card p-4 rounded-4" data-aos="fade-up">
        <!-- Search Form -->
        <form action="<?php echo e(route('admin.items')); ?>" method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search by title, category, location..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-premium px-4">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th>Item Title</th>
                        <th>Reporter</th>
                        <th>Category & Location</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('items.show', $item)); ?>" class="fw-bold text-primary text-decoration-none">
                                    <?php echo e($item->title); ?>

                                </a>
                            </td>
                            <td class="small">
                                <div class="fw-semibold"><?php echo e($item->user->name ?? 'Deleted User'); ?></div>
                                <div class="text-muted-custom"><?php echo e($item->user->email ?? 'N/A'); ?></div>
                            </td>
                            <td class="small">
                                <div><?php echo e($item->category ? $item->category->name : 'Unknown'); ?></div>
                                <div class="text-muted-custom"><i class="fa-solid fa-location-dot me-1"></i><?php echo e($item->location); ?></div>
                            </td>
                            <td>
                                <span class="badge <?php echo e($item->type === 'lost' ? 'bg-danger' : 'bg-success'); ?> rounded-pill px-3 py-1">
                                    <?php echo e(ucfirst($item->type)); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge <?php echo e($item->status === 'pending' ? 'bg-warning text-dark' : ($item->status === 'claimed' ? 'bg-info' : 'bg-secondary')); ?> rounded-pill px-3 py-1">
                                    <?php echo e(ucfirst($item->status)); ?>

                                </span>
                            </td>
                            <td class="small text-muted-custom"><?php echo e(\Carbon\Carbon::parse($item->date)->format('M d, Y')); ?></td>
                            <td>
                                <form action="<?php echo e(route('admin.items.delete', $item)); ?>" method="POST" class="delete-confirm-form" data-message="Permanently remove this item listing?">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        <i class="fa-solid fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">No items found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($items->hasPages()): ?>
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($items->links('pagination::bootstrap-5')); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\admin\items.blade.php ENDPATH**/ ?>