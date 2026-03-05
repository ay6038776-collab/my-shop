<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Overview</title>
  <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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

    /* Responsive */
    @media (max-width: 992px) {
      .toggle-btn {
        display: block;
      }

      .sidebar {
        top: 0;
        height: 100vh;
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
  </style>
</head>
<body>

  

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="profile">
      <img src="{{ asset('img/33.jpg') }}" alt="User">
      <h3>Ahmed Yasser</h3>
      <span><i class="fa-solid fa-circle" style="color:#30a5ff;font-size:10px;"></i> Online</span>
    </div>

    <div class="search-box">
      <input type="text" placeholder="Search...">
    </div>

    <ul>
      <li><a href="{{ url('admin/index') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
      <li><a href="{{ url('admin/products') }}"><i class="fa-solid fa-box-open"></i> Products</a></li>
       <li><a href="{{ url('admin/orders') }}"><i class="fa-solid fa-box-open"></i> orders</a></li>
        <li><a href="{{ url('admin/employees') }}"><i class="fa-solid fa-people-group"></i> employees</a></li>
      <li><a href="{{ url('admin/videos') }}"><i class="fa-solid fa-video"></i> Videos</a></li>
      <li><a href="{{ route('admin.complaints.index') }}"><i class="fa-solid fa-envelope"></i> Complaints</a></li>
      <li><a href="{{ url('admin/login') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
  </div>

  

  <!-- سكريبت في آخر الصفحة -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const toggleBtn = document.getElementById("toggleSidebar");
      const sidebar = document.getElementById("sidebar");
      const body = document.body;

      // فتح وغلق القائمة
      toggleBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        sidebar.classList.toggle("open");
        body.classList.toggle("sidebar-active");
      });

      // غلق القائمة عند الضغط خارجها
      document.addEventListener("click", (e) => {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
          sidebar.classList.remove("open");
          body.classList.remove("sidebar-active");
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
  </script>

</body>
</html>
