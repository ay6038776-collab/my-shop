@extends('layouts.app')


@section('title', '📦 All Orders')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #eef2ff, #f9fafb);
        font-family: 'Poppins', sans-serif;
        color: #1e293b;
        overflow-x: hidden;
        transition: background 0.4s ease;
    }

    h2 {
        font-weight: 700;
        font-size: 34px;
        color: #4338ca;
        text-align: center;
        margin: 40px 0;
        letter-spacing: 1px;
        text-shadow: 0 3px 10px rgba(67,56,202,0.15);
        animation: fadeDown 0.8s ease;
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes smoothUp {
        from { transform: translateY(10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .orders-container {
        margin-top: 20px;
        padding: 20px;
        animation: smoothUp 0.7s ease;
    }

    .order-card {
        background: linear-gradient(145deg, #ffffff, #f3f4f6);
        border: 1px solid rgba(99,102,241,0.08);
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(79,70,229,0.08);
        margin-bottom: 35px;
        padding: 25px;
        backdrop-filter: blur(10px);
        transition: all 0.4s ease;
        transform: translateY(0);
    }

    .order-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(99,102,241,0.15);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .order-header h5 {
        color: #4f46e5;
        font-weight: 700;
        font-size: 18px;
    }

    .customer-info {
        text-align: right;
        font-size: 14px;
        color: #374151;
    }

    .product-row {
        display: grid;
        grid-template-columns: 90px 1fr 120px 80px;
        align-items: center;
        border-top: 1px solid #f1f5f9;
        padding: 15px 0;
        transition: all 0.2s ease;
    }

    .product-row:hover {
        background-color: rgba(99,102,241,0.05);
        transform: scale(1.01);
    }

    .product-image {
        width: 75px;
        height: 75px;
        border-radius: 12px;
        overflow: hidden;
        background-color: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product-name {
        font-weight: 600;
        color: #111827;
        font-size: 15px;
    }

    .product-category {
        color: #6b7280;
        font-size: 13px;
    }

    .product-color {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 5px;
        font-size: 13px;
        color: #374151;
    }

    .product-quantity {
        font-weight: 600;
        color: #10b981;
        text-align: center;
        font-size: 14px;
    }

    .product-price {
        color: #ef4444;
        font-weight: 700;
        font-size: 14px;
        text-align: right;
    }

    .product-discount {
        font-size: 12px;
        color: #ef4444;
        margin-top: 2px;
    }

    .order-footer {
        border-top: 1px solid #e5e7eb;
        padding-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .total-price {
        font-size: 17px;
        font-weight: 700;
        color: #ef4444;
    }

    .contact-btn {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 600;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(99,102,241,0.2);
    }

    .contact-btn:hover {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99,102,241,0.25);
    }

    .no-orders {
        background: rgba(254,240,138,0.3);
        color: #92400e;
        border: 1px solid #fcd34d;
        text-align: center;
        border-radius: 12px;
        padding: 25px;
        font-weight: 500;
        margin-top: 40px;
        animation: smoothUp 0.8s ease;
    }

    @media (max-width: 768px) {
        .order-header { flex-direction: column; gap: 10px; align-items: flex-start; }
        .product-row { grid-template-columns: 70px 1fr; row-gap: 10px; }
        .product-price, .product-quantity { text-align: left; }
    }

    .color-circle {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: inline-block;
    border: 1px solid #ccc;
    vertical-align: middle;
    background-color: transparent; /* default */
    background-color: var(--color, transparent);
}
</style>

<div class="container orders-container">
    <h2>📦 All Orders</h2>

    @if($orders->isEmpty())
        <div class="no-orders">
            🚫 No orders available.
        </div>
    @else
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <h5>🧾 Order {{ $order->id }}</h5>
                    <div class="customer-info">
                        👤 {{ $order->customer->name ?? 'Not Available' }}<br>
                        ✉ {{ $order->customer->email ?? 'Not Available' }}<br>
                        📅 {{ $order->created_at->format('Y-m-d') }}
                    </div>
                </div>

                @php
                    $calculatedTotal = 0;
                @endphp

                @if($order->items && $order->items->count() > 0)
                    @foreach($order->items as $item)
                        @php
                            $price = $item->product ? $item->product->discounted_price : $item->price;
                            $calculatedTotal += $price * $item->quantity;
                        @endphp

                        <div class="product-row">
                           <div class="product-image">
    @php
        $imagePath = null;

        if(isset($item->product->img) && $item->product->img){
            // لو الصورة JSON (أكثر من صورة)
            $decodedImages = json_decode($item->product->img, true);
            if(is_array($decodedImages) && count($decodedImages)){
                $imagePath = $decodedImages[0]; // أول صورة
            } else {
                $imagePath = $item->product->img; // نص عادي
            }
        }

        // التأكد من وجود الصورة في المسارات
        if($imagePath && file_exists(public_path('storage/' . $imagePath))){
            $imagePath = asset('storage/' . $imagePath);
        } elseif($imagePath && file_exists(public_path('img/' . $imagePath))){
            $imagePath = asset('img/' . $imagePath);
        } else {
            $imagePath = 'https://via.placeholder.com/75x75?text=No+Image';
        }
    @endphp
    <img src="{{ $imagePath }}" alt="{{ $item->product->name ?? 'Product' }}">
</div>

                            <div>
                                <div class="product-name">{{ $item->product->name ?? 'Deleted Product' }}</div>
                                <div class="product-category">Category: {{ $item->product->category->name ?? 'N/A' }}</div>

                                {{-- اللون --}}
                           @if(!empty($item->color_class))
    @php
        // تنظيف القيمة والتأكد إنها نص صالح للـ CSS
        $color = preg_match('/^[a-zA-Z]+$/', $item->color_class) ? $item->color_class : 'transparent';
    @endphp
    <div class="product-color">
        <span class="color-circle" style="--color: {{ $color }};"></span>
        <span class="ms-2 text-capitalize">{{ str_replace('-', ' ', $item->color_class) }}</span>
        
        <span>{{ $item->color }}</span>
    </div>
@endif

                                {{-- الخصم --}}
                                @if($item->product && $item->product->isOnDiscount())
                                    <div class="product-discount">Discount: {{ $item->product->discount_percentage }}%</div>
                                @endif
                            </div>

                            <div class="product-quantity">Qty: {{ $item->quantity }}</div>
                            <div class="product-price">{{ number_format($price * $item->quantity, 2) }} EGP</div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">No products in this order.</p>
                @endif

                <div class="order-footer">
                    <div class="total-price">Total: {{ number_format($calculatedTotal, 2) }} EGP</div>

                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                                @csrf
                                <button type="submit" class="approve-btn" style="background-color:#10b981;color:white;border:none;padding:6px 12px;border-radius:6px;font-weight:600;cursor:pointer;">✔ موافقة</button>
                            </form>
                            <form method="POST" action="{{ route('orders.reject', $order->id) }}">
                                @csrf
                                <button type="submit" class="reject-btn" style="background-color:#ef4444;color:white;border:none;padding:6px 12px;border-radius:6px;font-weight:600;cursor:pointer;">✖ رفض</button>
                            </form>
                        @else
                            <span class="text-muted">Status: {{ ucfirst($order->status) }}</span>
                        @endif

                        @if(isset($order->customer->email))
                            <a href="mailto:{{ $order->customer->email }}" class="contact-btn">✉ Contact Customer</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection