<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Login - MyShop</title>
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
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 50%, #0f3443 100%);
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
      opacity: 0.5;
      animation: float 25s ease-in-out infinite;
    }

    .shape-1 {
      width: 600px;
      height: 600px;
      background: linear-gradient(135deg, #11998e, #38ef7d);
      top: -15%;
      left: -15%;
      animation-delay: 0s;
    }

    .shape-2 {
      width: 450px;
      height: 450px;
      background: linear-gradient(135deg, #0f3443, #34e89e);
      top: 40%;
      right: -12%;
      animation-delay: -7s;
    }

    .shape-3 {
      width: 400px;
      height: 400px;
      background: linear-gradient(135deg, #38ef7d, #11998e);
      bottom: -12%;
      left: 25%;
      animation-delay: -14s;
    }

    .shape-4 {
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #f093fb, #f5576c);
      top: 15%;
      right: 25%;
      animation-delay: -21s;
    }

    @keyframes float {
      0%, 100% {
        transform: translate(0, 0) rotate(0deg) scale(1);
      }
      33% {
        transform: translate(30px, -30px) rotate(120deg) scale(1.1);
      }
      66% {
        transform: translate(-20px, 20px) rotate(240deg) scale(0.9);
      }
    }

    /* Glass Container */
    .glass-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.25);
      padding: 38px 36px;
      box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.3),
        inset 0 1px 1px rgba(255, 255, 255, 0.5);
      animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(60px) scale(0.95);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Logo Section */
    .logo-section {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-icon {
      width: 65px;
      height: 65px;
      background: linear-gradient(135deg, #11998e, #38ef7d);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      box-shadow:
        0 10px 25px rgba(17, 153, 142, 0.4),
        inset 0 2px 2px rgba(255, 255, 255, 0.3);
      animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% {
        box-shadow: 0 10px 25px rgba(17, 153, 142, 0.4);
      }
      50% {
        box-shadow: 0 15px 35px rgba(17, 153, 142, 0.6);
      }
    }

    .logo-icon i {
      font-size: 2rem;
      color: white;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .glass-card h2 {
      color: white;
      font-weight: 700;
      font-size: 1.4rem;
      margin-bottom: 6px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .glass-card .subtitle {
      color: rgba(255, 255, 255, 0.75);
      font-size: 0.85rem;
      font-weight: 400;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 15px;
      animation: fadeIn 0.6s ease-out;
      animation-fill-mode: both;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.15s; }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateX(-15px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .form-label {
      color: rgba(255, 255, 255, 0.95);
      font-weight: 600;
      font-size: 0.82rem;
      margin-bottom: 8px;
      display: block;
      letter-spacing: 0.3px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.95rem;
      transition: 0.3s;
      pointer-events: none;
    }

    .glass-input {
      width: 100%;
      background: rgba(255, 255, 255, 0.18);
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      padding: 14px 16px 14px 46px;
      color: white;
      font-size: 0.95rem;
      font-family: 'Inter', sans-serif;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .glass-input::placeholder {
      color: rgba(255, 255, 255, 0.45);
    }

    .glass-input:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.6);
      background: rgba(255, 255, 255, 0.28);
      box-shadow: 0 0 25px rgba(56, 239, 125, 0.2);
    }

    .glass-input:focus ~ .input-icon {
      color: white;
    }

    /* Submit Button */
    .glass-btn {
      width: 100%;
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
      border: none;
      border-radius: 12px;
      padding: 14px;
      color: white;
      font-size: 1rem;
      font-weight: 700;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
      box-shadow: 0 10px 30px rgba(17, 153, 142, 0.45);
      letter-spacing: 0.5px;
      margin-top: 8px;
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
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
      transition: 0.6s;
    }

    .glass-btn:hover::before {
      left: 100%;
    }

    .glass-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(17, 153, 142, 0.6);
    }

    .glass-btn:active {
      transform: translateY(-1px);
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      margin: 18px 0;
      gap: 12px;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background: rgba(255, 255, 255, 0.25);
    }

    .divider-text {
      color: rgba(255, 255, 255, 0.55);
      font-size: 0.8rem;
      font-weight: 500;
    }

    /* Social Login Buttons */
    .social-buttons {
      display: flex;
      gap: 12px;
      margin-bottom: 8px;
    }

    .social-btn {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 14px;
      border-radius: 12px;
      border: none;
      font-size: 0.82rem;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .social-btn:hover {
      transform: translateY(-3px);
    }

    .social-btn:active {
      transform: translateY(-1px);
    }

    .social-btn.google {
      background: white;
      color: #333;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .social-btn.google:hover {
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .social-btn.google img {
      width: 18px;
      height: 18px;
    }

    .social-btn.facebook {
      background: #1877f2;
      color: white;
      box-shadow: 0 4px 15px rgba(24, 119, 242, 0.4);
    }

    .social-btn.facebook:hover {
      background: #166fe5;
      box-shadow: 0 8px 25px rgba(24, 119, 242, 0.5);
    }

    .social-btn.facebook i {
      font-size: 1.1rem;
      color: white;
    }

    .social-btn.twitter {
      background: #000;
      color: white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .social-btn.twitter:hover {
      background: #1a1a1a;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    }

    .social-btn.twitter i {
      font-size: 1.1rem;
      color: white;
    }

    .social-btn.apple {
      background: #000;
      color: white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .social-btn.apple:hover {
      background: #1a1a1a;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    }

    .social-btn.apple i {
      font-size: 1.2rem;
    }

    /* Register Link */
    .register-section {
      text-align: center;
      padding-top: 5px;
    }

    .register-section p {
      color: rgba(255, 255, 255, 0.75);
      font-size: 0.88rem;
      margin-bottom: 0;
    }

    .register-section a {
      color: #38ef7d;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.95rem;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .register-section a:hover {
      color: white;
      text-shadow: 0 0 20px rgba(56, 239, 125, 0.7);
    }

    /* Alert */
    .glass-alert {
      background: rgba(255, 80, 80, 0.35);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 100, 100, 0.5);
      border-radius: 12px;
      color: white;
      padding: 12px 16px;
      margin-bottom: 18px;
      font-size: 0.85rem;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.5s ease;
    }

    .glass-alert i {
      font-size: 1rem;
    }

    .glass-alert-success {
      background: rgba(56, 239, 125, 0.25);
      border-color: rgba(56, 239, 125, 0.5);
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20% { transform: translateX(-5px); }
      40% { transform: translateX(5px); }
      60% { transform: translateX(-3px); }
      80% { transform: translateX(3px); }
    }

    /* Footer */
    .footer-link {
      text-align: center;
      margin-top: 18px;
    }

    .footer-link a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .footer-link a:hover {
      color: white;
      text-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
    }

    /* Responsive */
    @media (max-width: 576px) {
      .glass-card {
        padding: 25px 20px;
        border-radius: 18px;
      }

      .logo-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
      }

      .logo-icon i {
        font-size: 1.8rem;
      }

      .glass-card h2 {
        font-size: 1.3rem;
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
          <i class="fa-solid fa-bag-shopping"></i>
        </div>
        <h2>Welcome Back</h2>
        <p class="subtitle">Sign in to continue shopping</p>
      </div>

      <!-- Alerts -->
      @if(session('success'))
        <div class="glass-alert glass-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="glass-alert">
          <i class="fa-solid fa-circle-exclamation"></i>
          {{ session('error') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="glass-alert">
          <i class="fa-solid fa-circle-exclamation"></i>
          {{ $errors->first() }}
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="{{ route('customer.login.submit') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-envelope me-2"></i>Email Address
          </label>
          <div class="input-wrapper">
            <input type="email" name="email" class="glass-input"
                 placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
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

        <button type="submit" class="glass-btn">
          <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
        </button>
      </form>

      <!-- Divider -->
      <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-text">OR</span>
        <span class="divider-line"></span>
      </div>

      <!-- Social Login -->
      <div class="social-buttons">
        <a href="{{ url('auth/google') }}" class="social-btn google">
          <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
          Google
        </a>
        <a href="{{ url('auth/facebook') }}" class="social-btn facebook">
          <i class="fa-brands fa-facebook-f"></i>
          Facebook
        </a>
      </div>

      <div class="social-buttons">
        <a href="{{ url('auth/twitter') }}" class="social-btn twitter">
          <i class="fa-brands fa-x-twitter"></i>
          X (Twitter)
        </a>
        <a href="{{ url('auth/apple') }}" class="social-btn apple">
          <i class="fa-brands fa-apple"></i>
          Apple
        </a>
      </div>

      <!-- Register Link -->
      <div class="register-section">
        <p>Don't have an account?</p>
        <a href="{{ route('customer.register') }}">
          <i class="fa-solid fa-user-plus"></i>
          Create Account
        </a>
      </div>

      <!-- Footer -->
      <div class="footer-link">
        <a href="{{ url('/') }}">
          <i class="fa-solid fa-house"></i>
          Back to Home
        </a>
      </div>
    </div>
  </div>
</body>
</html>
