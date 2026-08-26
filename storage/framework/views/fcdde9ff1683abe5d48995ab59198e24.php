<?php $__env->startSection('title', 'Privacy Policy'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active text-primary" aria-current="page">Privacy Policy</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10" data-aos="fade-up">
            <div class="card glass-card border-0 p-4 shadow-lg">
                <div class="card-body">
                    <h2 class="fw-bold mb-4 text-gradient"><i class="fa-solid fa-user-shield me-2"></i>Privacy Policy</h2>
                    <p class="text-muted-custom small">Last Updated: August 07, 2026</p>
                    <hr class="border-card my-4">
                    
                    <h5 class="fw-bold text-primary mt-4 mb-3">1. Information We Collect</h5>
                    <p class="text-muted-custom">
                        To operate the Campus Lost & Found network, we collect registration profile parameters (name, university email address, contact numbers, departments, semesters, and custom bio descriptions) and system interactions data (items reported, uploaded item photos, and claims conversations).
                    </p>

                    <h5 class="fw-bold text-primary mt-4 mb-3">2. How We Use Information</h5>
                    <p class="text-muted-custom">
                        We utilize information to connect search listings, coordinate claims matches, display system logs in the administrator oversight panel, and notify users regarding approved claims or new reports.
                    </p>

                    <h5 class="fw-bold text-primary mt-4 mb-3">3. Data Integrity & Sharing</h5>
                    <p class="text-muted-custom">
                        User parameters are restricted to authenticated university campus network members. We do not sell or lease profile information to third-party commercial services. Contact details associated with a listing are displayed to logged-in members to facilitate reunions.
                    </p>

                    <h5 class="fw-bold text-primary mt-4 mb-3">4. Security Infrastructure</h5>
                    <p class="text-muted-custom">
                        The application uses advanced security layers including password hashing (bcrypt), anti-CSRF request matching token verification, input parameter filters to prevent XSS exploits, and session timeout restrictions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\privacy.blade.php ENDPATH**/ ?>