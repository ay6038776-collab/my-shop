@extends('layouts.app')
@extends('layouts.sidebar')


@section('content')
<style>
/* ===== الأساسيات ===== */
body {
  font-family: 'Poppins', sans-serif;
  background: #f3f4f6;
  color: #1f2937;
  margin: 0;
  transition: background 0.4s ease, color 0.4s ease;
}

/* ===== العنوان ===== */
h1 {
  text-align: center;
  color: #4f46e5;
  font-weight: 700;
  margin: 60px 0 40px;
  font-size: 34px;
  animation: fadeInDown 0.8s ease;
}

/* ===== بطاقات الإحصائيات ===== */
.stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
}

.card {
  background: #fff;
  border-radius: 18px;
  padding: 30px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  text-align: center;
  transition: transform 0.4s, box-shadow 0.4s;
  animation: fadeInUp 1s ease;
}

.card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 20px 40px rgba(79,70,229,0.2);
}

.card h4 {
  font-size: 20px;
  color: #1e293b;
}

.card p {
  font-size: 26px;
  color: #4f46e5;
  font-weight: bold;
}

/* ===== جدول المنتجات ===== */
.table-wrapper {
  background: #fff;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0,0,0,0.05);
  animation: fadeInUp 1s ease;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  padding: 14px 18px;
  text-align: center;
  transition: all 0.3s;
}

.table th {
  background: linear-gradient(135deg, #eef2ff, #e0e7ff);
  color: #4338ca;
  text-transform: uppercase;
  font-weight: 600;
}

.table tr:hover td {
  background: #eef2ff;
  color: #4338ca;
  transform: scale(1.01);
}

/* ===== شريط الإشعار ===== */
#order-alert {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 1000;
  transition: opacity 0.5s ease, transform 0.5s ease;
  
}

#order-alert.hide {
  opacity: 0;
  transform: translateY(-20px);
}
</style>

@php
    // جلب أول إشعار جديد من الأوردرات (لو موجود)
    $orderNotification = $notifications->first() ?? null;

    // تحويله لمقروءة عند تحميل الصفحة
    if($orderNotification){
        $orderNotification->markAsRead();
    }
@endphp

<div class="container py-5">
  <h1>📊 Dashboard Overview</h1>

  {{-- شريط الإشعار --}}
  @if($orderNotification)
  <div id="order-alert" class="alert alert-success">
      <strong>اشعار جديد!</strong> {{ $orderNotification->data['message'] }}
  </div>
  @endif

  {{-- بطاقات الإحصائيات --}}
  <div class="stats">
    <div class="card">
      <h4>Total Products</h4>
      <p>{{ $productsCount ?? 0 }}</p>
    </div>
    <div class="card">
      <h4>Total Value</h4>
      <p>{{ number_format($totalValue ?? 0, 2) }} EGP</p>
    </div>
  </div>

  {{-- أحدث المنتجات --}}
  <h3 style="margin-bottom:15px; color:#4f46e5;">🧾 Latest Products</h3>
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Added</th>
        </tr>
      </thead>
      <tbody>
        @forelse($latestProducts as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }} EGP</td>
            <td>{{ $product->created_at ? $product->created_at->format('Y-m-d') : '-' }}</td>
          </tr>
        @empty
          <tr><td colspan="4">No products found 🚀</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- جافاسكربت لإخفاء شريط الإشعار بعد ثانيتين --}}
@if($orderNotification)
<script>
    setTimeout(() => {
        let alert = document.getElementById('order-alert');
        if(alert){
            alert.classList.add('hide');
        }
    }, 2000); // 2 ثانيتين
</script>
@endif

@endsection