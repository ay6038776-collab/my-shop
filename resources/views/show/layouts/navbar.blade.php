<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" rel="stylesheet">


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

/* =========================================================
   MYSHOP NAVBAR
   Responsive + Clean UX
========================================================= */

.navbar {
    width: 100%;
    padding: 0.75rem 1rem;

    background: linear-gradient(
        135deg,
        #ffffff 0%,
        #f8f9fa 100%
    );

    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);

    font-family: 'Poppins', sans-serif;

    position: relative;
    z-index: 1050;

    transition:
        background 0.3s ease,
        box-shadow 0.3s ease;
}

/* =========================================================
   CONTAINER
========================================================= */

.navbar .container-fluid {
    width: 100%;
    max-width: 1500px;

    margin: 0 auto;

    padding-left: 20px;
    padding-right: 20px;
}

/* =========================================================
   BRAND
========================================================= */

.brand-logo {
    flex: 0 0 auto;

    display: flex;
    align-items: center;

    gap: 8px;

    font-size: 1.8rem;
    font-weight: 700;

    color: #0d6efd !important;

    text-decoration: none;

    white-space: nowrap;

    transition:
        transform 0.25s ease,
        color 0.25s ease;
}

.brand-logo:hover {
    transform: translateY(-1px);
}

.brand-logo i {
    font-size: 1.9rem;
    color: #0a58ca;

    margin-right: 0 !important;
}

/* =========================================================
   TOGGLER
========================================================= */

.navbar-toggler {
    border: none !important;

    padding: 8px 10px;

    border-radius: 12px;

    box-shadow: none !important;

    transition:
        background 0.2s ease,
        transform 0.2s ease;
}

.navbar-toggler:hover {
    background: rgba(13, 110, 253, 0.08);

    transform: scale(1.04);
}

.navbar-toggler:focus {
    box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.12) !important;
}

.navbar-toggler i {
    font-size: 1.5rem !important;
}

/* =========================================================
   NAVBAR COLLAPSE
========================================================= */

.navbar-collapse {
    align-items: center;
}

/* =========================================================
   SEARCH
========================================================= */

.search-wrapper {
    position: relative;

    flex: 1 1 420px;

    width: 100%;
    max-width: 500px;

    margin: 0 25px;
}

.search-input {
    width: 100%;

    height: 44px;

    padding: 10px 20px 10px 45px;

    border: 1px solid #e0e0e0;

    border-radius: 50px;

    background: #f1f3f5;

    color: #212529;

    font-size: 0.9rem;

    transition:
        background 0.25s ease,
        border-color 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.2s ease;
}

.search-input:hover {
    background: #ffffff;
    border-color: #d5d9dd;
}

.search-input:focus {
    background: #ffffff;

    border-color: #0d6efd;

    outline: none;

    box-shadow:
        0 0 0 4px rgba(13, 110, 253, 0.08);
}

.search-icon-btn {
    position: absolute;

    left: 15px;
    top: 50%;

    width: 25px;
    height: 25px;

    padding: 0;

    transform: translateY(-50%);

    display: flex;
    align-items: center;
    justify-content: center;

    background: transparent;

    border: none;

    color: #6c757d;

    cursor: pointer;

    transition:
        color 0.2s ease,
        transform 0.2s ease;
}

.search-icon-btn:hover {
    color: #0d6efd;

    transform:
        translateY(-50%)
        scale(1.08);
}

.search-input:focus + .search-icon-btn {
    color: #0d6efd;
}

/* =========================================================
   NAVIGATION
========================================================= */

.navbar-nav {
    display: flex;

    align-items: center;

    flex-wrap: nowrap;

    gap: 2px;
}

.navbar-nav .nav-item {
    flex: 0 0 auto;
}

.navbar-nav .nav-link {
    position: relative;

    display: flex;
    align-items: center;

    padding: 9px 10px !important;

    color: #515151 !important;

    font-size: 0.9rem;

    font-weight: 600;

    white-space: nowrap;

    border-radius: 10px;

    transition:
        color 0.2s ease,
        background 0.2s ease,
        transform 0.2s ease;
}

.navbar-nav .nav-link:hover {
    color: #0d6efd !important;

    background: rgba(13, 110, 253, 0.06);

    transform: translateY(-1px);
}

.navbar-nav .nav-link i {
    transition: transform 0.2s ease;
}

.navbar-nav .nav-link:hover i {
    transform: scale(1.08);
}

/* =========================================================
   CART
========================================================= */

.navbar-nav .cart-item {
    position: relative !important;

    display: flex;
    align-items: center;

    margin-left: 4px;
}

.navbar-nav .cart-item .nav-link {
    position: relative;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;

    padding: 0 !important;
}

/* Cart Icon */
.navbar-nav .cart-item .nav-link i {
    font-size: 1.15rem;

    line-height: 1;

    margin: 0 !important;
}

/* Cart Counter */
.navbar-nav .cart-item .cart-badge {
    position: absolute !important;

    top: 2px;
    right: 1px;

    min-width: 18px;
    height: 18px;

    padding: 0 4px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #0d6efd;

    color: #fff;

    font-size: 0.62rem;
    font-weight: 700;

    line-height: 1;

    border: 2px solid #fff;

    border-radius: 50%;

    box-shadow:
        0 2px 6px rgba(13, 110, 253, 0.25);

    pointer-events: none;

    z-index: 5;

    transform: none !important;
}



/* =========================================================
   LANGUAGE SWITCHER
========================================================= */

.language-switcher {
    flex: 0 0 auto;
}

/* =========================================================
   ACCOUNT / AVATAR
========================================================= */

.navbar-nav .dropdown-toggle::after {
    margin-left: 5px;
}

.navbar-nav .dropdown-toggle {
    gap: 7px !important;
}

.navbar-nav .dropdown-toggle img {
    flex: 0 0 auto;

    width: 35px;
    height: 35px;

    object-fit: cover;
}

.navbar-nav .dropdown-toggle .fw-bold {
    max-width: 130px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

/* =========================================================
   DROPDOWN
========================================================= */

.dropdown-menu {
    min-width: 190px;

    margin-top: 10px !important;

    padding: 8px;

    border: 1px solid rgba(0, 0, 0, 0.05);

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 15px 40px rgba(0, 0, 0, 0.12);
}

.dropdown-item {
    padding: 9px 12px;

    font-size: 0.88rem;

    transition:
        background 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.dropdown-item:hover {
    background: #fd0d0d;
    color: #ffffff !important;

    transform: translateX(-2px);
}

.dropdown-item.text-danger:hover {
    background: #dc3545;
    color: #ffffff !important;
}

.dropdown-divider {
    margin: 6px 0;
}

/* =========================================================
   AUTH BUTTONS
========================================================= */

.navbar-nav .btn {
    white-space: nowrap;

    font-size: 0.86rem;
    font-weight: 600;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.navbar-nav .btn:hover {
    transform: translateY(-1px);

    box-shadow:
        0 5px 15px rgba(13, 110, 253, 0.15);
}

/* =========================================================
   LARGE DESKTOP
   1400px+
========================================================= */

@media (min-width: 1400px) {

    .navbar .container-fluid {
        max-width: 1600px;
    }

    .brand-logo {
        font-size: 1.9rem;
    }

    .search-wrapper {
        max-width: 560px;

        margin-left: 35px;
        margin-right: 35px;
    }

    .navbar-nav {
        gap: 3px;
    }

    .navbar-nav .nav-link {
        padding-left: 11px !important;
        padding-right: 11px !important;
    }
}

/* =========================================================
   NORMAL DESKTOP
   1200px - 1399px
========================================================= */

@media (min-width: 1200px) and (max-width: 1399px) {

    .navbar .container-fluid {
        max-width: 1400px;
    }

    .brand-logo {
        font-size: 1.65rem;
    }

    .brand-logo i {
        font-size: 1.7rem;
    }

    .search-wrapper {
        max-width: 380px;

        margin-left: 18px;
        margin-right: 18px;
    }

    .navbar-nav .nav-link {
        padding-left: 7px !important;
        padding-right: 7px !important;

        font-size: 0.82rem;
    }

    .navbar-nav .nav-link i {
        margin-right: 3px !important;
    }

    .navbar-nav .btn {
        padding-left: 11px !important;
        padding-right: 11px !important;
    }
}

/* =========================================================
   LAPTOP
   992px - 1199px
========================================================= */

@media (min-width: 992px) and (max-width: 1199px) {

    .navbar {
        padding-left: 0.6rem;
        padding-right: 0.6rem;
    }

    .navbar .container-fluid {
        padding-left: 12px;
        padding-right: 12px;
    }

    .brand-logo {
        font-size: 1.45rem;
    }

    .brand-logo i {
        font-size: 1.55rem;
    }

    .search-wrapper {
        max-width: 300px;

        margin-left: 12px;
        margin-right: 12px;
    }

    .search-input {
        height: 40px;

        font-size: 0.82rem;
    }

    .navbar-nav {
        gap: 0;
    }

    .navbar-nav .nav-link {
        padding-left: 5px !important;
        padding-right: 5px !important;

        font-size: 0.75rem;
    }

    .navbar-nav .nav-link i {
        margin-right: 2px !important;
    }



    .navbar-nav .btn {
        padding: 7px 9px !important;

        font-size: 0.75rem;
    }
}

/* =========================================================
   TABLET + MOBILE
   BELOW 992px

   Bootstrap navbar-expand-xxl collapses at 1399px,
   so this section is intentionally kept compatible
   with the existing markup.
========================================================= */

@media (max-width: 1399px) {

    .navbar-collapse {
        padding-top: 14px;
    }

    /* Search */
    .search-wrapper {
        max-width: none;
        margin: 0 0 15px;
    }

    /* Navigation */
    .navbar-nav {
        width: 100%;

        align-items: stretch !important;

        padding: 5px 0 10px;

        gap: 4px;
    }

    .navbar-nav .nav-item {
        width: 100%;
    }

    .navbar-nav .nav-link {
        width: 100%;

        /* أهم جزء */
        justify-content: flex-start;

        /* يخلي الكلام واخد مسافة من الشمال */
        padding: 11px 18px !important;

        font-size: 0.9rem;

        text-align: left;
    }

    .navbar-nav .nav-link:hover {
        transform: none;
    }

    /* الأزرار */
    .navbar-nav .btn {
        display: flex;

        align-items: center;
        justify-content: flex-start;

        width: auto;

        margin: 3px 0;

        padding: 10px 18px !important;
    }

    /* Account */
    .navbar-nav .dropdown {
        width: 100%;
    }

    .navbar-nav .dropdown-toggle {
        justify-content: flex-start;
    }

    /* Dropdown */
    .dropdown-menu {
        position: static !important;

        width: 100%;

        margin: 5px 0 !important;

        box-shadow:
            0 5px 20px rgba(0, 0, 0, 0.08);
    }




/* =========================================================
   MOBILE
   BELOW 576px
========================================================= */

@media (max-width: 576px) {

    .navbar {
        padding: 0.65rem 0.75rem;
    }

    .navbar .container-fluid {
        padding-left: 8px;
        padding-right: 8px;
    }

    .brand-logo {
        font-size: 1.45rem;
    }

    .brand-logo i {
        font-size: 1.5rem;
    }

    .navbar-toggler {
        padding: 7px 9px;
    }

    .navbar-toggler i {
        font-size: 1.35rem !important;
    }

    .navbar-collapse {
        padding-top: 12px;
    }

    .search-wrapper {
        margin-bottom: 12px;
    }

    .search-input {
        height: 43px;

        padding-left: 43px;

        font-size: 0.85rem;
    }

    .search-icon-btn {
        left: 13px;
    }

    .navbar-nav .nav-link {
        font-size: 0.86rem;

        padding: 10px 12px !important;
    }

    .navbar-nav .nav-link i {
        margin-right: 6px !important;
    }

    .navbar-nav .btn {
        font-size: 0.82rem;
    }

   

    .dropdown-menu {
        border-radius: 12px;
    }
}

/* =========================================================
   VERY SMALL PHONES
   BELOW 400px
========================================================= */

@media (max-width: 400px) {

    .brand-logo {
        font-size: 1.3rem;
    }

    .brand-logo i {
        font-size: 1.35rem;
    }

    .navbar-toggler {
        padding: 6px 8px;
    }

    .search-input {
        height: 41px;

        font-size: 0.8rem;
    }

    .navbar-nav .nav-link {
        font-size: 0.82rem;
    }
}

/* =========================================================
   ACCESSIBILITY
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .navbar,
    .brand-logo,
    .search-input,
    .search-icon-btn,
    .navbar-nav .nav-link,
    .navbar-nav .nav-link i,
    .navbar-nav .btn,
    .dropdown-item,
    .navbar-toggler {
        transition: none !important;
    }
}

</style>

<nav class="navbar navbar-expand-xxl navbar-light bg-light shadow-sm">
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
                        <i class="fa-solid fa-house me-1"></i> {{ __('general.home') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}">
                        <i class="fa-solid fa-box-open me-1"></i> {{ __('general.products') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/show/orders') }}">
                        <i class="fa-solid fa-clipboard-list me-1"></i> {{ __('general.orders') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/videos') }}">
                        <i class="fa-solid fa-circle-play me-1"></i> {{ __('general.videos') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/aboutus') }}">
                        <i class="fa-solid fa-circle-info me-1"></i> {{ __('general.about') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact') }}">
                        <i class="fa-solid fa-envelope me-1"></i> {{ __('general.contact') }}
                    </a>
                </li>

                <!-- Language Switcher -->
                <x-language-switcher />

                <li class="nav-item cart-item position-relative">
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        <span class="cart-badge" id="cart-count">{{ $cartCount }}</span>
                    </a>
                </li>

                @if(Auth::guard('customer')->check())
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#" role="button" data-bs-toggle="dropdown">
                            @php $customer = Auth::guard('customer')->user(); @endphp
                            @if($customer->avatar)
                                <img src="{{ asset('storage/avatars/' . $customer->avatar) }}"
                                     class="rounded-circle border border-2 border-primary"
                                     width="35" height="35"
                                     alt="Avatar"
                                     style="object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=667eea&color=fff&size=70"
                                     class="rounded-circle border border-2 border-primary"
                                     width="35" height="35"
                                     alt="Avatar">
                            @endif
                            <span class="fw-bold text-dark d-none d-lg-inline">
                                {{ $customer->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li>
                                <a class="dropdown-item rounded-2 mb-1" href="{{ url('/profile') }}">
                                    <i class="fa-solid fa-gear me-2"></i> {{ __('general.profile') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-semibold rounded-2">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> {{ __('general.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary rounded-pill px-3"
                           href="{{ route('customer.login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> {{ __('general.login') }}
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="btn btn-primary rounded-pill px-3"
                           href="{{ route('customer.register') }}">
                            <i class="fa-solid fa-user-plus me-1"></i> {{ __('general.register') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@endif
