<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

      <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/MYshop5.png">
  <style>
    /* خلفية أساسية */
    body {
      margin: 0;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background: black;
      font-family: "Segoe UI", sans-serif;
    }

    /* طبقة نجوم */
    .stars {
      position: absolute;
      width: 100%;
      height: 100%;
      background: url("https://www.transparenttextures.com/patterns/stardust.png");
      animation: moveStars 200s linear infinite;
    }

    @keyframes moveStars {
      from { background-position: 0 0; }
      to { background-position: -10000px 5000px; }
    }

    /* الكارت */
    .login-card {
      position: relative;
      z-index: 10;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 30px;
      width: 100%;
      max-width: 380px;
      color: white;
      box-shadow: 0 8px 32px rgba(0,0,0,0.5);
      opacity: 0;
      transform: translateY(-50px);
      animation: cardIn 1s ease-out forwards;
    }

    @keyframes cardIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-card h3 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #fff;
    }

    .form-control {
      background: rgba(255,255,255,0.2);
      border: none;
      border-radius: 10px;
      color: #fff;
    }

    .form-control:focus {
      background: rgba(255,255,255,0.3);
      box-shadow: none;
      outline: none;
      color: #fff;
    }

    /* زرار متحرك */
    .btn-login, .btn-register {
      border: none;
      border-radius: 10px;
      color: white;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
      margin-top: 10px;
    }

    .btn-login {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      animation: pulse 2s infinite;
    }

    .btn-register {
      background: linear-gradient(135deg, #ff512f, #dd2476);
    }

    .btn-login:hover, .btn-register:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(255,255,255,0.5);
    }

    @keyframes pulse {
      0% { box-shadow: 0 0 5px #6a11cb; }
      50% { box-shadow: 0 0 20px #2575fc; }
      100% { box-shadow: 0 0 5px #6a11cb; }
    }
  </style>


</head>
<body>

  <div class="stars"></div>

  <div class="login-card">
    <h3>🚀 Login</h3>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="form-check mb-3">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label for="remember" class="form-check-label">Remember Me</label>
      </div>
      <button type="submit" class="btn-login">Login</button>
      <a href="{{ url('admin/register') }}" class="btn-register d-block text-center">إنشاء حساب جديد</a>
    </form>
  </div>

</body>
</html>