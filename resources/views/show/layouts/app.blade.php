<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    <!-- Bootstrap CSS - RTL for Arabic -->
    @if(app()->getLocale() == 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" rel="stylesheet">

    @stack('styles')

    <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ===== DARK MODE CSS VARIABLES ===== */
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-card: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow: rgba(0,0,0,0.08);
            --navbar-bg: #ffffff;
            --card-border: #e2e8f0;
            --input-bg: #f8f9fa;
            --input-border: #e2e8f0;
            --ticker-bg: #1e293b;
            --ticker-text: #ffffff;
        }

        body.dark-theme {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --shadow: rgba(0,0,0,0.4);
            --navbar-bg: #1e293b;
            --card-border: #334155;
            --input-bg: #0f172a;
            --input-border: #334155;
            --ticker-bg: #1e293b;
            --ticker-text: #f1f5f9;
        }

        body {
            background-color: var(--bg-primary) !important;
            color: var(--text-primary) !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ===== GLOBAL DARK MODE STYLES ===== */
        body.dark-theme .navbar,
        body.dark-theme .navbar-collapse {
            background-color: var(--navbar-bg) !important;
            box-shadow: 0 4px 20px var(--shadow) !important;
        }
        body.dark-theme .navbar .nav-link,
        body.dark-theme .navbar-brand {
            color: var(--text-primary) !important;
        }
        body.dark-theme .search-input {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
        }
        body.dark-theme .search-input::placeholder { color: var(--text-secondary) !important; }
        body.dark-theme .dropdown-menu {
            background-color: var(--bg-card) !important;
            border-color: var(--border-color) !important;
            box-shadow: 0 8px 30px var(--shadow) !important;
        }
        body.dark-theme .dropdown-item {
            color: var(--text-primary) !important;
        }
        body.dark-theme .dropdown-item:hover {
            background-color: var(--bg-secondary) !important;
        }
        body.dark-theme .text-muted { color: var(--text-secondary) !important; }
        body.dark-theme .card,
        body.dark-theme .clean-product-card {
            background-color: var(--bg-card) !important;
            border-color: var(--border-color) !important;
            box-shadow: 0 4px 20px var(--shadow) !important;
        }
        body.dark-theme .card-title,
        body.dark-theme .text-dark {
            color: var(--text-primary) !important;
        }
        body.dark-theme .btn-outline-dark-accent {
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        body.dark-theme .btn-outline-dark-accent:hover {
            background-color: var(--bg-secondary) !important;
        }
        body.dark-theme footer,
        body.dark-theme .footer {
            background-color: var(--bg-secondary) !important;
            color: var(--text-secondary) !important;
            border-top: 1px solid var(--border-color) !important;
        }
        body.dark-theme .text-white-50 { color: var(--text-secondary) !important; }
        body.dark-theme .ticker-wrapper {
            background: var(--ticker-bg) !important;
        }
        body.dark-theme .ticker-label,
        body.dark-theme .ticker-name,
        body.dark-theme .ticker-price {
            color: var(--ticker-text) !important;
        }
        body.dark-theme .ticker-badge {
            background: var(--text-primary) !important;
            color: var(--bg-primary) !important;
        }
        body.dark-theme .ticker-sep { color: var(--text-secondary) !important; }
        body.dark-theme .progress { background-color: var(--border-color) !important; }
        body.dark-theme .input-group-text {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-secondary) !important;
        }
        body.dark-theme .form-control,
        body.dark-theme textarea {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
        }
        body.dark-theme .form-control:focus,
        body.dark-theme textarea:focus {
            background-color: var(--input-bg) !important;
            border-color: #4f46e5 !important;
            color: var(--text-primary) !important;
        }
        body.dark-theme .text-dark-accent { color: #818cf8 !important; }
        body.dark-theme .text-main-price { color: #818cf8 !important; }
        body.dark-theme .text-primary-glow { color: #818cf8 !important; }
        body.dark-theme .modal-content {
            background-color: var(--bg-card) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        body.dark-theme .modal-header,
        body.dark-theme .modal-footer {
            border-color: var(--border-color) !important;
        }
        body.dark-theme .breadcrumb {
            background-color: var(--bg-secondary) !important;
            color: var(--text-secondary) !important;
        }
        body.dark-theme .breadcrumb-item a { color: var(--text-secondary) !important; }
        body.dark-theme .table {
            color: var(--text-primary) !important;
        }
        body.dark-theme .table-hover tbody tr:hover td,
        body.dark-theme .table-hover tbody tr:hover th {
            background-color: var(--bg-secondary) !important;
        }
        body.dark-theme hr { border-color: var(--border-color) !important; }

        /* ===== PAGE LOADER ===== */
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
<body>




      

    <!-- Navbar -->
    @include('show.layouts.navbar')



    <!-- المحتوى -->
    <main class="w-100">
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
    <!-- Footer -->
    @include('show.layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    

    @stack('scripts')

   <script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== Dark Mode Init =====
    // const savedTheme = localStorage.getItem('theme');
    // if (savedTheme === 'dark') {
    //     document.body.classList.add('dark-theme');
    //     const toggle = document.querySelector('.toggle input');
    //     if (toggle) toggle.checked = true;
    // }

    // ===== Loader =====
    const loader = document.getElementById('wifi-loader');
    if (!loader) return;
    loader.classList.remove('active');

    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (!href || href.startsWith('#') || link.target === '_blank') return;
            loader.classList.add('active');
        });
    });
});

window.addEventListener('load', () => {
    const loader = document.getElementById('wifi-loader');
    if (!loader) return;
    loader.classList.remove('active');
});
</script>
</body>
</html>