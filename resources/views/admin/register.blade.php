<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
      direction: rtl;
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



    @keyframes float {
      from { transform: translateY(0) rotate(0); }
      to { transform: translateY(30px) rotate(360deg); }
    }

    /* الكارت */
    .register-card {
      position: relative;
      z-index: 10;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 30px;
      width: 100%;
      max-width: 420px;
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

    .register-card h2 {
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

    /* أزرار */
    .btn-register, .btn-login-back {
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

    .btn-register {
      background: linear-gradient(135deg, #00b09b, #96c93d);
      animation: pulse 2s infinite;
    }

    .btn-login-back {
      background: linear-gradient(135deg, #ff512f, #dd2476);
    }

    .btn-register:hover, .btn-login-back:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(255,255,255,0.5);
    }

    @keyframes pulse {
      0% { box-shadow: 0 0 5px #00b09b; }
      50% { box-shadow: 0 0 20px #96c93d; }
      100% { box-shadow: 0 0 5px #00b09b; }
    }
  </style>
</head>
<body>

  <div class="stars"></div>
  

  <div class="register-card">
    <h2>✨ إنشاء حساب جديد ✨</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <div class="form-group mb-3">
        <input class="form-control" placeholder="الاسم" name="name" type="text" required>
      </div>
      <div class="form-group mb-3">
        <input class="form-control" placeholder="البريد الإلكتروني" name="email" type="email" required>
      </div>
      <div class="form-group mb-3">
        <input class="form-control" placeholder="كلمة المرور" name="password" type="password" required>
      </div>
      <div class="form-group mb-3">
        <input class="form-control" placeholder="تأكيد كلمة المرور" name="password_confirmation" type="password" required>
      </div>
      <button type="submit" class="btn-register">تسجيل</button>
      <a href="{{ route('login') }}" class="btn-login-back d-block text-center">🔑 لدي حساب بالفعل</a>
    </form>
  </div>

</body>
</html>