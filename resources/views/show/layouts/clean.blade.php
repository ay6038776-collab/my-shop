<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Your App Name</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Custom Styles (If you have a separate app.css) --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    {{-- Custom CSS from specific view (e.g., the profile styles) --}}
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- 
        --- HEADER (بدون شريط تنقل - Navbar) --- 
        يمكنك وضع أي محتوى أعلى الصفحة هنا، مثل شعار بسيط
        <h1>Your App Logo</h1>
    --}}
    <header class="py-3">
        {{-- <div class="container text-center">
            <h5 class="text-white-50">Your App Logo</h5>
        </div> --}}
    </header>

    {{-- 
        --- PAGE CONTENT --- 
        هذا هو المكان الذي سيتم فيه عرض محتوى الملف الذي ذكرته سابقاً (Profile)
    --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- 
        --- FOOTER --- 
        يمكنك تضمين محتوى التذييل (Footer) هنا
    --}}
    <footer class="mt-auto py-4 text-center">
        <div class="container">
            <span class="text-white-50">&copy; {{ date('Y') }} Your App Name. All rights reserved.</span>
        </div>
    </footer>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom JS (If you have a separate app.js) --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    {{-- Scripts from specific view --}}
    @yield('scripts')
</body>
</html>