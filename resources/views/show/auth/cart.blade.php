@extends('show.layouts.app')
@section('title', 'My Cart - Shopping Cart')
@section('content')

<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="container py-5">
    <h1 class="text-center mb-5 display-4 fw-bold">🛒 My Cart</h1>

    @if($cartItems->count() > 0)
        <div class="row g-4">

            {{-- Cart Items --}}
            <div class="col-lg-8">
                <div id="cart-items">
                    @foreach($cartItems as $item)
                        @php
                            $product = $item->product;
                            $price = $product->discounted_price;
                            $original = $product->price;
                        @endphp

                        <div class="card mb-4 shadow-sm rounded-4 cart-item" data-id="{{ $item->id }}">
                            <div class="row g-3 align-items-center p-3">

                                {{-- CHECKBOX --}}
                                <div class="col-md-1 text-center">
                                    <input type="checkbox" class="form-check-input item-checkbox">
                                </div>

                                {{-- PRODUCT IMAGE --}}
                                <div class="col-md-2">
                                    <img src="{{ $product->img ? asset('img/'.$product->img) : 'https://via.placeholder.com/100' }}" 
                                         class="img-fluid rounded-3" alt="{{ $product->name }}">
                                </div>

                                {{-- PRODUCT INFO --}}
                                <div class="col-md-4">
                                    <h5 class="fw-bold">{{ $product->name }}</h5>
                                    <small class="text-muted">SKU: {{ $product->id }}</small>

                                    {{-- ✅ دائرة اللون الصغيرة --}}
                                    <div class="mt-2 d-flex align-items-center">
                                        <span class="color-circle {{ $item->color_class }}"></span>
                                    </div>

                                    {{-- الخصم --}}
                                    @if($product->isOnDiscount())
                                        <div class="mt-2">
                                            <span class="badge bg-danger fs-6">
                                                -{{ $product->discount_percentage }}%
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- QUANTITY --}}
                                <div class="col-md-2 text-center">
                                    <label class="small text-muted mb-1 d-block">Quantity</label>
                                    <div class="d-flex justify-content-center align-items-center border rounded p-1">
                                        <button class="btn btn-sm btn-outline-danger btn-decrease" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                        <span class="px-3 qty-display fw-bold">{{ $item->quantity }}</span>
                                        <button class="btn btn-sm btn-outline-success btn-increase">+</button>
                                    </div>
                                </div>

                                {{-- PRICE --}}
                                <div class="col-md-2 text-end">
                                    @if($product->isOnDiscount())
                                        <small class="text-muted text-decoration-line-through d-block">
                                            {{ number_format($original,2) }} EGP
                                        </small>
                                    @endif
                                    <h5 class="text-primary fw-bold total-price mt-1">
                                        {{ number_format($price * $item->quantity,2) }} EGP
                                    </h5>
                                </div>

                                {{-- DELETE --}}
                                <div class="col-md-1 text-center">
                                    <button class="btn btn-sm btn-outline-danger btn-delete-single">&times;</button>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                        ← Continue Shopping
                    </a>
                   
                </div>

                <button class="btn btn-outline-danger w-100 mt-3 py-2 rounded-pill" id="clear-cart">
                    Clear Cart
                </button>
            </div>

            {{-- SUMMARY --}}
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm rounded-4 summary-card">
                    @php
                        $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);
                        $shipping = 50;
                        $total = $subtotal + $shipping;
                    @endphp

                    <h5 class="fw-bold text-center mb-4 fs-4">Order Summary</h5>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            Subtotal
                            <span id="subtotal" class="fw-bold">{{ number_format($subtotal,2) }} EGP</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            Shipping
                            <span id="shipping" class="fw-bold">{{ number_format($shipping,2) }} EGP</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between mt-3 border-top pt-3">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-4 text-success" id="total">{{ number_format($total,2) }} EGP</span>
                        </li>
                    </ul>

                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 py-3 rounded-pill fs-5">
                        Proceed to Checkout →
                    </a>
                </div>
            </div>

        </div>
    @else
        <div class="card p-5 text-center shadow-lg rounded-4">
            <h3 class="mb-3">Your cart is empty 😔</h3>
            <a href="{{ route('show.products.index') }}" class="btn btn-primary px-5 py-2 rounded-pill">
                Start Shopping 🛍
            </a>
        </div>
    @endif
</div>

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/cart.js') }}"></script>
@endpush

@endsection