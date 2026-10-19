<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Overview</title>
  <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> -->
   <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #f4f6f9;
      overflow-x: hidden;
      transition: filter 0.3s ease;
    }

    /* زر الموبايل */
    .toggle-btn {
      position: fixed;
      top: 15px;
      left: 15px;
      background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 12px;
      cursor: pointer;
      z-index: 1200;
      display: none;
      transition: all 0.3s ease;
    }

    .toggle-btn:hover {
      background: linear-gradient(90deg, #203a43, #2c5364, #0f2027);
    }

    .toggle-btn:hover i {
      transform: rotate(90deg);
      transition: transform 0.3s ease;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 55px;
      left: 0;
      width: 270px;
      height: calc(100vh - 55px);
      background: linear-gradient(180deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      box-shadow: 2px 0 15px rgba(0,0,0,0.3);
      z-index: 100;
      overflow-y: auto;
      border-right: 1px solid rgba(255,255,255,0.1);
      transform: translateX(0);
      transition: transform 0.4s ease;
    }

    .sidebar .profile {
      text-align: center;
      padding: 25px 15px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar .profile img {
      width: 90px;
      height: 90px;
      border-radius: 30%;
      object-fit: cover;
      margin-bottom: 10px;
      border: 2px solid #30a5ff;
    }

    .sidebar .profile h3 {
      margin: 5px 0;
      font-size: 18px;
      font-weight: 600;
      color: #fff;
    }

    .sidebar .profile span {
      color: #30a5ff;
      font-size: 14px;
    }

    .sidebar .search-box {
      padding: 15px;
    }

    .sidebar .search-box input {
      width: 100%;
      padding: 10px 12px;
      border: none;
      border-radius: 6px;
      background: rgba(255,255,255,0.1);
      color: #fff;
      outline: none;
      transition: background 0.3s ease;
    }

    .sidebar .search-box input::placeholder {
      color: rgba(255,255,255,0.7);
    }

    .sidebar .search-box input:focus {
      background: rgba(255,255,255,0.2);
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 10px 0;
    }

    .sidebar ul li {
      border-left: 3px solid transparent;
      transition: all 0.3s ease;
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .sidebar ul li a i {
      margin-right: 12px;
      font-size: 16px;
      color: #30a5ff;
    }

    .sidebar ul li:hover,
    .sidebar ul li.active {
      background: rgba(255,255,255,0.1);
      border-left: 3px solid #30a5ff;
    }

    .main-content {
      margin-left: 270px;
      padding: 30px;
      transition: margin-left 0.4s ease;
    }

    /* Responsive - Large screens (1920x1080 and similar) */
    @media (max-width: 1920px) {
      .toggle-btn {
        display: block;
        left: auto;
        right: 150px;
      }

    .sidebar {
    top: 55px;
    height: calc(100vh - 55px);

    transform: translateX(-100%);

    box-shadow: 0 0 20px rgba(0,0,0,0.5);
}

      .sidebar.open {
        transform: translateX(0);
        box-shadow: 4px 0 25px rgba(0, 0, 0, 0.6);
      }

      body.sidebar-active .main-content {
        filter: blur(3px);
      }

      .main-content {
        margin-left: 0;
      }
    }

    /* Overlay for mobile sidebar */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 99;
      display: none;
    }

    .sidebar-overlay.active {
      display: block;
    }

    @keyframes pulse {
  0%   { opacity: 1; }
  50%  { opacity: 0.3; }
  100% { opacity: 1; }
}
  </style>
</head>
<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
   <div class="profile">

  <!-- فورم رفع الصورة -->
  <form action="{{ route('admin.update.avatar') }}" method="POST"
        enctype="multipart/form-data" id="avatarForm">
    @csrf

    <!-- الصورة قابلة للضغط -->
    <label for="avatarInput" style="cursor:pointer; position:relative; display:inline-block;">
      <img id="previewImg"
    src="{{ Auth::guard('admin')->user()?->avatar
        ? asset('img/' . Auth::guard('admin')->user()->avatar)
        : asset('img/33.jpg') }}"
    alt="User"
    style="width:90px;height:90px;border-radius:30%;object-fit:cover;border:2px solid #30a5ff;">

      <!-- أيقونة الكاميرا فوق الصورة -->
      <span style="position:absolute; bottom:0; right:0;
                   background:#30a5ff; border-radius:50%;
                   width:25px; height:25px; display:flex;
                   align-items:center; justify-content:center;">
        <i class="fa-solid fa-camera" style="font-size:12px; color:#fff;"></i>
      </span>

    </label>

    <!-- Input مخفي -->
    <input type="file" id="avatarInput" name="avatar"
           accept="image/*" style="display:none;">

  </form>

  <h3>{{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</h3>
  <span>
  <i class="fa-solid fa-circle" style="color:#00ff00; font-size:10px;
     animation: pulse 1.5s infinite;"></i> Online
</span>
</div>

    <div class="search-box">
      <input type="text" placeholder="Search...">
    </div>

    <ul>
      <li><a href="{{ url('admin/index') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
      <li><a href="{{ url('admin/products') }}"><i class="fa-solid fa-box-open"></i> Products</a></li>
       <li><a href="{{ url('admin/orders') }}"><i class="fa-solid fa-box-open"></i> Orders</a></li>
        <li><a href="{{ url('admin/employees') }}"><i class="fa-solid fa-people-group"></i> Employees</a></li>
      <li><a href="{{ url('admin/videos') }}"><i class="fa-solid fa-video"></i> Videos</a></li>
      <li><a href="{{ route('admin.complaints.index') }}"><i class="fa-solid fa-envelope"></i> Complaints</a></li>
      <li><a href="{{ route('admin.settings') }}"><i class="fa-solid fa-gear"></i> Settings</a></li>
      <li><a href="{{ url('admin/login') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
  </div>



  <!-- سكريبت في آخر الصفحة -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const toggleBtn = document.getElementById("toggleSidebar");
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("sidebarOverlay");
      const body = document.body;

      function openSidebar() {
        sidebar.classList.add("open");
        overlay.classList.add("active");
        body.classList.add("sidebar-active");
      }

      function closeSidebar() {
        sidebar.classList.remove("open");
        overlay.classList.remove("active");
        body.classList.remove("sidebar-active");
      }

      // فتح وغلق القائمة
      toggleBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        if (sidebar.classList.contains("open")) {
          closeSidebar();
        } else {
          openSidebar();
        }
      });

      // Close when clicking overlay
      if (overlay) {
        overlay.addEventListener("click", closeSidebar);
      }

      // غلق القائمة عند الضغط خارجها
      document.addEventListener("click", (e) => {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
          closeSidebar();
        }
      });

      // تفعيل الرابط الحالي
      const current = location.pathname.split("/").pop();
      document.querySelectorAll(".sidebar ul li a").forEach(link => {
        if (link.getAttribute("href").includes(current)) {
          link.parentElement.classList.add("active");
        }
      });
    });

  // معاينة الصورة وإرسال الفورم تلقائياً
document.getElementById('avatarInput').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        // معاينة فورية
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
        };
        reader.readAsDataURL(file);

        // إرسال الفورم تلقائياً
        document.getElementById('avatarForm').submit();
    }
});
  </script>

</body>
</html>
