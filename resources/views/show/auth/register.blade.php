<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - MyShop</title>
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
      background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 50%, #ff6b6b 100%);
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
      filter: blur(90px);
      opacity: 0.45;
      animation: float 22s ease-in-out infinite;
    }

    .shape-1 {
      width: 550px;
      height: 550px;
      background: linear-gradient(135deg, #fc4a1a, #f7b733);
      top: -12%;
      left: -12%;
      animation-delay: 0s;
    }

    .shape-2 {
      width: 480px;
      height: 480px;
      background: linear-gradient(135deg, #ff6b6b, #fc4a1a);
      top: 45%;
      right: -15%;
      animation-delay: -6s;
    }

    .shape-3 {
      width: 380px;
      height: 380px;
      background: linear-gradient(135deg, #f7b733, #ff6b6b);
      bottom: -10%;
      left: 20%;
      animation-delay: -12s;
    }

    .shape-4 {
      width: 280px;
      height: 280px;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      top: 20%;
      right: 20%;
      animation-delay: -18s;
    }

    @keyframes float {
      0%, 100% {
        transform: translate(0, 0) rotate(0deg);
      }
      33% {
        transform: translate(-40px, 40px) rotate(100deg);
      }
      66% {
        transform: translate(30px, -30px) rotate(200deg);
      }
    }

    /* Glass Container */
    .glass-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 440px;
      padding: 20px;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.25);
      padding: 35px 32px;
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
      margin-bottom: 18px;
    }

    .logo-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #fc4a1a, #f7b733);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
      box-shadow: 
        0 10px 25px rgba(252, 74, 26, 0.4),
        inset 0 2px 2px rgba(255, 255, 255, 0.3);
      animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% {
        box-shadow: 0 10px 25px rgba(252, 74, 26, 0.4);
      }
      50% {
        box-shadow: 0 15px 35px rgba(247, 183, 51, 0.6);
      }
    }

    .logo-icon i {
      font-size: 1.8rem;
      color: white;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .glass-card h2 {
      color: white;
      font-weight: 700;
      font-size: 1.3rem;
      margin-bottom: 5px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .glass-card .subtitle {
      color: rgba(255, 255, 255, 0.75);
      font-size: 0.82rem;
      font-weight: 400;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 12px;
      animation: fadeIn 0.6s ease-out;
      animation-fill-mode: both;
    }

    .form-group:nth-child(1) { animation-delay: 0.08s; }
    .form-group:nth-child(2) { animation-delay: 0.12s; }
    .form-group:nth-child(3) { animation-delay: 0.16s; }
    .form-group:nth-child(4) { animation-delay: 0.20s; }

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
      font-size: 0.78rem;
      margin-bottom: 7px;
      display: block;
      letter-spacing: 0.3px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.9rem;
      transition: 0.3s;
      pointer-events: none;
    }

    .glass-input {
      width: 100%;
      background: rgba(255, 255, 255, 0.18);
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      padding: 12px 14px 12px 42px;
      color: white;
      font-size: 0.9rem;
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
      box-shadow: 0 0 25px rgba(247, 183, 51, 0.25);
    }

    .glass-input:focus ~ .input-icon {
      color: white;
    }

    /* Submit Button */
    .glass-btn {
      width: 100%;
      background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%);
      border: none;
      border-radius: 10px;
      padding: 12px;
      color: white;
      font-size: 0.95rem;
      font-weight: 700;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
      box-shadow: 0 10px 30px rgba(252, 74, 26, 0.45);
      letter-spacing: 0.5px;
      margin-top: 10px;
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
      box-shadow: 0 15px 40px rgba(252, 74, 26, 0.6);
    }

    .glass-btn:active {
      transform: translateY(-1px);
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      margin: 16px 0;
      gap: 12px;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background: rgba(255, 255, 255, 0.25);
    }

    .divider-text {
      color: rgba(255, 255, 255, 0.55);
      font-size: 0.75rem;
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
      gap: 10px;
      padding: 12px 16px;
      border-radius: 12px;
      border: none;
      font-size: 0.85rem;
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
      width: 20px;
      height: 20px;
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

    .social-btn.twitter {
      background: #000;
      color: white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .social-btn.twitter:hover {
      background: #1a1a1a;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    }

    .social-btn i {
      font-size: 1.1rem;
    }

    .social-btn.facebook i {
      color: white;
    }

    .social-btn.twitter i {
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
      font-size: 1.3rem;
    }

    .social-btn span {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Login Link */
    .login-section {
      text-align: center;
      padding-top: 5px;
    }

    .login-section p {
      color: rgba(255, 255, 255, 0.75);
      font-size: 0.85rem;
      margin-bottom: 0;
    }

    .login-section a {
      color: #f7b733;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.9rem;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .login-section a:hover {
      color: white;
      text-shadow: 0 0 20px rgba(247, 183, 51, 0.7);
    }

    /* Alert */
    .glass-alert {
      background: rgba(255, 80, 80, 0.35);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 100, 100, 0.5);
      border-radius: 10px;
      color: white;
      padding: 12px 16px;
      margin-bottom: 18px;
      font-size: 0.82rem;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      animation: shake 0.5s ease;
    }

    .glass-alert i {
      font-size: 1rem;
      margin-top: 2px;
    }

    .glass-alert ul {
      margin: 0;
      padding-left: 18px;
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
      font-size: 0.82rem;
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
        padding: 22px 18px;
        border-radius: 16px;
      }
      
      .logo-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
      }
      
      .logo-icon i {
        font-size: 1.5rem;
      }
      
      .glass-card h2 {
        font-size: 1.2rem;
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
          <i class="fa-solid fa-user-plus"></i>
        </div>
        <h2>Create Account</h2>
        <p class="subtitle">Join us and start shopping</p>
      </div>

      <!-- Alert -->
      @if ($errors->any())
        <div class="glass-alert">
          <i class="fa-solid fa-circle-exclamation"></i>
          <div>
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <!-- Register Form -->
      <form method="POST" action="{{ route('customer.register.submit') }}">
        @csrf
        
        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-user me-2"></i>Full Name
          </label>
          <div class="input-wrapper">
            <input type="text" name="name" class="glass-input" 
                   placeholder="Enter your full name" value="{{ old('name') }}" required>
            <i class="fa-solid fa-user-pen input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-envelope me-2"></i>Email Address
          </label>
          <div class="input-wrapper">
            <input type="email" name="email" class="glass-input" 
                   placeholder="Enter your email" value="{{ old('email') }}" required>
            <i class="fa-solid fa-at input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-lock me-2"></i>Password
          </label>
          <div class="input-wrapper">
            <input type="password" name="password" class="glass-input" 
                   placeholder="Enter password (min 6 chars)" required>
            <i class="fa-solid fa-key input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <i class="fa-solid fa-lock me-2"></i>Confirm Password
          </label>
          <div class="input-wrapper">
            <input type="password" name="password_confirmation" class="glass-input" 
                   placeholder="Confirm your password" required>
            <i class="fa-solid fa-shield-halved input-icon"></i>
          </div>
        </div>

        <button type="submit" class="glass-btn">
          <i class="fa-solid fa-user-plus me-2"></i>Create Account
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

      <!-- Login Link -->
      <div class="login-section">
        <p>Already have an account?</p>
        <a href="{{ route('customer.login') }}">
          <i class="fa-solid fa-right-to-bracket"></i>
          Sign In
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