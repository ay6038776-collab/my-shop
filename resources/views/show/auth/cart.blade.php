
@extends('show.layouts.app')
@section('title', 'My Cart - Shopping Cart')
@section('content')

<style>
/* ===== MODERN CART DESIGN ===== */
.cart-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
    padding: 40px 0;
}

.cart-header {
    text-align: center;
    margin-bottom: 40px;
}

.cart-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 10px;
}

.cart-header p {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Cart Container */
.cart-container {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
}

@media (max-width: 992px) {
    .cart-container {
        grid-template-columns: 1fr;
    }
}

/* Cart Items Card */
.cart-items-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
}

.cart-items-header {
    padding: 24px 30px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.cart-items-header h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.item-count {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.clear-cart-btn {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

.clear-cart-btn:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-2px);
}

/* Cart Item */
.cart-item {
    display: grid;
    grid-template-columns: 80px 1fr auto auto auto;
    gap: 24px;
    align-items: center;
    padding: 24px 30px;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.cart-item:hover {
    background: #fafbff;
}

.cart-item:last-child {
    border-bottom: none;
}

@media (max-width: 768px) {
    .cart-item {
        grid-template-columns: 70px 1fr;
        grid-template-rows: auto auto;
        gap: 16px;
        padding: 20px;
    }
}

/* Product Image */
.product-image {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    object-fit: cover;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

/* Product Info */
.product-info {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.product-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.product-sku {
    font-size: 0.8rem;
    color: #a0aec0;
}

.product-color {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 4px;
}

.color-label {
    font-size: 0.85rem;
    color: #718096;
}

.color-swatch {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 2px solid #e2e8f0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.color-name {
    font-size: 0.85rem;
    color: #4a5568;
    font-weight: 500;
    text-transform: capitalize;
}

/* Discount Badge */
.discount-badge {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
    color: white;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    width: fit-content;
    margin-top: 8px;
}

/* Quantity Controls */
.quantity-controls {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f7fafc;
    padding: 8px;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
}

.qty-btn {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 10px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn.decrease {
    background: #fff;
    color: #e53e3e;
    border: 1px solid #fed7d7;
}

.qty-btn.decrease:hover:not(:disabled) {
    background: #fff5f5;
    transform: scale(1.1);
}

.qty-btn.increase {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.qty-btn.increase:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
}

.qty-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.qty-display {
    min-width: 40px;
    text-align: center;
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
}

/* Price */
.item-price {
    text-align: right;
    min-width: 120px;
}

.price-current {
    font-size: 1.2rem;
    font-weight: 700;
    color: #667eea;
}

.price-original {
    font-size: 0.85rem;
    color: #a0aec0;
    text-decoration: line-through;
}

/* Delete Button */
.delete-btn {
    width: 44px;
    height: 44px;
    border: none;
    background: #fff5f5;
    color: #e53e3e;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.delete-btn:hover {
    background: #fc8181;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 5px 20px rgba(229, 62, 62, 0.3);
}

/* Order Summary Card */
.order-summary {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    position: sticky;
    top: 20px;
    height: fit-content;
}

.summary-header {
    padding: 24px 28px;
    border-bottom: 1px solid #eee;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
}

.summary-header h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-body {
    padding: 28px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px dashed #e2e8f0;
}

.summary-row:last-of-type {
    border-bottom: none;
}

.summary-label {
    font-size: 0.95rem;
    color: #718096;
    display: flex;
    align-items: center;
    gap: 8px;
}

.summary-value {
    font-size: 1rem;
    font-weight: 600;
    color: #2d3748;
}

.summary-row.total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #667eea;
    border-bottom: none;
}

.summary-row.total .summary-label {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
}

.summary-row.total .summary-value {
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Promo Code */
.promo-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px dashed #e2e8f0;
}

.promo-input-group {
    display: flex;
    gap: 10px;
}

.promo-input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.promo-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.promo-btn {
    padding: 12px 20px;
    background: #edf2f7;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    color: #4a5568;
    cursor: pointer;
    transition: all 0.3s ease;
}

.promo-btn:hover {
    background: #667eea;
    color: white;
}

/* Checkout Button */
.checkout-btn {
    width: 100%;
    padding: 18px;
    margin-top: 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 16px;
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
}

.checkout-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.45);
}

.continue-shopping {
    display: block;
    text-align: center;
    margin-top: 16px;
    color: #718096;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.continue-shopping:hover {
    color: #667eea;
}

/* Security Badge */
.security-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
    padding: 12px;
    background: #f0fff4;
    border-radius: 10px;
    color: #38a169;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 80px 40px;
}

.empty-cart-icon {
    width: 150px;
    height: 150px;
    margin: 0 auto 30px;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
}

.empty-cart h2 {
    font-size: 1.8rem;
    color: #2d3748;
    margin-bottom: 12px;
}

.empty-cart p {
    color: #718096;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.shop-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
}

.shop-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.45);
    color: white;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cart-item {
    animation: slideIn 0.4s ease forwards;
}

.cart-item:nth-child(1) { animation-delay: 0.05s; }
.cart-item:nth-child(2) { animation-delay: 0.1s; }
.cart-item:nth-child(3) { animation-delay: 0.15s; }
.cart-item:nth-child(4) { animation-delay: 0.2s; }
.cart-item:nth-child(5) { animation-delay: 0.25s; }

.color-circle.black { background-color: black; }
.color-circle.red { background-color: red; }
.color-circle.blue { background-color: blue; }
.color-circle.green { background-color: green; }
.color-circle.yellow { background-color: yellow; }
.color-circle.white { background-color: white; border: 1px solid #ccc; }
.color-circle.pink { background-color: pink; }
.color-circle.purple { background-color: purple; }
.color-circle.orange { background-color: orange; }
.color-circle.gray { background-color: gray; }
.color-circle.light-purple { background-color: #b19cd9; }
.color-circle.turquoise { background-color: #40e0d0; }  
.color-circle.brown { background-color: #a52a2a; }
.color-circle.beige { background-color: #f5f5dc; }
.color-circle.transparent { background-color: transparent; }
.color-circle.navy { background-color: #000080; }
.color-circle.lavender { background-color: #e6e6fa; }
.color-circle.olive { background-color: #808000; }
.color-circle.silver { background-color: #c0c0c0; }
.color-circle.gold { background-color: #ffd700; }
.color-circle.maroon { background-color: #800000; }
.color-circle.cream { background-color: #fffdd0; }
.color-circle.turquoise { background-color: #40e0d0; }
.color-circle.indigo { background-color: #4b0082; }
.color-circle.amber { background-color: #ffbf00; }
</style>

<div class="cart-page">
    <div class="container">
        <div class="cart-header">
            <h1>Shopping Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>

        @if($cartItems->count() > 0)
            <div class="cart-container">
                {{-- Cart Items --}}
                <div class="cart-items-card">
                    <div class="cart-items-header">
                        <h3>
                            <i class="bi bi-bag-check"></i>
                            Your Items
                            <span class="item-count">{{ $cartItems->count() }} {{ $cartItems->count() == 1 ? 'item' : 'items' }}</span>
                        </h3>
                        <button class="clear-cart-btn" id="clear-cart">
                            <i class="bi bi-trash3"></i>
                            Clear All
                        </button>
                    </div>

                    <div id="cart-items">
                        @foreach($cartItems as $item)
                            @php
                                $product = $item->product;
                                $price = $product->discounted_price;
                                $original = $product->price;
                                
                                if ($product->img) {
                                    $decodedImages = json_decode($product->img, true);
                                    $firstImage = is_array($decodedImages) ? $decodedImages[0] : $product->img;
                                } else {
                                    $firstImage = null;
                                }
                            @endphp

                            <div class="cart-item" data-id="{{ $item->id }}">
                                {{-- Product Image --}}
                                @if($firstImage)
                                    <img src="{{ asset('img/' . $firstImage) }}" class="product-image" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/80" class="product-image" alt="No Image">
                                @endif

                                {{-- Product Info --}}
                                <div class="product-info">
                                    <h4 class="product-name">{{ $product->name }}</h4>
                                    <span class="product-sku">SKU: {{ $product->id }}</span>
                                    
                                    @if($item->color && $item->color != 'N/A')
                                        <div class="product-color">
                                            <span class="color-label">Color:</span>
                                            <span class="color-swatch" style="background-color: {{ $item->color_class ?? 'transparent' }}"></span>
                                            <span class="color-name">{{ ucfirst($item->color) }}</span>
                                        </div>
                                    @endif

                                    @if($product->isOnDiscount())
                                        <span class="discount-badge">
                                            <i class="bi bi-tag-fill"></i>
                                            -{{ $product->discount_percentage }}% OFF
                                        </span>
                                    @endif
                                </div>

                                {{-- Quantity Controls --}}
                                <div class="quantity-controls">
                                    <button class="qty-btn decrease" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <span class="qty-display">{{ $item->quantity }}</span>
                                    <button class="qty-btn increase">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>

                                {{-- Price --}}
                                <div class="item-price">
                                    @if($product->isOnDiscount())
                                        <span class="price-original">{{ number_format($original,2) }} </span>
                                    @endif
                                    <span class="price-current">{{ number_format($price * $item->quantity,2) }} </span>
                                </div>

                                {{-- Delete Button --}}
                                <button class="delete-btn btn-delete-single">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="order-summary">
                    <div class="summary-header">
                        <h3>
                            <i class="bi bi-receipt"></i>
                            Order Summary
                        </h3>
                    </div>
                    
                    <div class="summary-body">
                        @php
                            $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);
                            $shipping = 50;
                            $total = $subtotal + $shipping;
                        @endphp

                        <div class="summary-row">
                            <span class="summary-label">
                                <i class="bi bi-box"></i>
                                Subtotal ({{ $cartItems->sum('quantity') }} items)
                            </span>
                            <span class="summary-value" id="subtotal">{{ number_format($subtotal,2) }} </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">
                                <i class="bi bi-truck"></i>
                                Shipping
                            </span>
                            <span class="summary-value" id="shipping">{{ number_format($shipping,2) }} </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">
                                <i class="bi bi-percent"></i>
                                Tax (14%)
                            </span>
                            <span class="summary-value">0.00 </span>
                        </div>

                        <div class="summary-row total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value" id="total">{{ number_format($total,2) }} </span>
                        </div>

                        {{-- Promo Code --}}
                        <div class="promo-section">
                            <div class="promo-input-group">
                                <input type="text" class="promo-input" placeholder="Promo code">
                                <button class="promo-btn">Apply</button>
                            </div>
                        </div>

                        <button class="checkout-btn" onclick="window.location.href='{{ route('checkout') }}'">
                            <i class="bi bi-lock-fill"></i>
                            Proceed to Checkout
                        </button>

                        <a href="{{ route('show.products.index') }}" class="continue-shopping">
                            <i class="bi bi-arrow-left"></i>
                            Continue Shopping
                        </a>

                        <div class="security-badge">
                            <i class="bi bi-shield-check"></i>
                            Secure checkout with SSL encryption
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="cart-items-card">
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        🛒
                    </div>
                    <h2>Your cart is empty</h2>
                    <p>Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('show.products.index') }}" class="shop-btn">
                        <i class="bi bi-bag-plus"></i>
                        Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/cart.js') }}"></script>
@endpush

@endsection
