@extends('show.layouts.app')
@section('title', 'My Orders - Order History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/order/index.css') }}">

<div class="container my-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-gradient text-white text-center" style="background: linear-gradient(135deg, #0a0f1c, #1a2744);">
            <h3 class="mb-0">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                {{ __('general.my_orders') }}
            </h3>
        </div>
        <div class="card-body p-4">
            @if($orders->isEmpty())
                <div class="text-center text-muted fs-5 py-5">
                    <i class="fa-solid fa-bag-shopping fa-3x mb-3 opacity-25"></i>
                    <p>{{ __('general.empty_cart') }}</p>
                </div>
            @else
                @foreach($orders as $index => $order)
                    <div class="order-card mb-4 p-4 rounded-4 border">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-1">
                                    <i class="fa-solid fa-receipt me-2 text-primary"></i>
                                    {{ __('general.order_number') }}: {{ $order->order_number }}
                                </h5>
                                <small class="text-muted">
                                    {{ $order->created_at->format('Y-m-d H:i') }}
                                </small>
                                <!-- Invoice Download Button -->
                                <a href="{{ route('order.invoice', $order->id) }}"
                                   class="btn btn-sm btn-outline-primary ms-3 rounded-pill"
                                   target="_blank">
                                    <i class="fa-solid fa-file-pdf me-1"></i>
                                    {{ app()->getLocale() == 'ar' ? 'تحميل الفاتورة' : 'Download Invoice' }}
                                </a>
                            </div>
                            <div>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    @if(app()->getLocale() == 'ar')
                                        @switch($order->status)
                                            @case('pending') قيد الانتظار @break
                                            @case('approved') تمت الموافقة @break
                                            @case('rejected') مرفوض @break
                                            @case('completed') مكتمل @break
                                            @default {{ $order->status }}
                                        @endswitch
                                    @else
                                        {{ ucfirst($order->status) }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('general.product') }}</th>
                                    <th>Color</th>
                                    <th>{{ __('general.quantity') }}</th>
                                    <th>{{ __('general.price') }}</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $orderTotal = 0; @endphp
                                @foreach($order->items as $item)
                                    @php
                                        $price = $item->product ? $item->product->discounted_price : $item->price;
                                        $itemTotal = $price * $item->quantity;
                                        $orderTotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @php
                                                    $imagePath = null;
                                                    if($item->product && $item->product->img){
                                                        $decodedImages = json_decode($item->product->img, true);
                                                        if(is_array($decodedImages) && count($decodedImages)){
                                                            $imagePath = $decodedImages[0];
                                                        } else {
                                                            $imagePath = $item->product->img;
                                                        }
                                                    }
                                                    if($imagePath && file_exists(public_path('img/' . $imagePath))){
                                                        $imagePath = asset('img/' . $imagePath);
                                                    } else {
                                                        $imagePath = 'https://via.placeholder.com/50x50?text=No+Image';
                                                    }
                                                @endphp
                                                <img src="{{ $imagePath }}"
                                                     alt="{{ $item->product->name ?? 'Product' }}"
                                                     class="rounded-2"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <strong>{{ $item->product->name ?? 'Deleted Product' }}</strong>
                                                    @if($item->product && $item->product->isOnDiscount())
                                                        <span class="badge bg-danger ms-1">-{{ $item->product->discount_percentage }}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->color)
                                                <span class="color-circle {{ $item->color_class ?? '' }}"></span>
                                                <span class="small">{{ $item->color }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($price, 2) }} EGP</td>
                                        <td class="fw-bold">{{ number_format($itemTotal, 2) }} EGP</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end">
                                        <strong>{{ __('general.total') }}:</strong>
                                    </td>
                                    <td class="fw-bold text-success fs-5">
                                        {{ number_format($order->total_price, 2) }} EGP
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        @if($order->status === 'pending' && $order->expires_at)
                            <div class="mt-3 text-center">
                                <small class="text-muted">{{ __('general.expires_in') }}:</small>
                                <span class="countdown fw-bold text-danger"
                                      data-expires="{{ $order->expires_at }}"></span>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
.order-card {
    background: linear-gradient(to bottom, #ffffff, #f8f9fa);
    transition: all 0.3s ease;
}
.order-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.status-badge {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}
.status-pending { background: #fff3cd; color: #856404; }
.status-approved { background: #d4edda; color: #155724; }
.status-rejected { background: #f8d7da; color: #721c24; }
.status-completed { background: #cce5ff; color: #004085; }
.color-circle {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #ddd;
    vertical-align: middle;
}
</style>

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