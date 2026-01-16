<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Video List')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

     <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
    <style>
        /* ==== Global Styles ==== */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, #1b2735, #090a0f);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==== Navbar ==== */
        nav {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav .navbar-brand {
            color: #ff4b5c !important;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(255, 75, 92, 0.5);
        }

        nav a {
            color: #fff !important;
            margin-left: 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        nav a:hover {
            color: #ff4b5c !important;
        }

        /* ==== Main Container ==== */
        .main-content {
            padding: 80px 0;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .main-content h1 {
            font-weight: 700;
            margin-bottom: 50px;
            color: #ff4b5c;
            text-shadow: 0 0 10px rgba(255, 75, 92, 0.6);
        }

        /* ==== Card Style ==== */
        .video-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }

        .video-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 10px 30px rgba(255, 75, 92, 0.4);
        }

        iframe {
            border-radius: 20px 20px 0 0;
        }

        .video-card .card-body {
            padding: 20px;
        }

        .video-card h5 {
            font-weight: 600;
            color: #fff;
        }

        .video-card p {
            color: #ccc;
            font-size: 14px;
        }

        /* ==== Footer ==== */
        footer {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #aaa;
            font-size: 14px;
        }

        /* ==== Animation ==== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">🎬 Video Galaxy</a>
        <div class="d-flex">
            <a href="/admin/products" class="nav-link">Home</a>
            <a href="/videos" class="nav-link">Videos</a>
        </div>
    </div>
</nav>

<!-- ===== Page Content ===== -->
<div class="container main-content">
    @yield('content')
</div>

<!-- ===== Footer ===== -->
<footer>
    <p>© 2025 Video Galaxy — Built with ❤ by Ahmed</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>