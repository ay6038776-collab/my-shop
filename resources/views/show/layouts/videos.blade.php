<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyShop Videos')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/png">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --accent-primary: #818cf8;
            --accent-secondary: #c084fc;
            --accent-success: #34d399;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            padding: 1rem 0;
            position: relative;
            z-index: 100;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-primary) !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand-custom:hover {
            color: var(--accent-primary) !important;
            transform: translateX(5px);
        }

        .navbar-brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            box-shadow: 0 4px 15px rgba(129, 140, 248, 0.4);
        }

        .nav-link-custom {
            color: var(--text-secondary) !important;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-custom:hover {
            color: var(--text-primary) !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link-custom.active {
            color: var(--accent-primary) !important;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-custom:hover::after {
            width: 80%;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 1;
            padding: 2rem 0 4rem;
        }

        /* Footer */
        .footer-custom {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            text-align: center;
            position: relative;
            z-index: 100;
        }

        .footer-custom p {
            color: var(--text-secondary);
            margin: 0;
        }

        .footer-custom a {
            color: var(--accent-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-custom a:hover {
            color: var(--accent-secondary);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-scale-in {
            animation: scaleIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand-custom {
                font-size: 1.25rem;
            }

            .navbar-brand-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar-custom sticky-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a href="/" class="navbar-brand-custom">
                <div class="navbar-brand-icon">
                    <i class="fa-solid fa-play"></i>
                </div>
                <span>MyShop <span style="color: var(--accent-primary);">Videos</span></span>
            </a>
            <div class="d-flex gap-2">
                <a href="/" class="nav-link-custom">
                    <i class="fa-solid fa-home me-1"></i> Home
                </a>
                <a href="{{ route('show.products.index') }}" class="nav-link-custom">
                    <i class="fa-solid fa-bag-shopping me-1"></i> Products
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer-custom">
    <div class="container">
        <p>© {{ date('Y') }} MyShop. Built with <i class="fa-solid fa-heart" style="color: #ef4444;"></i> by <a href="#">Ahmed</a></p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
