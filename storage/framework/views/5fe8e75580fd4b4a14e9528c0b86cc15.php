<?php $__env->startSection('title', 'Manage Users - Admin Console'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none text-muted-custom">Admin</a></li>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Users</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="fw-bold display-6 mb-1">User Management</h1>
            <p class="text-muted-custom mb-0">View all registered students, inspect departments, and manage access roles.</p>
        </div>
        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-premium-outline">Back to Overview</a>
    </div>

    <div class="glass-card p-4 rounded-4" data-aos="fade-up">
        <!-- Search bar -->
        <form action="<?php echo e(route('admin.users')); ?>" method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, email, department..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-premium px-4">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th>User Details</th>
                        <th>Department & Semester</th>
                        <th>Contact Phone</th>
                        <th>Role / Status</th>
                        <th>Joined Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <?php if($user->avatar): ?>
                                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="Avatar" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                                            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="fw-bold"><?php echo e($user->name); ?></div>
                                        <div class="small text-muted-custom"><?php echo e($user->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="small">
                                <div><?php echo e($user->department ?? 'N/A'); ?></div>
                                <div class="text-muted-custom"><?php echo e($user->semester ?? 'N/A'); ?></div>
                            </td>
                            <td class="small"><?php echo e($user->phone ?? 'N/A'); ?></td>
                            <td>
                                <span class="badge <?php echo e($user->role === 'admin' ? 'bg-danger' : ($user->status === 'suspended' ? 'bg-secondary' : 'bg-primary')); ?> rounded-pill px-3 py-1">
                                    <?php echo e($user->status === 'suspended' ? 'Suspended' : ucfirst($user->role)); ?>

                                </span>
                            </td>
                            <td class="small text-muted-custom"><?php echo e($user->created_at->format('M d, Y')); ?></td>
                            <td>
                                <?php if(!$user->isAdmin()): ?>
                                    <?php if($user->status === 'suspended'): ?>
                                        <form action="<?php echo e(route('admin.users.restore', $user)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">Restore</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('admin.users.suspend', $user)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Suspend</button>
                                        </form>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted small fw-semibold">Super Admin</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">No users found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($users->hasPages()): ?>
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($users->links('pagination::bootstrap-5')); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\admin\users.blade.php ENDPATH**/ ?>