@extends('show.layouts.app')
@section('title', 'My Orders - Order History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/order/index.css') }}">

<div class="container my-5">
    <div class="card">
        <div class="card-header">🧾 My Orders</div>
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="text-center text-muted fs-5">You don’t have any orders yet 🛍</div>
            @else
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Expires In</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index => $order)
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    {{-- اسم المنتج + الخصم --}}
                                    <td>
                                        <div class="fw-bold">{{ $item->product->name ?? 'Deleted Product' }}</div>
                                        @if($item->product && $item->product->isOnDiscount())
                                            <div class="mt-1">
                                                <span class="badge bg-danger">
                                                    -{{ $item->product->discount_percentage }}%
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- اللون --}}
                                    <td>
                                        @if($item->color_class)
                                            <span class="color-circle {{ $item->color_class }}"></span>
                                            <span class="ms-2 text-capitalize">{{ str_replace('-', ' ', $item->color_class) }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    {{-- الصورة --}}
                                    <td>
                                        @php
                                            $imagePath = $item->product->img ?? null;
                                            if ($imagePath && file_exists(public_path('storage/' . $imagePath))) {
                                                $imagePath = asset('storage/' . $imagePath);
                                            } elseif ($imagePath && file_exists(public_path('img/' . $imagePath))) {
                                                $imagePath = asset('img/' . $imagePath);
                                            } else {
                                                $imagePath = 'https://via.placeholder.com/50x50?text=No+Image';
                                            }
                                        @endphp
                                        <img src="{{ $imagePath }}" alt="{{ $item->product->name ?? 'Product' }}" class="product-img">
                                    </td>

                                    {{-- الكمية --}}
                                    <td>{{ $item->quantity }}</td>

                                    {{-- السعر بعد الخصم + السعر قبل الخصم --}}
                                    <td>
                                        @php
                                            $price = $item->product ? $item->product->discounted_price : $item->price;
                                            $itemTotal = $price * $item->quantity;
                                        @endphp

                                        @if($item->product && $item->product->isOnDiscount())
                                            <small class="text-muted text-decoration-line-through d-block">
                                                {{ number_format($item->product->price * $item->quantity, 2) }} EGP
                                            </small>
                                        @endif

                                        <span class="fw-bold">{{ number_format($itemTotal,2) }} EGP</span>
                                    </td>

                                    {{-- الحالة --}}
                                    <td>
                                        <span class="status-{{ strtolower($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>

                                    {{-- عداد انتهاء --}}
                                    <td>
                                        @if($order->status !== 'expired')
                                            <span class="countdown" data-expires="{{ $order->expires_at }}"></span>
                                        @else
                                            <span class="countdown expired">Expired</span>
                                        @endif
                                    </td>

                                    {{-- تاريخ الطلب --}}
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const countdowns = document.querySelectorAll('.countdown');

    countdowns.forEach(span => {
        const expiresAt = span.dataset.expires ? new Date(span.dataset.expires).getTime() : null;
        if(!expiresAt) return;

        const updateCountdown = () => {
            const now = new Date().getTime();
            let distance = expiresAt - now;

            if(distance <= 0){
                span.innerText = "Expired";
                span.classList.add('expired');
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            span.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        };

        updateCountdown();
        const interval = setInterval(updateCountdown, 1000);
    });
});
</script>
@endsection