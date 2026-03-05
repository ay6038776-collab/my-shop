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


 /* From Uiverse.io by mobinkakei */ 
#wifi-loader {
  --background: #62abff;
  --front-color: #4f29f0;
  --back-color: #c3c8de;
  --text-color: #414856;
  width: 64px;
  height: 64px;
  border-radius: 50px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

#wifi-loader svg {
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
}

#wifi-loader svg circle {
  position: absolute;
  fill: none;
  stroke-width: 6px;
  stroke-linecap: round;
  stroke-linejoin: round;
  transform: rotate(-100deg);
  transform-origin: center;
}

#wifi-loader svg circle.back {
  stroke: var(--back-color);
}

#wifi-loader svg circle.front {
  stroke: var(--front-color);
}

#wifi-loader svg.circle-outer {
  height: 86px;
  width: 86px;
}

#wifi-loader svg.circle-outer circle {
  stroke-dasharray: 62.75 188.25;
}

#wifi-loader svg.circle-outer circle.back {
  animation: circle-outer135 1.8s ease infinite 0.3s;
}

#wifi-loader svg.circle-outer circle.front {
  animation: circle-outer135 1.8s ease infinite 0.15s;
}

#wifi-loader svg.circle-middle {
  height: 60px;
  width: 60px;
}

#wifi-loader svg.circle-middle circle {
  stroke-dasharray: 42.5 127.5;
}

#wifi-loader svg.circle-middle circle.back {
  animation: circle-middle6123 1.8s ease infinite 0.25s;
}

#wifi-loader svg.circle-middle circle.front {
  animation: circle-middle6123 1.8s ease infinite 0.1s;
}

#wifi-loader svg.circle-inner {
  height: 34px;
  width: 34px;
}

#wifi-loader svg.circle-inner circle {
  stroke-dasharray: 22 66;
}

#wifi-loader svg.circle-inner circle.back {
  animation: circle-inner162 1.8s ease infinite 0.2s;
}

#wifi-loader svg.circle-inner circle.front {
  animation: circle-inner162 1.8s ease infinite 0.05s;
}

#wifi-loader .text {
  position: absolute;
  bottom: -40px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-transform: lowercase;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 0.2px;
}

#wifi-loader .text::before, #wifi-loader .text::after {
  content: attr(data-text);
}

#wifi-loader .text::before {
  color: var(--text-color);
}

#wifi-loader .text::after {
  color: var(--front-color);
  animation: text-animation76 3.6s ease infinite;
  position: absolute;
  left: 0;
}

@keyframes circle-outer135 {
  0% {
    stroke-dashoffset: 25;
  }

  25% {
    stroke-dashoffset: 0;
  }

  65% {
    stroke-dashoffset: 301;
  }

  80% {
    stroke-dashoffset: 276;
  }

  100% {
    stroke-dashoffset: 276;
  }
}

@keyframes circle-middle6123 {
  0% {
    stroke-dashoffset: 17;
  }

  25% {
    stroke-dashoffset: 0;
  }

  65% {
    stroke-dashoffset: 204;
  }

  80% {
    stroke-dashoffset: 187;
  }

  100% {
    stroke-dashoffset: 187;
  }
}

@keyframes circle-inner162 {
  0% {
    stroke-dashoffset: 9;
  }

  25% {
    stroke-dashoffset: 0;
  }

  65% {
    stroke-dashoffset: 106;
  }

  80% {
    stroke-dashoffset: 97;
  }

  100% {
    stroke-dashoffset: 97;
  }
}

@keyframes text-animation76 {
  0% {
    clip-path: inset(0 100% 0 0);
  }

  50% {
    clip-path: inset(0);
  }

  100% {
    clip-path: inset(0 0 0 100%);
  }
}

#wifi-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;

  background: rgba(255, 255, 255, 0.92);
  z-index: 999999;

  display: flex;
  justify-content: center;
  align-items: center;

  pointer-events: all;

  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

#wifi-loader.active {
  opacity: 1;
  visibility: visible;
}

#wifi-loader * {
  margin: 0 !important;
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

    <div id="wifi-loader">
    <svg class="circle-outer" viewBox="0 0 86 86">
        <circle class="back" cx="43" cy="43" r="40"></circle>
        <circle class="front" cx="43" cy="43" r="40"></circle>
        <circle class="new" cx="43" cy="43" r="40"></circle>
    </svg>
    <svg class="circle-middle" viewBox="0 0 60 60">
        <circle class="back" cx="30" cy="30" r="27"></circle>
        <circle class="front" cx="30" cy="30" r="27"></circle>
    </svg>
    <svg class="circle-inner" viewBox="0 0 34 34">
        <circle class="back" cx="17" cy="17" r="14"></circle>
        <circle class="front" cx="17" cy="17" r="14"></circle>
    </svg>
    <div class="text" data-text="Searching"></div>
</div>

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

     <script>
document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('wifi-loader');
    if (!loader) return;

    // أول ما الصفحة تفتح → نخفيه
    loader.classList.remove('active');

    // أي لينك يتداس
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');

            // تجاهل اللينكات الوهمية
            if (!href || href.startsWith('#') || link.target === '_blank') return;

            loader.classList.add('active');
        });
    });
});

// أول ما الصفحة الجديدة تخلص تحميل
window.addEventListener('load', () => {
    const loader = document.getElementById('wifi-loader');
    if (!loader) return;

    loader.classList.remove('active');
});
</script>
</body>
</html>