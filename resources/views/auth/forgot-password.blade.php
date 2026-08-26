<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Campus Lost & Found Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div id="loading-overlay">
        <div class="text-center">
            <div class="spinner-premium mb-3"></div>
            <h5 class="fw-bold text-gradient">Campus Portal</h5>
            <p class="text-muted small">Accessing credentials server...</p>
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
                        <h3 class="fw-bold mb-2">Reset Password</h3>
                        <p class="text-muted-custom mb-4">Enter your registered email to receive a password reset link.</p>
                        
                        @if(session('status'))
                            <div class="alert alert-success rounded-4 mb-3 small">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 border-color"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="student@campus.edu" value="{{ old('email') }}" required autofocus>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-premium w-100 py-3"><i class="fa-solid fa-paper-plane me-2"></i>Send Reset Link</button>
                        </form>
                        <div class="mt-4 text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-gradient fw-bold small">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
