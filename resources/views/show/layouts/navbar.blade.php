@if (!Request::is('customer/login') && !Request::is('customer/register'))
<style>
    .navbar {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        transition: background 0.3s ease;
    }
    .brand-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0d6efd !important;
        display: flex;
        align-items: center;
    }
    .brand-logo i {
        font-size: 1.9rem;
        margin-right: 8px;
        color: #0a58ca;
    }
    .navbar-nav .nav-link {
        position: relative;
        font-weight: 600;
        color: #515151ff !important;
        transition: all 0.3s ease;
    }
    .navbar-nav .nav-link:hover {
        color: #0d6efd !important;
        transform: translateY(-2px);
    }
    .cart-badge {
        position: absolute;
        top: -12px;
        right: 6px;
        background: #0d6efd;
        color: #fff;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        animation: bounce 0.6s ease;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 10px;
    }
    .dropdown-item:hover {
        background: #fd0d0dff;
        color: #fff !important;
        border-radius: 8px;
    }
</style>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand brand-logo" href="{{ url('/admin/index') }}">
            <i class="fa-solid fa-bag-shopping"></i> My<span class="text-dark">Shop</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-2 text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-lg-center fw-semibold">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="fa-solid fa-house me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}">
                        <i class="fa-solid fa-box-open me-1"></i> Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/show/orders') }}">
                        <i class="fa-solid fa-clipboard-list me-1"></i> Orders
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/videos') }}">
                        <i class="fa-solid fa-circle-play me-1"></i> Videos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/aboutus') }}">
                        <i class="fa-solid fa-circle-info me-1"></i> About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact') }}">
                        <i class="fa-solid fa-envelope me-1"></i> Contact
                    </a>
                </li>

                <!-- Cart -->
                <li class="nav-item ms-3 position-relative">
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        @php
                            $cartCount = 0;
                            if (Auth::guard('customer')->check()) {
                                $cartCount = \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->sum('quantity');
                            }
                        @endphp
                        <span class="cart-badge" id="cart-count">{{ $cartCount }}</span>
                    </a>
                </li>

                <!-- Auth -->
                @if(Auth::guard('customer')->check())
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                           role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user fs-5 me-1 text-primary"></i>
                            <span class="fw-bold text-dark">{{ Auth::guard('customer')->user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    <i class="fa-solid fa-gear me-2"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-semibold">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary rounded-pill px-3" href="{{ route('customer.login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="btn btn-primary rounded-pill px-3" href="{{ route('customer.register') }}">
                            <i class="fa-solid fa-user-plus me-1"></i> Register
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
@endif