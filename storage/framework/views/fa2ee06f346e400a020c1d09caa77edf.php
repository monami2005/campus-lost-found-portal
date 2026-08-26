<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Campus Lost & Found Portal</title>
    
    <!-- Google Fonts Outfit & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Style Sheet -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">
    
    <div id="loading-overlay">
        <div class="text-center">
            <div class="spinner-premium mb-3"></div>
            <h5 class="fw-bold text-gradient">Campus Portal</h5>
            <p class="text-muted small">Configuring workspace...</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-10" data-aos="zoom-in">
                
                <div class="text-center mb-4">
                    <a class="text-decoration-none fw-bold fs-3 d-inline-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
                        <i class="fa-solid fa-school text-gradient me-2 fs-2"></i>
                        <span class="text-gradient">Campus Portal</span>
                    </a>
                </div>

                <div class="card glass-card border-0 shadow-lg p-3">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-2">Welcome Back</h3>
                        <p class="text-muted-custom mb-4">Sign in to access your campus dashboard and listings.</p>
                        
                        <!-- Session Status / Errors -->
                        <?php if(session('status')): ?>
                            <div class="alert alert-success rounded-4 mb-3 small"><?php echo e(session('status')); ?></div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger rounded-4 mb-3 small"><?php echo e($errors->first()); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="student@campus.edu" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username">
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
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-semibold mb-0">Password</label>
                                    <?php if(\Illuminate\Support\Facades\Route::has('password.request')): ?>
                                        <a class="small text-decoration-none text-gradient fw-semibold" href="<?php echo e(route('password.request')); ?>">
                                            Forgot password?
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="••••••••" required autocomplete="current-password">
                                </div>
                                <?php $__errorArgs = ['password'];
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
                            
                            <!-- Remember me -->
                            <div class="form-check mb-4 mt-2">
                                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                                <label class="form-check-label text-muted-custom small" for="remember_me">Remember my session on this device</label>
                            </div>
                            
                            <!-- Submit Button -->
                            <button class="btn btn-premium w-100 py-3"><i class="fa-solid fa-right-to-bracket me-2"></i>Sign In</button>
                        </form>
                        
                        <div class="mt-4 text-center text-muted-custom small">
                            New member? <a href="<?php echo e(route('register')); ?>" class="text-decoration-none text-gradient fw-bold">Create Campus Account</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('home')); ?>" class="text-decoration-none text-muted-custom small"><i class="fa-solid fa-arrow-left me-2"></i>Return to Homepage</a>
                </div>
                
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>

<?php /**PATH C:\Users\Monami Sadhu\Music\🏫 Campus Lost & Found Portal – Authentication, CRUD, Search\resources\views\auth\login.blade.php ENDPATH**/ ?>