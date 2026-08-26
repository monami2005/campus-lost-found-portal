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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                    <a class="text-decoration-none fw-bold fs-3 d-inline-flex align-items-center justify-content-center" href="{{ route('home') }}">
                        <i class="fa-solid fa-school text-gradient me-2 fs-2"></i>
                        <span class="text-gradient">Campus Portal</span>
                    </a>
                </div>

                <div class="card glass-card border-0 shadow-lg p-3">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-2">Welcome Back</h3>
                        <p class="text-muted-custom mb-4">Sign in to access your campus dashboard and listings.</p>
                        
                        <!-- Session Status / Errors -->
                        @if(session('status'))
                            <div class="alert alert-success rounded-4 mb-3 small">{{ session('status') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger rounded-4 mb-3 small">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="student@campus.edu" value="{{ old('email') }}" required autofocus autocomplete="username">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-semibold mb-0">Password</label>
                                    @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                        <a class="small text-decoration-none text-gradient fw-semibold" href="{{ route('password.request') }}">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
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
                            New member? <a href="{{ route('register') }}" class="text-decoration-none text-gradient fw-bold">Create Campus Account</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted-custom small"><i class="fa-solid fa-arrow-left me-2"></i>Return to Homepage</a>
                </div>
                
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>

