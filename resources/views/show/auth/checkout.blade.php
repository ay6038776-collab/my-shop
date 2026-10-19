@extends('show.layouts.app')
@section('title', 'Checkout - Complete Your Order')
@section('content')

<style>

/* =========================================================
   MODERN CHECKOUT PAGE
   Same Design System — Improved UI / UX
========================================================= */

.checkout-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 40px 0 80px;
}

/* =========================================================
   CHECKOUT HEADER
========================================================= */

.checkout-header {
    text-align: center;
    margin-bottom: 40px;
}

.checkout-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
    letter-spacing: -0.5px;
}

.checkout-header p {
    color: #6b7280;
    font-size: 1.1rem;
    margin: 0;
}

/* =========================================================
   BREADCRUMB
========================================================= */

.checkout-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 24px;
}

.checkout-breadcrumb a {
    color: #667eea;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s ease;
}

.checkout-breadcrumb a:hover {
    color: #764ba2;
}

.checkout-breadcrumb span {
    color: #d1d5db;
    font-size: 0.8rem;
}

.checkout-breadcrumb .current {
    color: #6b7280;
    font-weight: 500;
}

/* =========================================================
   MAIN LAYOUT
========================================================= */

.checkout-container {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 420px;
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: start;
}

/* =========================================================
   FORM CARD
========================================================= */

.checkout-form-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.form-section {
    padding: 32px;
    border-bottom: 1px solid #f3f4f6;
    animation: fadeIn 0.5s ease forwards;
}

.form-section:last-child {
    border-bottom: none;
}

/* =========================================================
   SECTION HEADER
========================================================= */

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}

.section-icon {
    width: 48px;
    height: 48px;
    flex: 0 0 48px;
    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 1.3rem;
}

.section-icon.purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
}

.section-icon.green {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: #ffffff;
}

.section-icon.blue {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: #ffffff;
}

.section-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    line-height: 1.3;
}

.section-subtitle {
    font-size: 0.85rem;
    color: #9ca3af;
    margin: 4px 0 0;
}

/* =========================================================
   FORM FIELDS
========================================================= */

.form-group {
    margin-bottom: 20px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 14px 18px;

    border: 2px solid #e5e7eb;
    border-radius: 14px;

    font-size: 0.95rem;
    color: #1f2937;

    background: #fafafa;

    transition:
        border-color 0.25s ease,
        background 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.2s ease;
}

.form-control:hover {
    border-color: #d1d5db;
    background: #ffffff;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    background: #ffffff;

    box-shadow:
        0 0 0 4px rgba(102, 126, 234, 0.1);
}

.form-control::placeholder {
    color: #9ca3af;
}

textarea.form-control {
    resize: vertical;
    min-height: 90px;
}

/* =========================================================
   FORM ROW
========================================================= */

.form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
}

/* =========================================================
   PAYMENT METHODS
========================================================= */

.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.payment-option {
    position: relative;

    display: flex;
    align-items: center;
    gap: 16px;

    padding: 18px 20px;

    border: 2px solid #e5e7eb;
    border-radius: 16px;

    cursor: pointer;

    background: #fafafa;

    transition:
        border-color 0.25s ease,
        background 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.2s ease;
}

.payment-option:hover {
    border-color: #667eea;
    background: #f5f7ff;
    transform: translateY(-1px);
}

.payment-option.selected {
    border-color: #667eea;

    background:
        linear-gradient(
            135deg,
            rgba(102, 126, 234, 0.05) 0%,
            rgba(118, 75, 162, 0.05) 100%
        );

    box-shadow:
        0 0 0 4px rgba(102, 126, 234, 0.1);
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-radio {
    width: 24px;
    height: 24px;
    flex: 0 0 24px;

    border-radius: 50%;
    border: 2px solid #d1d5db;

    display: flex;
    align-items: center;
    justify-content: center;

    transition:
        border-color 0.2s ease,
        background 0.2s ease;
}

.payment-option.selected .payment-radio {
    border-color: #667eea;
    background: #667eea;
}

.payment-radio::after {
    content: '';

    width: 10px;
    height: 10px;

    border-radius: 50%;
    background: #ffffff;

    opacity: 0;

    transform: scale(0.5);

    transition:
        opacity 0.2s ease,
        transform 0.2s ease;
}

.payment-option.selected .payment-radio::after {
    opacity: 1;
    transform: scale(1);
}

.payment-icon {
    font-size: 1.5rem;
    flex: 0 0 auto;
}

.payment-info {
    flex: 1;
    min-width: 0;
}

.payment-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 2px;
}

.payment-desc {
    font-size: 0.8rem;
    color: #9ca3af;
    line-height: 1.4;
}

/* =========================================================
   PAYMENT METHOD SELECT
========================================================= */

.payment-select-wrapper {
    margin-top: 4px;
}

.payment-select-label {
    display: block;
    margin-bottom: 10px;

    font-size: 0.85rem;
    font-weight: 600;
    color: #4b5563;
}

.payment-select-box {
    position: relative;
    width: 100%;
}

.payment-select {
    width: 100%;
    height: 58px;

    padding: 0 52px 0 18px;

    appearance: none;
    -webkit-appearance: none;

    border: 2px solid #e5e7eb;
    border-radius: 14px;

    background: #fafafa;
    color: #1f2937;

    font-family: inherit;
    font-size: 0.92rem;
    font-weight: 600;

    outline: none;
    cursor: pointer;

    transition:
        border-color 0.25s ease,
        background 0.25s ease,
        box-shadow 0.25s ease;
}

.payment-select:hover {
    background: #ffffff;
    border-color: #cfd4dc;
}

.payment-select:focus {
    background: #ffffff;
    border-color: #667eea;

    box-shadow:
        0 0 0 4px rgba(102, 126, 234, 0.1);
}

.payment-select-arrow {
    position: absolute;

    right: 18px;
    top: 50%;

    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    transform: translateY(-50%);

    border-radius: 8px;

    background: #f1f3f8;
    color: #667eea;

    font-size: 13px;

    pointer-events: none;

    transition:
        background 0.25s ease,
        color 0.25s ease,
        transform 0.25s ease;
}

.payment-select:focus + .payment-select-arrow {
    background: #667eea;
    color: #ffffff;

    transform:
        translateY(-50%)
        rotate(180deg);
}

.payment-select option {
    padding: 12px;

    font-size: 14px;
    font-weight: 500;

    color: #1f2937;
    background: #ffffff;
}

/* =========================================================
   SUBMIT SECTION
========================================================= */

.submit-section {
    padding: 32px;

    background:
        linear-gradient(
            180deg,
            #fafafa 0%,
            #f3f4f6 100%
        );
}

.checkout-submit-btn {
    width: 100%;

    padding: 20px;

    background:
        linear-gradient(
            135deg,
            #667eea 0%,
            #764ba2 100%
        );

    border: none;
    border-radius: 18px;

    color: #ffffff;

    font-size: 1.15rem;
    font-weight: 700;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    box-shadow:
        0 8px 30px rgba(102, 126, 234, 0.35);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        filter 0.25s ease;
}

.checkout-submit-btn:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 40px rgba(102, 126, 234, 0.45);

    filter: brightness(1.03);
}

.checkout-submit-btn:active {
    transform: translateY(0);
}

.checkout-submit-btn:focus-visible {
    outline: none;

    box-shadow:
        0 0 0 4px rgba(102, 126, 234, 0.2),
        0 8px 30px rgba(102, 126, 234, 0.35);
}

.back-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    margin-top: 16px;

    color: #6b7280;
    text-decoration: none;

    font-size: 0.9rem;

    transition:
        color 0.2s ease,
        transform 0.2s ease;
}

.back-link:hover {
    color: #667eea;
    transform: translateX(-2px);
}

/* =========================================================
   ORDER SUMMARY CARD
========================================================= */

.order-summary-card {
    background: #ffffff;

    border-radius: 24px;

    box-shadow:
        0 10px 40px rgba(0, 0, 0, 0.08);

    position: sticky;
    top: 20px;

    height: fit-content;

    overflow: hidden;
}

.summary-header {
    padding: 28px;

    background:
        linear-gradient(
            135deg,
            #667eea 0%,
            #764ba2 100%
        );

    text-align: center;
}

.summary-header h3 {
    color: #ffffff;

    font-size: 1.3rem;
    font-weight: 700;

    margin: 0 0 4px;
}

.summary-header p {
    color: rgba(255, 255, 255, 0.8);

    font-size: 0.85rem;

    margin: 0;
}

.summary-body {
    padding: 24px;
}

/* =========================================================
   PRODUCT LIST
========================================================= */

.product-list {
    max-height: 350px;

    overflow-y: auto;

    margin-bottom: 20px;

    padding-right: 3px;
}

.product-list::-webkit-scrollbar {
    width: 4px;
}

.product-list::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 4px;
}

.product-list::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 4px;
}

.summary-product {
    display: flex;
    align-items: center;

    gap: 14px;

    padding: 14px 0;

    border-bottom: 1px solid #f3f4f6;
}

.summary-product:last-child {
    border-bottom: none;
}

.summary-product-img {
    width: 64px;
    height: 64px;

    flex: 0 0 64px;

    border-radius: 12px;

    object-fit: cover;

    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.1);
}

.summary-product-info {
    flex: 1;
    min-width: 0;
}

.summary-product-name {
    font-size: 0.9rem;
    font-weight: 600;

    color: #1f2937;

    margin-bottom: 4px;

    line-height: 1.3;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;

    overflow: hidden;
}

.summary-product-qty {
    font-size: 0.8rem;
    color: #9ca3af;
}

.summary-product-price {
    flex: 0 0 auto;

    font-size: 0.95rem;
    font-weight: 700;

    color: #667eea;

    white-space: nowrap;
}

/* =========================================================
   SUMMARY TOTALS
========================================================= */

.summary-totals {
    padding-top: 20px;

    border-top:
        2px dashed #e5e7eb;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;

    gap: 20px;

    padding: 10px 0;
}

.summary-row-label {
    font-size: 0.9rem;
    color: #6b7280;
}

.summary-row-value {
    font-size: 0.95rem;
    font-weight: 600;

    color: #1f2937;

    white-space: nowrap;
}

.summary-row.total {
    margin-top: 12px;

    padding-top: 16px;

    border-top:
        2px solid #667eea;
}

.summary-row.total .summary-row-label {
    font-size: 1.1rem;
    font-weight: 700;

    color: #1f2937;
}

.summary-row.total .summary-row-value {
    font-size: 1.4rem;
    font-weight: 800;

    background:
        linear-gradient(
            135deg,
            #667eea 0%,
            #764ba2 100%
        );

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* =========================================================
   SECURITY BADGE
========================================================= */

.security-info {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 10px;

    margin-top: 20px;
    padding: 14px;

    background:
        linear-gradient(
            135deg,
            #f0fdf4 0%,
            #dcfce7 100%
        );

    border-radius: 12px;

    color: #15803d;

    font-size: 0.8rem;
    font-weight: 500;

    text-align: center;
}

.security-info i {
    font-size: 1.1rem;
    flex: 0 0 auto;
}

/* =========================================================
   ANIMATIONS
========================================================= */

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-section:nth-child(1) {
    animation-delay: 0.1s;
}

.form-section:nth-child(2) {
    animation-delay: 0.2s;
}

.form-section:nth-child(3) {
    animation-delay: 0.3s;
}

/* =========================================================
   DARK MODE — PAYMENT SELECT
========================================================= */

.dark .payment-select-label {
    color: #9ca3af;
}

.dark .payment-select {
    background: #151515;
    border-color: #292929;
    color: #ffffff;
}

.dark .payment-select:hover {
    background: #191919;
    border-color: #3a3a3a;
}

.dark .payment-select:focus {
    background: #151515;
    border-color: #667eea;
}

.dark .payment-select-arrow {
    background: #222222;
    color: #8b9cff;
}

.dark .payment-select:focus + .payment-select-arrow {
    background: #667eea;
    color: #ffffff;
}

/* =========================================================
   RESPONSIVE — TABLET
========================================================= */

@media (max-width: 992px) {

    .checkout-container {
        grid-template-columns: 1fr;
        max-width: 760px;
    }

    .order-summary-card {
        position: relative;
        top: auto;
    }

    .product-list {
        max-height: none;
    }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media (max-width: 576px) {

    .checkout-page {
        padding: 25px 12px 50px;
    }

    .checkout-header {
        margin-bottom: 28px;
    }

    .checkout-header h1 {
        font-size: 2rem;
    }

    .checkout-header p {
        font-size: 0.95rem;
    }

    .checkout-breadcrumb {
        gap: 8px;
        margin-bottom: 20px;
    }

    .checkout-breadcrumb a,
    .checkout-breadcrumb .current {
        font-size: 0.82rem;
    }

    .checkout-container {
        gap: 18px;
    }

    .checkout-form-card,
    .order-summary-card {
        border-radius: 18px;
    }

    .form-section {
        padding: 24px 18px;
    }

    .section-header {
        margin-bottom: 20px;
    }

    .section-icon {
        width: 44px;
        height: 44px;
        flex-basis: 44px;
        border-radius: 12px;
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.05rem;
    }

    .section-subtitle {
        font-size: 0.78rem;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .form-control {
        padding: 13px 15px;
        border-radius: 12px;
    }

    .payment-option {
        padding: 15px;
        gap: 12px;
        border-radius: 14px;
    }

    .payment-title {
        font-size: 0.9rem;
    }

    .payment-desc {
        font-size: 0.75rem;
    }

    .submit-section {
        padding: 24px 18px;
    }

    .checkout-submit-btn {
        padding: 17px;
        border-radius: 15px;
        font-size: 1rem;
    }

    .summary-header {
        padding: 22px 18px;
    }

    .summary-body {
        padding: 18px;
    }

    .summary-product-img {
        width: 56px;
        height: 56px;
        flex-basis: 56px;
    }

    .summary-product-name {
        font-size: 0.84rem;
    }

    .summary-product-price {
        font-size: 0.88rem;
    }

    .summary-row.total .summary-row-value {
        font-size: 1.25rem;
    }
}

/* =========================================================
   ACCESSIBILITY
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .form-section,
    .payment-option,
    .checkout-submit-btn,
    .form-control,
    .payment-select,
    .payment-select-arrow,
    .back-link {
        animation: none !important;
        transition: none !important;
    }
}

</style>

<div class="checkout-page">
    <div class="container">
        <div class="checkout-header">
            <div class="checkout-breadcrumb">
                <a href="{{ route('show.products.index') }}">Products</a>
                <span><i class="bi bi-chevron-right"></i></span>
                <a href="{{ route('cart.index') }}">Cart</a>
                <span><i class="bi bi-chevron-right"></i></span>
                <span class="current">Checkout</span>
            </div>
            <h1>Complete Your Order</h1>
            <p>Fill in your details to place the order</p>
        </div>

        <div class="checkout-container">
            {{-- Checkout Form --}}
            <div class="checkout-form-card">
                <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                    @csrf

                    {{-- Contact Info --}}
                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon purple">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h3 class="section-title">Contact Information</h3>
                                <p class="section-subtitle">We'll use this to send you order updates</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Ahmed Mohamed" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="ahmed@example.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="01xxxxxxxxx" required>
                        </div>
                    </div>

                    {{-- Shipping Info --}}
                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon green">
                                <i class="bi bi-truck"></i>
                            </div>
                            <div>
                                <h3 class="section-title">Shipping Address</h3>
                                <p class="section-subtitle">Where should we deliver your order?</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Full Address</label>
                            <textarea name="address" class="form-control" placeholder="Street, Building, Floor, Apartment..." rows="3" required></textarea>
                        </div>
                    </div>

                 {{-- Payment Method --}}
<div class="form-section">
    <div class="section-header">
        <div class="section-icon blue">
            <i class="bi bi-credit-card-fill"></i>
        </div>

        <div>
            <h3 class="section-title">Payment Method</h3>
            <p class="section-subtitle">Choose how you'd like to pay</p>
        </div>
    </div>

    <div class="payment-select-wrapper">

        <label for="payment_method" class="payment-select-label">
            Payment Method
        </label>

        <div class="payment-select-box">
            <select name="payment_method" id="payment_method" class="payment-select">

                <option value="cash" selected>
                    💵 Cash on Delivery — Pay when you receive your order
                </option>

                <option value="vodafone">
                    📱 Vodafone Cash — Pay using your Vodafone wallet
                </option>

                <option value="etisalat">
                    🔴 Etisalat Cash — Pay using your Etisalat wallet
                </option>

                <option value="orange">
                    🟠 Orange Money — Pay using Orange Money
                </option>

                <option value="fawry">
                    🟡 Fawry Pay — Pay at Fawry outlets or online
                </option>

                <option value="instapay">
                    🏦 InstaPay — Pay using InstaPay app
                </option>

                <option value="card">
                    💳 Credit / Debit Card — Visa, Mastercard, or other cards
                </option>

            </select>

            <i class="bi bi-chevron-down payment-select-arrow"></i>
        </div>

    </div>
</div>

                    {{-- Submit --}}
                    <div class="submit-section">
                        <input type="hidden" name="display_total" value="{{ $total + $shipping }}">

                        <button type="submit" class="checkout-submit-btn">
                            <i class="bi bi-bag-check-fill"></i>
                            Confirm & Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="back-link">
                            <i class="bi bi-arrow-left"></i>
                            Back to Cart
                        </a>
                    </div>
                </form>
            </div>

            {{-- Order Summary --}}
            <div class="order-summary-card">
                <div class="summary-header">
                    <h3><i class="bi bi-bag-heart-fill me-2"></i>Order Summary</h3>
                    <p>{{ $cartItems->sum('quantity') }} items in your cart</p>
                </div>

                <div class="summary-body">
                    <div class="product-list">
                        @foreach($cartItems as $item)
                            @php
                                $price = $item->product->discounted_price;
                                $itemTotal = $price * $item->quantity;
                                $firstImage = null;
                                if ($item->product->img) {
                                    $decoded = json_decode($item->product->img, true);
                                    $firstImage = is_array($decoded) ? $decoded[0] : $item->product->img;
                                }
                            @endphp

                            <div class="summary-product">
                                @if($firstImage)
                                    <img src="{{ asset('img/' . $firstImage) }}" class="summary-product-img" alt="{{ $item->product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/64" class="summary-product-img" alt="Product">
                                @endif

                                <div class="summary-product-info">
                                    <div class="summary-product-name">{{ $item->product->name }}</div>
                                    <div class="summary-product-qty">Qty: {{ $item->quantity }}</div>
                                </div>

                                <div class="summary-product-price">
                                    {{ number_format($itemTotal, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-totals">
                        <div class="summary-row">
                            <span class="summary-row-label">Subtotal</span>
                            <span class="summary-row-value">{{ number_format($total, 2) }} </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-row-label">Shipping</span>
                            <span class="summary-row-value">{{ number_format($shipping, 2) }} </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-row-label">Tax</span>
                            <span class="summary-row-value">Included</span>
                        </div>

                        <div class="summary-row total">
                            <span class="summary-row-label">Total</span>
                            <span class="summary-row-value">{{ number_format($total + $shipping, 2) }} </span>
                        </div>
                    </div>

                    <div class="security-info">
                        <i class="bi bi-shield-check"></i>
                        <span>Secure checkout with SSL encryption</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Payment method selection
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
    });
});
</script>

@endsection
