<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Campus Lost & Found Portal') - Secure University Network</title>
    
    <!-- Google Fonts Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Style Sheet -->
    <link href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <!-- Premium Loading overlay -->
    <div id="loading-overlay">
        <div class="text-center">
            <div class="spinner-premium mb-3"></div>
            <h5 class="fw-bold text-gradient">Campus Portal</h5>
            <p class="text-muted small">Loading campus network...</p>
        </div>
    </div>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top glass-nav py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="{{ route('home') }}">
                <i class="fa-solid fa-school text-gradient me-2 fs-3"></i>
                <span class="text-gradient">Campus Portal</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="navbar-nav ms-auto gap-2 align-items-center">
                    <li class="nav-item"><a class="nav-link fw-semibold px-3 {{ request()->routeIs('home') ? 'active text-gradient' : '' }}" href="{{ route('home') }}"><i class="fa-solid fa-house me-1 small"></i>Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold px-3 {{ request()->routeIs('items.*') ? 'active text-gradient' : '' }}" href="{{ route('items.index') }}"><i class="fa-solid fa-list me-1 small"></i>Listings</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold px-3 {{ request()->routeIs('about') ? 'active text-gradient' : '' }}" href="{{ route('about') }}"><i class="fa-solid fa-circle-info me-1 small"></i>About</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold px-3 {{ request()->routeIs('contact') ? 'active text-gradient' : '' }}" href="{{ route('contact') }}"><i class="fa-solid fa-envelope me-1 small"></i>Contact</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold px-3 {{ request()->routeIs('faq') ? 'active text-gradient' : '' }}" href="{{ route('faq') }}"><i class="fa-solid fa-circle-question me-1 small"></i>FAQ</a></li>
                    
                    <!-- Dark Mode switch -->
                    <li class="nav-item px-2">
                        <button class="btn btn-link text-decoration-none text-muted-custom p-2" id="theme-toggle" title="Toggle Theme">
                            <i class="fa-solid fa-moon fs-5"></i>
                        </button>
                    </li>
                    
                    @auth
                        <!-- User Options -->
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover; border: 1.5px solid var(--primary);">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.85rem; font-weight: bold;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end glass-card border-0 shadow-lg mt-2 p-2" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-pie me-2 text-primary"></i>Dashboard</a></li>
                                @if(auth()->user()->isAdmin())
                                    <li><a class="dropdown-item rounded-3 py-2" href="{{ route('admin.index') }}"><i class="fa-solid fa-shield-halved me-2 text-danger"></i>Admin Control</a></li>
                                @endif
                                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2 text-secondary"></i>Profile Settings</a></li>
                                <li><hr class="dropdown-divider border-card"></li>
                                <li>
                                    <a class="dropdown-item rounded-3 py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-2"><a class="btn btn-premium-outline btn-sm px-4" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</a></li>
                        <li class="nav-item"><a class="btn btn-premium btn-sm px-4" href="{{ route('register') }}"><i class="fa-solid fa-user-plus me-2"></i>Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb Layer -->
    @if(!request()->is('/'))
        <div class="container mt-4 mb-2" data-aos="fade-down">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb glass-card px-4 py-2 border-0 mb-0 shadow-sm d-flex gap-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted-custom"><i class="fa-solid fa-house me-1"></i>Home</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    @endif

    <!-- Main Workspace -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Responsive Multi-column Footer -->
    <footer class="footer-custom py-5 mt-5">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-gradient mb-3"><i class="fa-solid fa-school me-2"></i>Campus Portal</h5>
                    <p class="text-muted-custom small">A production-ready Lost & Found network for university systems. Reconnect with lost items quickly and securely using smart analytics and live search utilities.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-gradient mb-3">Resources</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ route('items.index') }}"><i class="fa-solid fa-angle-right me-1"></i>All Listings</a></li>
                        <li><a href="{{ route('about') }}"><i class="fa-solid fa-angle-right me-1"></i>About the Project</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fa-solid fa-angle-right me-1"></i>Contact Team</a></li>
                        <li><a href="{{ route('faq') }}"><i class="fa-solid fa-angle-right me-1"></i>Help & FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-gradient mb-3">Legal</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ route('privacy') }}"><i class="fa-solid fa-angle-right me-1"></i>Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}"><i class="fa-solid fa-angle-right me-1"></i>Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-gradient mb-3">Support Desk</h6>
                    <p class="text-muted-custom small mb-2"><i class="fa-solid fa-location-dot me-2"></i>Central Library Block, Room 402</p>
                    <p class="text-muted-custom small mb-2"><i class="fa-solid fa-phone me-2"></i>+8801700-000000</p>
                    <p class="text-muted-custom small"><i class="fa-solid fa-envelope me-2"></i>support@campus.edu</p>
                </div>
            </div>
            <hr class="border-card my-4">
            <div class="text-center text-muted-custom small">
                <p class="mb-0">© 2026 Campus Lost & Found Portal. Designed & developed as a senior portfolio application.</p>
            </div>
        </div>
    </footer>

    <!-- FAB for Creating Report -->
    @auth
        <a href="{{ route('items.create') }}" class="fab-btn" title="Submit new listing">
            <i class="fa-solid fa-plus"></i>
        </a>
    @endauth

    <!-- Scroll to Top Button -->
    <button id="scroll-top" class="scroll-top-btn" title="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- Custom Toast Notification Container -->
    <div class="toast-container-custom"></div>

    <!-- JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Trigger session flash toast notifications if present
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('success') }}", 'success');
            });
        @endif
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('error') }}", 'error');
            });
        @endif
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ $errors->first() }}", 'error');
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
