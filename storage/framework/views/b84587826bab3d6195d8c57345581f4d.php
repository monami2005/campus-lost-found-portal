<?php $__env->startSection('title', 'Contact Support'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active text-primary" aria-current="page">Contact</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-8" data-aos="zoom-in">
            <div class="card glass-card border-0 p-4 shadow-lg">
                <div class="card-body">
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-3 rounded-pill">Get In Touch</span>
                    <h2 class="fw-bold mb-3">Contact the Campus Operations Team</h2>
                    <p class="text-muted-custom mb-4">
                        Have inquiries regarding listing verification, policy disputes, or technical support? Fill out the form below, and our administration staff will get back to you shortly.
                    </p>
                    
                    <form action="<?php echo e(route('contact.submit')); ?>" method="POST" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input name="name" class="form-control border-start-0 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="John Doe" value="<?php echo e(old('name')); ?>" required>
                                </div>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input name="email" type="email" class="form-control border-start-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="johndoe@campus.edu" value="<?php echo e(old('email')); ?>" required>
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message Description</label>
                                <textarea name="message" class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5" placeholder="Specify details regarding your listing or issue..." required><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <button class="btn btn-premium w-100 mt-4 py-3"><i class="fa-solid fa-paper-plane me-2"></i>Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\contact.blade.php ENDPATH**/ ?>