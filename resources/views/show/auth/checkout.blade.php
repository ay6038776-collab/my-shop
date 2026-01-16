@extends('show.layouts.app')
@section('title', 'Checkout - Complete Your Order')
@section('content')

<link href="{{ asset('css/chech.css') }}" rel="stylesheet">

<div class="container my-5">
    <div class="row justify-content-center">

        <!-- Order Summary -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-white text-center"
                     style="background: linear-gradient(135deg, #0984e3, #74b9ff);">
                    🛒 Order Summary
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">

                        @php
                            $subtotal = 0;
                        @endphp

                        @foreach($cartItems as $item)
                            @php
                                // نفس منطق الكارت بالظبط
                                $price = $item->product->discounted_price;
                                $quantity = $item->quantity;
                                $itemTotal = $price * $quantity;
                                $subtotal += $itemTotal;
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $item->product->name }} × {{ $quantity }}

                                    @if($item->product->isOnDiscount())
                                        <div class="small text-muted">
                                            <del>{{ number_format($item->product->price,2) }} EGP</del>
                                            <span class="text-danger ms-1">
                                                -{{ $item->product->discount_percentage }}%
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <span class="fw-bold">
                                    {{ number_format($itemTotal,2) }} EGP
                                </span>
                            </li>
                        @endforeach

                        @php
                            $shipping = 50;
                            $total = $subtotal + $shipping;
                        @endphp

                        <li class="list-group-item d-flex justify-content-between">
                            Subtotal
                            <span class="fw-bold">{{ number_format($subtotal,2) }} EGP</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            Shipping
                            <span class="fw-bold">{{ number_format($shipping,2) }} EGP</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between fw-bold fs-5">
                            Total
                            <span class="text-success">{{ number_format($total,2) }} EGP</span>
                        </li>

                    </ul>

                    <a href="{{ route('cart.index') }}"
                       class="btn btn-outline-secondary w-100 py-2 mt-2 rounded-pill">
                        ⬅ Back to Cart
                    </a>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-lg-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-white text-center"
                     style="background: linear-gradient(135deg, #00b894, #00cec9);">
                    Complete Your Order
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Shipping Address</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option selected disabled>Select Payment Method</option>
                                <option value="cash">💵 Cash on Delivery</option>
                                <option value="card">💳 Credit Card</option>
                                <option value="vodafone">📱 Vodafone Cash</option>
                            </select>
                        </div>

                        {{-- للعرض فقط – مش للحساب --}}
                        <input type="hidden" name="display_total" value="{{ $total }}">

                        <button type="submit"
                                class="btn btn-primary w-100 py-3 rounded-pill fs-5">
                            ✅ Confirm & Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection