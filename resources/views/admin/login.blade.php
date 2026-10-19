<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - MyShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      position: relative;
      overflow: hidden;
    }

    /* Animated Background Shapes */
    .bg-shapes {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .shape {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.6;
      animation: float 20s ease-in-out infinite;
    }

    .shape-1 {
      width: 500px;
      height: 500px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      top: -10%;
      left: -10%;
      animation-delay: 0s;
    }

    .shape-2 {
      width: 400px;
      height: 400px;
      background: linear-gradient(135deg, #f093fb, #f5576c);
      top: 50%;
      right: -10%;
      animation-delay: -5s;
    }

    .shape-3 {
      width: 350px;
      height: 350px;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      bottom: -10%;
      left: 30%;
      animation-delay: -10s;
    }

    .shape-4 {
      width: 250px;
      height: 250px;
      background: linear-gradient(135deg, #fa709a, #fee140);
      top: 20%;
      right: 30%;
      animation-delay: -15s;
    }

    @keyframes float {
      0%, 100% {
        transform: translate(0, 0) rotate(0deg);
      }
      25% {
        transform: translate(50px, 50px) rotate(90deg);
      }
      50% {
        transform: translate(0, 100px) rotate(180deg);
      }
      75% {
        transform: translate(-50px, 50px) rotate(270deg);
      }
    }

    /* Glass Card */
    .glass-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 480px;
      padding: 20px;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 50px 40px;
      box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        inset 0 1px 1px rgba(255, 255, 255, 0.4);
      animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Logo & Header */
    .logo-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .logo-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .logo-icon i {
      font-size: 2.5rem;
      color: white;
    }

    .glass-card h2 {
      color: white;
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 8px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .glass-card .subtitle {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.95rem;
      font-weight: 400;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 24px;
      animation: fadeIn 0.8s ease-out;
      animation-fill-mode: both;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .form-label {
      color: rgba(255, 255, 255, 0.9);
      font-weight: 600;
      font-size: 0.9rem;
      margin-bottom: 10px;
      display: block;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      font-size: 1.1rem;
      transition: 0.3s;
    }

    .glass-input {
      width: 100%;
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 14px;
      padding: 16px 18px 16px 50px;
      color: white;
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
      transition: 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .glass-input::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    .glass-input:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.8);
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }

    .glass-input:focus + .input-icon,
    .glass-input:focus ~ .input-icon {
      color: white;
    }

    /* Remember Me */
    .form-check {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 24px;
    }

    .form-check-input {
      width: 20px;
      height: 20px;
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 6px;
      cursor: pointer;
      position: relative;
    }

    .form-check-input:checked {
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-color: transparent;
    }

    .form-check-input:checked::after {
      content: '✓';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 0.8rem;
      font-weight: bold;
    }

    .form-check-label {
      color: rgba(255, 255, 255, 0.9);
      font-size: 0.9rem;
      cursor: pointer;
    }

    /* Submit Button */
    .glass-btn {
      width: 100%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 14px;
      padding: 18px;
      color: white;
      font-size: 1.1rem;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
      position: relative;
      overflow: hidden;
    }

    .glass-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: 0.5s;
    }

    .glass-btn:hover::before {
      left: 100%;
    }

    .glass-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
    }

    .glass-btn:active {
      transform: translateY(-1px);
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      margin: 30px 0;
      gap: 15px;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background: rgba(255, 255, 255, 0.3);
    }

    .divider-text {
      color: rgba(255, 255, 255, 0.6);
      font-size: 0.85rem;
    }

    /* Footer Links */
    .footer-links {
      text-align: center;
      margin-top: 30px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .footer-links a:hover {
      color: white;
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    }

    /* Alert */
    .glass-alert {
      background: rgba(255, 100, 100, 0.3);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 100, 100, 0.5);
      border-radius: 12px;
      color: white;
      padding: 15px 20px;
      margin-bottom: 25px;
      font-size: 0.9rem;
      animation: shake 0.5s ease;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* Responsive */
    @media (max-width: 576px) {
      .glass-card {
        padding: 35px 25px;
        border-radius: 20px;
      }
      
      .logo-icon {
        width: 65px;
        height: 65px;
      }
      
      .logo-icon i {
        font-size: 2rem;
      }
      
      .glass-card h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Background Shapes -->
  <div class="bg-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
  </div>

  <!-- Glass Card -->
  <div class="glass-container">
    <div class="glass-card">
      
      <!-- Logo -->
      <div class="logo-section">
        <div class="logo-icon">
          <i class="fa-solid fa-user-shield"></i>
        </div>
        <h2>Welcome Back</h2>
        <p class="subtitle">Sign in to your Admin Dashboard</p>
      </div>

      <!-- Error Alert -->
      @if(session('error'))
        <div class="glass-alert">
          <i class="fa-solid fa-circle-exclamation me-2"></i>
          {{ session('error') }}
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        
        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-envelope me-2"></i>Email Address
          </label>
          <div class="input-wrapper">
            <input type="email" name="email" class="glass-input" 
                   placeholder="Enter your email" required autofocus>
            <i class="fa-solid fa-at input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-lock me-2"></i>Password
          </label>
          <div class="input-wrapper">
            <input type="password" name="password" class="glass-input" 
                   placeholder="Enter your password" required>
            <i class="fa-solid fa-key input-icon"></i>
          </div>
        </div>

        <div class="form-check">
          <input type="checkbox" name="remember" class="form-check-input" id="remember">
          <label for="remember" class="form-check-label">Remember me</label>
        </div>

        <button type="submit" class="glass-btn">
          <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
        </button>
      </form>

      <!-- Footer -->
      <div class="footer-links">
        <a href="{{ url('/') }}">
          <i class="fa-solid fa-arrow-left"></i>
          Back to Website
        </a>
      </div>
    </div>
  </div>
</body>
</html>