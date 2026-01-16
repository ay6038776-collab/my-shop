<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Bootstrap & Icons --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            transition: all 0.4s ease;
        }

        /* ========== DARK MODE ========== */
        body.dark-mode {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #fff;
        }

        /* ========== LIGHT MODE ========== */
        body.light-mode {
            background: #f4f6f8;
            color: #000;
        }

        /* ========== TEXT ========== */
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6,
        body.dark-mode p,
        body.dark-mode span,
        body.dark-mode label {
            color: #fff !important;
        }

        /* ========== TABLES ========== */
        body.dark-mode table {
            background: #121212 !important;
            color: #fff !important;
        }

        body.dark-mode th {
            background: #1f1f1f !important;
            color: #fff !important;
        }

        body.dark-mode td {
            color: #eaeaea !important;
            border-color: rgba(255,255,255,0.15);
        }

        body.dark-mode tbody tr:hover {
            background: rgba(255,255,255,0.07);
        }

        body.dark-mode .table {
            --bs-table-bg: transparent;
            --bs-table-color: #fff;
        }

        /* ========== FORMS ========== */
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: rgba(255,255,255,0.15);
            color: #fff;
            border: none;
        }

        body.dark-mode .form-control::placeholder {
            color: #ccc;
        }

        /* ========== CARDS ========== */
        body.dark-mode .card {
            background: rgba(255,255,255,0.08);
            border: none;
            color: #fff;
        }

        /* ========== TOGGLE ========== */
        .theme-toggle {
            position: fixed;
            left: 25px;
            bottom: 25px;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #203a43;
            color: #30a5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0,0,0,0.35);
            z-index: 9999;
            transition: 0.4s;
        }

        body.light-mode .theme-toggle {
            background: #fff;
           
            color: #ffb300;
        }

        /* =========================
   VARIABLES (أساس التوريث)
========================= */
:root {
    --bg-main: #f8fafc;
    --bg-card: #ffffff;
    --bg-table: #ffffff;

    --text-main: #0f172a;
    --text-muted: #475569;

    --border-color: #e2e8f0;
}

/* =========================
   DARK MODE VARIABLES
========================= */
body.dark-mode {
    --bg-main: #0f172a;
    --bg-card: #020617;
    --bg-table: #020617;

    --text-main: #f8fafc;
    --text-muted: #cbd5f5;

    --border-color: #1e293b;
}

/* =========================
   GLOBAL APPLY
========================= */
body {
    background: var(--bg-main);
    color: var(--text-main);
    transition: all 0.3s ease;
}

/* =========================
   TEXT
========================= */
h1, h2, h3, h4, h5, h6,
p, span, label, small {
    color: var(--text-main);
}

/* =========================
   CARDS
========================= */
.card,
.add-container,
.edit-container,
.dashboard-card {
    background: var(--bg-card);
    color: var(--text-main);
    border: 1px solid var(--border-color);
    border-radius: 12px;
}

/* =========================
   TABLES
========================= */
table {
    width: 100%;
    border-collapse: collapse;
    background: var(--bg-table);
    color: var(--text-main);
}

thead {
    background: rgba(255, 255, 255, 0.05);
}

th, td {
    padding: 12px;
    border: 1px solid var(--border-color);
    color: var(--text-main);
}

/* hover */
tbody tr:hover {
    background: rgba(255, 255, 255, 0.05);
}

/* =========================
   INPUTS
========================= */
input,
select,
textarea {
    background: var(--bg-card);
    color: var(--text-main);
    border: 1px solid var(--border-color);
}

input::placeholder {
    color: var(--text-muted);
}

/* =========================
   BUTTONS
========================= */
button {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
}

button:hover {
    opacity: 0.9;
}

/* =========================
   LINKS
========================= */
a {
    color: #38bdf8;
}
    </style>

    @stack('styles')
</head>

<body class="dark-mode">

    {{-- Theme Toggle Button --}}
    {{-- Navbar --}}
    @includeIf('layouts.navbar')

    
   
    
</body>
</html>