<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>products📦</title>
<link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #0f2027;
    margin: 0;
    padding: 30px;
    overflow-x: hidden; /* شيل scroll جانبي */
}

/* Navbar Base */
.navbar-custom {
    background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
    border-bottom: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.navbar-brand {
    font-weight: 600;
    font-size: 22px;
    color: #fff !important;
    letter-spacing: 1px;
}

.navbar-brand span {
    color: #30a5ff;
}

/* Toggle button */
.navbar-toggle {
    border: none;
    background: transparent !important;
}
.navbar-toggle .icon-bar {
    background-color: #fff;
    transition: all 0.3s ease;
}
.navbar-toggle:hover .icon-bar {
    background-color: #30a5ff;
}

/* Navbar links */
.navbar-nav {
    margin-right: 20px; /* بعد الأيقونات عن الحافة */
}
.navbar-nav > li > a {
    color: #fff !important;
    font-weight: 500;
    padding: 12px 18px;
    font-size: 15px;
    text-transform: capitalize;
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.navbar-nav > li > a i {
    font-size: 16px;
    color: #30a5ff;
}

.navbar-nav > li > a:hover {
    color: #30a5ff !important;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
}

/* Border bottom hover line */
.navbar-nav > li > a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 5px;
    width: 0;
    height: 2px;
    background-color: #30a5ff;
    transition: width 0.3s ease;
}

.navbar-nav > li > a:hover::after {
    width: 100%;
}

/* Animation */
.collapse.in {
    animation: fadeIn 0.3s ease forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Extend collapse for mobile - Large screens (1920x1080 and similar) */
@media (max-width: 1920px) {
    .navbar-collapse {
        background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
        position: absolute;
        top: 56px;
        left: 30;
        width: 100%;
        padding: 10px 0;
    }
    .navbar-nav {
        flex-direction: column;
        text-align: center;
    }
    .navbar-nav > li {
        margin-bottom: 5px;
    }
}

/* Hide links and toggle button on large screens - but show toggle on 1920px */
@media (min-width: 1921px) {
    .navbar-nav {
        display: none;
    }
    .navbar-toggle {
        display: block !important;
    }
}

/* Sidebar Toggle Button */
.sidebar-toggle-btn {
    border: none;
    background: transparent;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: none;
    position: absolute;
    right: 15px;
}

.sidebar-toggle-btn:hover {
    background: rgba(255,255,255,0.1);
    color: #30a5ff;
}

/* =========================================================
   SIDEBAR TOGGLE BUTTON
   يظهر فقط على الشاشات الصغيرة
========================================================= */

.sidebar-toggle-btn {
    border: none;
    background: transparent;

    color: #fff;

    font-size: 20px;

    cursor: pointer;

    padding: 8px 12px;

    border-radius: 6px;

    transition: all 0.3s ease;

    display: none;

    position: absolute;

    right: 15px;

    top: 50%;

    transform: translateY(-50%);

    z-index: 1100;
}

.sidebar-toggle-btn:hover {
    background: rgba(255,255,255,0.1);

    color: #30a5ff;
}


/* =========================================================
   DESKTOP
   Sidebar ظاهر وثابت
========================================================= */

@media (min-width: 1200px) {

    .sidebar-toggle-btn {
        display: none !important;
    }

    .sidebar {
        display: block !important;

        position: fixed !important;

        left: 0;
        top: 0;

        height: 100vh;

        z-index: 1000;

        transform: translateX(0) !important;

        visibility: visible !important;
    }

    .sidebar-overlay {
        display: none !important;
    }

    body {
        padding-left: 250px;
    }
}


/* =========================================================
   TABLET + MOBILE
   Sidebar مخفي والزرار يظهر
========================================================= */

@media (max-width: 1199px) {

    .sidebar-toggle-btn {
        display: block !important;
    }

    .sidebar {
        position: fixed !important;

        top: 0;
        left: 0;

        height: 100vh;

        z-index: 1200;

        transform: translateX(-100%);

        visibility: hidden;

        transition:
            transform 0.3s ease,
            visibility 0.3s ease;
    }

    .sidebar.open {
        transform: translateX(0);

        visibility: visible;
    }

    .sidebar-overlay {
        position: fixed;

        inset: 0;

        background: rgba(0,0,0,0.55);

        opacity: 0;

        visibility: hidden;

        z-index: 1150;

        transition:
            opacity 0.3s ease,
            visibility 0.3s ease;
    }

    .sidebar-overlay.active {
        opacity: 1;

        visibility: visible;
    }

    body {
        padding-left: 0;
    }
}
</style>
</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top shadow-sm" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header" >
            <!-- Sidebar Toggle Button -->
           <button
    type="button"
    class="sidebar-toggle-btn"
    id="sidebarToggleBtn"
    title="Toggle Sidebar">

    <i class="fa-solid fa-bars"></i>

</button>

            <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> -->

            <a class="navbar-brand fw-bold" href="{{ url('/show/home') }}">
                <span>my</span> - shop
            </a>
        </div>

        <!-- Navbar Links -->
        <!-- <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('admin/index') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="{{ url('admin/products') }}"><i class="fa-solid fa-box-open"></i> Products</a></li>
                  <li><a href="{{ url('admin/orders') }}"><i class="fa-solid fa-box-open"></i> orders</a></li>
              <li><a href="{{ url('admin/videos') }}"><i class="fa-solid fa-video"></i> Videos</a></li>
				<li><a href="{{ route('admin.complaints.index') }}"><i class="fa-solid fa-envelope"></i> Complaints</a></li>
                 <li><a href="{{ url('admin/employees') }}"><i class="fa-solid fa-users"></i> Employees</a></li>
                 <li><a href="{{ url('admin/settings') }}"><i class="fa-solid fa-gear"></i> Settings</a></li>
                 <li><a href="{{ url('admin/login') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>
    </div> -->
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    var menu = $('#navbar-menu');
    var sidebar = $('#sidebar');
    var sidebarOverlay = $('#sidebarOverlay');

    // حالة المينيو (مفتوح/مقفل)
    var isOpen = false;

    // لما تضغط على الزرار
    $('.navbar-toggle').click(function(e) {
        e.stopPropagation();
        if (!isOpen) {
            menu.slideDown(300);
            isOpen = true;
        } else {
            menu.slideUp(300);
            isOpen = false;
        }
    });

    // لما تضغط على أي لينك في المينيو يقفله
    $('#navbar-menu a').click(function(){
        menu.slideUp(300);
        isOpen = false;
    });

    // لما تضغط بره المينيو يقفله
    $(document).click(function(event) {
        if (!$(event.target).closest('.navbar-toggle, #navbar-menu').length && isOpen) {
            menu.slideUp(300);
            isOpen = false;
        }
    });

    // Sidebar Toggle from Navbar Button
    $('#sidebarToggleBtn').click(function(e) {
        e.stopPropagation();
        if (sidebar.hasClass('open')) {
            sidebar.removeClass('open');
            sidebarOverlay.removeClass('active');
            $('body').removeClass('sidebar-active');
        } else {
            sidebar.addClass('open');
            sidebarOverlay.addClass('active');
            $('body').addClass('sidebar-active');
        }
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.click(function() {
        sidebar.removeClass('open');
        sidebarOverlay.removeClass('active');
        $('body').removeClass('sidebar-active');
    });
});
</script>
</body>
</html>
