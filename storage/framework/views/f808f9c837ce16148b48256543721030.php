<?php $__env->startSection('title', 'Admin Portal Dashboard'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active text-gradient fw-semibold" aria-current="page">Admin Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Admin Header Banner -->
    <div class="glass-card p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden" data-aos="fade-down">
        <div class="position-absolute top-0 end-0 bg-danger opacity-10 rounded-circle" style="width: 250px; height: 250px; transform: translate(80px, -80px);"></div>
        <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
            <div class="col-md-8">
                <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2 mb-2 rounded-pill">
                    <i class="fa-solid fa-shield-halved me-1"></i>System Administrator Console
                </span>
                <h1 class="fw-bold display-6 mb-2">Campus Control Panel</h1>
                <p class="text-muted-custom mb-0">Oversee student accounts, manage reported listings, audit claim verifications, and inspect portal analytics.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-premium px-3 py-2 me-2">
                    <i class="fa-solid fa-users-gear me-1"></i>Manage Users
                </a>
                <a href="<?php echo e(route('admin.items')); ?>" class="btn btn-premium-outline px-3 py-2">
                    <i class="fa-solid fa-boxes-stacked me-1"></i>Manage Items
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Metric Cards Grid -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-primary h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Registered Users</span>
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-2">
                        <i class="fa-solid fa-users fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1"><?php echo e($stats['users']); ?></h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-user-check text-primary me-1"></i>Verified university accounts</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-danger h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Total Lost Reports</span>
                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger p-2">
                        <i class="fa-solid fa-circle-exclamation fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1"><?php echo e($stats['lost']); ?></h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-list-ol text-danger me-1"></i>Reported by students</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-success h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Total Found Items</span>
                    <div class="rounded-3 bg-success bg-opacity-10 text-success p-2">
                        <i class="fa-solid fa-hand-holding-heart fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1"><?php echo e($stats['found']); ?></h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-shield text-success me-1"></i>In campus custody</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="glass-card p-4 rounded-4 border-start border-4 border-warning h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted-custom fw-semibold small">Claims & Resolution Rate</span>
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-2">
                        <i class="fa-solid fa-hand-holding-hand fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-1"><?php echo e($stats['claims']); ?></h2>
                <div class="small text-muted-custom"><i class="fa-solid fa-chart-pie text-warning me-1"></i><?php echo e($stats['resolutionRate'] ?? 0); ?>% resolution success</div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Monthly Lost/Found Line Chart -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="glass-card p-4 rounded-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-chart-line text-primary me-2"></i>Campus Activity Trends</h5>
                        <small class="text-muted-custom">Lost vs Found reports timeline</small>
                    </div>
                </div>
                <div style="height: 280px; position: relative;">
                    <canvas id="adminMonthlyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="col-lg-4" data-aos="fade-left">
            <div class="glass-card p-4 rounded-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-chart-pie text-secondary me-2"></i>Item Categories</h5>
                        <small class="text-muted-custom">Distribution by category</small>
                    </div>
                </div>
                <div style="height: 250px; position: relative;" class="d-flex align-items-center justify-content-center">
                    <canvas id="adminCategoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users & Activity Logs -->
    <div class="row g-4">
        <!-- Latest Registered Users -->
        <div class="col-lg-6" data-aos="fade-up">
            <div class="glass-card p-4 rounded-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-card">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-user-plus text-primary me-2"></i>Recently Joined Members</h5>
                    <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-sm btn-premium-outline">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Department</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold small" style="width: 32px; height: 32px;">
                                                <?php echo e(strtoupper(substr($u->name, 0, 2))); ?>

                                            </div>
                                            <div>
                                                <div class="fw-semibold small"><?php echo e($u->name); ?></div>
                                                <div class="text-muted small"><?php echo e($u->email); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="small"><?php echo e($u->department ?? 'General'); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($u->role === 'admin' ? 'bg-danger' : ($u->role === 'suspended' ? 'bg-secondary' : 'bg-primary')); ?> rounded-pill small">
                                            <?php echo e(ucfirst($u->role)); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="3" class="text-center text-muted small py-3">No users registered yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Audit Log -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-card p-4 rounded-4 h-100">
                <h5 class="fw-bold mb-3 pb-2 border-bottom border-card"><i class="fa-solid fa-list-check text-info me-2"></i>System Activity Logs</h5>
                <div class="d-flex flex-column gap-2">
                    <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-3 rounded-3 bg-body-tertiary border border-card d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold small"><?php echo e($act->description); ?></div>
                                <div class="text-muted small">by <?php echo e($act->user->name ?? 'System'); ?> (<?php echo e($act->user->email ?? 'N/A'); ?>)</div>
                            </div>
                            <span class="text-muted small ms-2"><?php echo e($act->created_at->diffForHumans()); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted-custom small mb-0">No system activities recorded.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = <?php echo json_encode($chartData, 15, 512) ?>;

        const ctxTrend = document.getElementById('adminMonthlyTrendChart');
        if (ctxTrend) {
            new Chart(ctxTrend, {
                type: 'bar',
                data: {
                    labels: chartData.months,
                    datasets: [
                        {
                            label: 'Lost Items',
                            data: chartData.monthlyLost,
                            backgroundColor: '#ef4444'
                        },
                        {
                            label: 'Found Items',
                            data: chartData.monthlyFound,
                            backgroundColor: '#10b981'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        }

        const ctxCategory = document.getElementById('adminCategoryChart');
        if (ctxCategory && chartData.categories.length > 0) {
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: chartData.categories,
                    datasets: [{
                        data: chartData.categoryCounts,
                        backgroundColor: ['#2563eb', '#7c3aed', '#10b981', '#f59e0b', '#ef4444', '#06b6d4']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\dashboard\admin.blade.php ENDPATH**/ ?>