@if (!Request::is('customer/login') && !Request::is('customer/register'))

@php
    $cartCount = 0;
    if (Auth::guard('customer')->check()) {
        $cartCount = \App\Models\Cart::where(
            'customer_id',
            Auth::guard('customer')->id()
        )->sum('quantity');
    }
@endphp

<style>
    .navbar {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        transition: background 0.3s ease;
        padding: 0.8rem 1rem;
    }

    .brand-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0d6efd !important;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .brand-logo i {
        font-size: 1.9rem;
        margin-right: 8px;
        color: #0a58ca;
    }

    .search-wrapper {
        position: relative;
        flex-grow: 1;
        max-width: 500px;
        margin: 0 30px;
    }

    .search-input {
        border-radius: 50px;
        padding: 10px 20px 10px 45px;
        border: 1px solid #e0e0e0;
        background-color: #f1f3f5;
        transition: all 0.3s ease;
        width: 100%;
    }

    .search-input:focus {
        background-color: #fff;
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
        outline: none;
    }

    .search-icon-btn {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        transition: color 0.3s;
        cursor: pointer;
    }

    .search-input:focus + .search-icon-btn {
        color: #0d6efd;
    }

    .navbar-nav .nav-link {
        position: relative;
        font-weight: 600;
        color: #515151ff !important;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .navbar-nav .nav-link:hover {
        color: #0d6efd !important;
        transform: translateY(-2px);
    }

    .cart-badge {
        position: absolute;
        top: -15px;
        right: 6px;
        background: #0d6efd;
        color: #fff;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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

    @media (max-width: 991px) {
        .search-wrapper {
            margin: 15px 0;
            max-width: 100%;
        }

        .navbar-nav {
            text-align: center;
            padding-top: 15px;
        }

        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-4">

        <a class="navbar-brand brand-logo" href="{{ url('/admin/index') }}">
            <i class="fa-solid fa-bag-shopping"></i> My<span class="text-dark">Shop</span>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            aria-controls="navbarContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-2 text-primary"></i>
        </button>

        <!-- ✅ البرجر شغال من هنا -->
        <div class="collapse navbar-collapse" id="navbarContent">

            <form action="{{ url('/products') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" class="form-control search-input"
                    placeholder="Search for products..."
                    value="{{ request('search') }}">
                <button type="submit" class="search-icon-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

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

                <li class="nav-item ms-3 position-relative">
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        <span class="cart-badge" id="cart-count">{{ $cartCount }}</span>
                    </a>
                </li>

                @if(Auth::guard('customer')->check())
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user fs-5 me-1 text-primary"></i>
                            <span class="fw-bold text-dark">
                                {{ Auth::guard('customer')->user()->name }}
                            </span>
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
                        <a class="btn btn-outline-primary rounded-pill px-3"
                           href="{{ route('customer.login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="btn btn-primary rounded-pill px-3"
                           href="{{ route('customer.register') }}">
                            <i class="fa-solid fa-user-plus me-1"></i> Register
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
@endif