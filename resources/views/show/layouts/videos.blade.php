<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Video Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
        }

        /* Navbar */
        nav {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        nav a {
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        nav a:hover {
            color: #ff4b5c !important;
            transform: scale(1.05);
        }

        .navbar-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #ff4b5c;
            text-shadow: 0 0 10px rgba(255, 75, 92, 0.5);
        }

        /* Container content */
        .container {
            padding-top: 50px;
            padding-bottom: 60px;
            animation: fadeIn 1.2s ease-in-out;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px 0;
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
            font-size: 14px;
        }

        footer a {
            color: #ff4b5c;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="p-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <h4 class="navbar-title mb-0">🎬 Video Platform</h4>
        <div>
            <a href="/" class="me-4">Home</a>
            
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="container">
    @yield('content')
</div>

<!-- Footer -->
<footer>
    <p>© 2025 Video Platform. Built with ❤ by Ahmed.</p>
</footer>

</body>
</html>