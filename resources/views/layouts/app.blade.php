<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- ملفات CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">

    {{-- خطوط --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    
    <style>
        body {
            background: #f4f4f4;
            direction: ltr; /* خلي الاتجاه من اليسار لليمين */
        }
        .theme-toggle {
            position: fixed;
            left: 25px;
            bottom: 25px;
            background: #203a43;
            color: #30a5ff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: all 0.4s ease;
            z-index: 9999;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            background: #2c5364;
        }

        body.light-mode .theme-toggle {
            background: #fff;
            color: #ffb300;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
       
         body.light-mode .app-container {
    
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);
    background: rgba(255, 255, 255, 0.3);
}
    </style>


</head>
<body class="dark-mode">

 <div class="theme-toggle" id="theme-toggle">
        <i class="fa-solid fa-moon"></i>
    </div>

    {{-- استدعاء الناف بار --}}
    @include('layouts.navbar')

    {{-- استدعاء السايد بار --}}
    @include('layouts.sidebar')

    {{-- محتوى الصفحة --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- ملفات JS --}}
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('theme-toggle');
            const body = document.body;

            // استرجاع الوضع المحفوظ
            let theme = localStorage.getItem('theme') || 'dark';
            body.classList.add(theme + '-mode');
            toggle.innerHTML = theme === 'light' ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';

            // عند الضغط على الزر
            toggle.addEventListener('click', () => {
                if (body.classList.contains('light-mode')) {
                    body.classList.replace('light-mode', 'dark-mode');
                    toggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
                    localStorage.setItem('theme', 'dark');
                } else {
                    body.classList.replace('dark-mode', 'light-mode');
                    toggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>
</body>
</html>