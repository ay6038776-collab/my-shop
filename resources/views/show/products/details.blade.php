
@extends('show.layouts.app')

@section('title', $product->name)

@section('content')

@php
    if($product->img){
        $decoded = json_decode($product->img, true);
        $images = is_array($decoded) ? $decoded : [$product->img];
    } else {
        $images = [];
    }
    $firstImage = count($images) ? $images[0] : null;
@endphp

<style>
/* ===== PRODUCT DETAILS PAGE ===== */
.product-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
    padding: 40px 0 80px;
}

/* Breadcrumb */
.breadcrumb-modern {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
    font-size: 0.9rem;
}

.breadcrumb-modern a {
    color: #718096;
    text-decoration: none;
    transition: color 0.3s;
}

.breadcrumb-modern a:hover {
    color: #667eea;
}

.breadcrumb-separator {
    color: #cbd5e0;
}

.breadcrumb-current {
    color: #4a5568;
    font-weight: 500;
}

/* Product Container */
.product-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    max-width: 1400px;
    margin: 0 auto;
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.08);
}

@media (max-width: 992px) {
    .product-container {
        grid-template-columns: 1fr;
        padding: 24px;
        gap: 30px;
    }
}

/* Gallery Section */
.gallery-section {
    position: relative;
}

.main-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    background: #f8f9fa;
    height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.main-image-container img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: transform 0.5s ease;
}

.main-image-container:hover img {
    transform: scale(1.03);
}

/* Responsive */
@media (max-width: 992px) {
    .main-image-container {
        height: 380px;
    }
}

@media (max-width: 576px) {
    .main-image-container {
        height: 300px;
    }
}

/* Discount Badge */
.discount-badge-float {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
    color: white;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 700;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    z-index: 10;
}

/* Wishlist Button */
.wishlist-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    z-index: 10;
}

.wishlist-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.wishlist-btn i {
    font-size: 1.3rem;
    color: #718096;
    transition: all 0.3s ease;
}

.wishlist-btn:hover i {
    color: #ff6b6b;
}

/* Thumbnails */
.thumbnails-row {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding-bottom: 8px;
}

.thumb-item {
    min-width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.thumb-item:hover,
.thumb-item.active {
    border-color: #667eea;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Info Section */
.info-section {
    display: flex;
    flex-direction: column;
}

.product-category {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #667eea;
    font-weight: 700;
    margin-bottom: 12px;
}

.product-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1a202c;
    margin-bottom: 16px;
    line-height: 1.3;
}

@media (max-width: 576px) {
    .product-title {
        font-size: 1.5rem;
    }
}

/* Rating Row */
.rating-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.stars-display {
    display: flex;
    align-items: center;
    gap: 4px;
}

.stars-display i {
    color: #fbbf24;
    font-size: 1.1rem;
}

.stars-display i.empty {
    color: #e2e8f0;
}

.rating-text {
    font-size: 0.95rem;
    color: #718096;
    font-weight: 500;
}

.stock-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.stock-badge.in-stock {
    background: #d1fae5;
    color: #059669;
}

/* Price Section */
.price-section {
    margin-bottom: 24px;
    padding: 24px;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-radius: 16px;
}

.current-price-large {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.old-price-large {
    font-size: 1.2rem;
    color: #a0aec0;
    text-decoration: line-through;
    margin-left: 12px;
}

/* Description */
.product-description {
    font-size: 1rem;
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 24px;
}

/* Color Selection */
.color-section {
    margin-bottom: 30px;
}

.section-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: #2d3748;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 16px;
}

.color-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.color-box-new {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    position: relative;
}

.color-box-new:hover {
    transform: scale(1.1);
}

.color-box-new.selected {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}

.color-box-new::after {
    content: attr(data-name);
    position: absolute;
    bottom: -28px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.7rem;
    color: #718096;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s;
    background: white;
    padding: 2px 6px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.color-box-new:hover::after {
    opacity: 1;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: auto;
}

.btn-add-cart {
    width: 100%;
    padding: 18px 32px;
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
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-add-cart:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.5);
}

.btn-add-cart:active {
    transform: translateY(-1px);
}

.btn-wishlist {
    width: 100%;
    padding: 16px 32px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    color: #4a5568;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-wishlist:hover {
    border-color: #ff6b6b;
    color: #ff6b6b;
    background: #fff5f5;
}

.btn-wishlist i.favorited {
    color: #ff6b6b;
}

/* Features */
.features-row {
    display: flex;
    gap: 20px;
    margin-top: 30px;
    padding-top: 24px;
    border-top: 1px dashed #e2e8f0;
    flex-wrap: wrap;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.85rem;
    color: #718096;
}

.feature-item i {
    font-size: 1.1rem;
    color: #667eea;
}

/* Back Button */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
    color: #718096;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-link:hover {
    color: #667eea;
    transform: translateX(-5px);
}

/* Reviews Section */
.reviews-section {
    max-width: 1400px;
    margin: 40px auto 0;
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.08);
}

.reviews-header {
    text-align: center;
    margin-bottom: 40px;
}

.reviews-header h2 {
    font-size: 1.8rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 12px;
}

/* Rating Form */
.rating-form-card {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-radius: 20px;
    padding: 32px;
    text-align: center;
}

.emoji-display {
    font-size: 4rem;
    margin-bottom: 12px;
}

.rating-form-card p {
    color: #718096;
    margin-bottom: 24px;
}

.star-rating-input {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 24px;
}

.rating-input {
    display: none;
}

.rating-label {
    font-size: 2.5rem;
    color: #e2e8f0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.rating-input:checked ~ .rating-label,
.rating-label:hover,
.rating-label:hover ~ .rating-label {
    color: #fbbf24;
    transform: scale(1.2);
}

/* Interactive Stars */
.star-rating-input-interactive {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 16px;
}

.interactive-star {
    font-size: 2.8rem;
    color: #e2e8f0;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.interactive-star:hover,
.interactive-star.filled {
    color: #fbbf24;
    transform: scale(1.15);
    text-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
}

.interactive-star:hover {
    animation: starPulse 0.3s ease;
}

@keyframes starPulse {
    0%, 100% { transform: scale(1.15); }
    50% { transform: scale(1.25); }
}

.rating-hint {
    text-align: center;
    color: #9ca3af;
    font-size: 0.9rem;
    margin-bottom: 20px;
}

.btn-submit-review {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
    border: none;
    border-radius: 14px;
    color: #a0aec0;
    font-size: 1rem;
    font-weight: 600;
    cursor: not-allowed;
    transition: all 0.3s ease;
}

.btn-submit-review.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    cursor: pointer;
}

.btn-submit-review.active:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
}

.rating-success {
    text-align: center;
    padding: 40px;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-radius: 16px;
    animation: fadeInUp 0.5s ease;
}

.rating-success i {
    font-size: 4rem;
    color: #22c55e;
    margin-bottom: 16px;
}

.rating-success h3 {
    color: #166534;
    font-size: 1.5rem;
    margin-bottom: 8px;
}

.rating-success p {
    color: #15803d;
}

.login-to-rate {
    text-align: center;
    padding: 40px;
    background: #f8fafc;
    border-radius: 16px;
}

.login-to-rate i {
    font-size: 3rem;
    color: #667eea;
    margin-bottom: 16px;
}

.login-to-rate p {
    color: #6b7280;
    font-size: 1rem;
}

.login-to-rate a {
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
}

.login-to-rate a:hover {
    text-decoration: underline;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hidden Input */
#productColor {
    display: none;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .product-page {
        padding: 20px 0 60px;
    }
    
    .product-container,
    .reviews-section {
        padding: 20px;
        border-radius: 16px;
    }
    
    .color-grid {
        gap: 8px;
    }
    
    .color-box-new {
        width: 40px;
        height: 40px;
    }
    
    .features-row {
        flex-direction: column;
        gap: 12px;
    }
}
</style>

<div class="product-page">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb-modern">
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door-fill me-1"></i> Home
            </a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('show.products.index') }}">Products</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $product->name }}</span>
        </nav>

        {{-- Product Container --}}
        <div class="product-container">
            {{-- Gallery Section --}}
            <div class="gallery-section">
                <div class="main-image-container">
                    @if($firstImage)
                        <img id="mainProductImage" src="{{ asset('img/' . $firstImage) }}" alt="{{ $product->name }}">
                    @else
                        <img id="mainProductImage" src="https://via.placeholder.com/600x600?text=No+Image" alt="No Image">
                    @endif

                    @if($product->isOnDiscount())
                        <span class="discount-badge-float">
                            <i class="bi bi-tag-fill me-1"></i>
                            -{{ $product->discount_percentage }}% OFF
                        </span>
                    @endif

                    <button class="wishlist-btn" id="addToFavBtn">
                        <i class="bi bi-heart" id="heartIcon"></i>
                    </button>
                </div>

                @if(count($images) > 1)
                    <div class="thumbnails-row">
                        @foreach($images as $img)
                            <div class="thumb-item {{ $loop->first ? 'active' : '' }}" onclick="changeMainImage(this)">
                                <img src="{{ asset('img/' . $img) }}" alt="Thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Info Section --}}
            <div class="info-section">
                <span class="product-category">
                    @if($product->category)
                        {{ $product->category->name }}
                    @else
                        Uncategorized
                    @endif
                </span>

                <h1 class="product-title">{{ $product->name }}</h1>

                {{-- Rating --}}
                <div class="rating-row">
                    <div class="stars-display">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill {{ $i <= round($product->averageRating()) ? '' : 'empty' }}"></i>
                        @endfor
                    </div>
                    <span class="rating-text">({{ number_format($product->averageRating(), 1) }} reviews)</span>
                    <span class="stock-badge in-stock">
                        <i class="bi bi-check-circle-fill"></i>
                        In Stock
                    </span>
                </div>

                {{-- Price --}}
                <div class="price-section">
                    @if($product->isOnDiscount())
                        <span class="current-price-large">{{ number_format($product->discounted_price, 2) }} EGP</span>
                        <span class="old-price-large">{{ number_format($product->price, 2) }} EGP</span>
                    @else
                        <span class="current-price-large">{{ number_format($product->price, 2) }} EGP</span>
                    @endif
                </div>

                {{-- Description --}}
                <p class="product-description">{{ $product->description }}</p>

                {{-- Color Selection --}}
                <div class="color-section">
                    <span class="section-label">Select Color:</span>
                    <div class="color-grid" id="colorOptions">
                        <div class="color-box-new selected" data-color="أسود" data-name="أسود" style="background-color:#000;"></div>
                        <div class="color-box-new" data-color="أبيض" data-name="أبيض" style="background-color:#fff; border: 1px solid #e2e8f0;"></div>
                        <div class="color-box-new" data-color="أحمر" data-name="أحمر" style="background-color:#e30425;"></div>
                        <div class="color-box-new" data-color="أزرق" data-name="أزرق" style="background-color:#1565c0;"></div>
                        <div class="color-box-new" data-color="أخضر" data-name="أخضر" style="background-color:#28a745;"></div>
                        <div class="color-box-new" data-color="أصفر" data-name="أصفر" style="background-color:#ffc107;"></div>
                        <div class="color-box-new" data-color="وردي" data-name="وردي" style="background-color:#ff69b4;"></div>
                        <div class="color-box-new" data-color="زهري" data-name="زهري" style="background-color:#ff69b4;"></div>
                        <div class="color-box-new" data-color="بنفسجي" data-name="بنفسجي" style="background-color:#800080;"></div>
                        <div class="color-box-new" data-color="برتقالي" data-name="برتقالي" style="background-color:#ff8c00;"></div>
                        <div class="color-box-new" data-color="رمادي" data-name="رمادي" style="background-color:#808080;"></div>
                        <div class="color-box-new" data-color="بني" data-name="بني" style="background-color:#8b4513;"></div>
                        <div class="color-box-new" data-color="كحلي" data-name="كحلي" style="background-color:#000080;"></div>
                        <div class="color-box-new" data-color="تركواز" data-name="تركواز" style="background-color:#40e0d0;"></div>
                        <div class="color-box-new" data-color="لافندر" data-name="لافندر" style="background-color:#e6e6fa;"></div>
                        <div class="color-box-new" data-color="زيتي" data-name="زيتي" style="background-color:#808000;"></div>
                        <div class="color-box-new" data-color="فضي" data-name="فضي" style="background-color:#c0c0c0;"></div>
                        <div class="color-box-new" data-color="ذهبي" data-name="ذهبي" style="background-color:#ffd700;"></div>
                        <div class="color-box-new" data-color="بيج" data-name="بيج" style="background-color:#f5f5dc;"></div>
                        <div class="color-box-new" data-color="عنابي" data-name="عنابي" style="background-color:#800000;"></div>
                        <div class="color-box-new" data-color="كريمي" data-name="كريمي" style="background-color:#fffdd0;"></div>
                        <div class="color-box-new" data-color="فيروزي" data-name="فيروزي" style="background-color:#40e0d0;"></div>
                        <div class="color-box-new" data-color="نيلي" data-name="نيلي" style="background-color:#4b0082;"></div>
                        <div class="color-box-new" data-color="كهرماني" data-name="كهرماني" style="background-color:#ffbf00;"></div>
                    </div>
                    <input type="hidden" id="productColor" value="أسود">
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <button id="addToCartBtn" class="btn-add-cart">
                        <i class="bi bi-bag-plus-fill"></i>
                        Add to Cart
                    </button>
                    <button id="addToWishlistBtn" class="btn-wishlist">
                        <i class="bi bi-heart"></i>
                        Add to Wishlist
                    </button>
                </div>

                {{-- Features --}}
                <div class="features-row">
                    <div class="feature-item">
                        <i class="bi bi-truck"></i>
                        Free Shipping
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        Secure Payment
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        30-Day Returns
                    </div>
                </div>

                {{-- Back Link --}}
                <a href="{{ url()->previous() }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Back to Products
                </a>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="reviews-section">
            <div class="reviews-header">
                <h2>Rate This Product</h2>
                <p>Share your experience with other customers</p>
            </div>

            @auth('customer')
                <div class="rating-form-card" id="rating-form-container">
                    <div class="emoji-display" id="emoji-display">😐</div>

                    <div class="star-rating-input-interactive" id="interactive-stars">
                        @for($i = 5; $i >= 1; $i--)
                            <span class="interactive-star" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="selected-rating" value="0">

                    <p class="rating-hint" id="rating-hint">Click to rate</p>

                    <button type="button" class="btn-submit-review" id="submit-rating-btn" disabled>
                        <i class="bi bi-send"></i>
                        Submit Review
                    </button>
                </div>

                <div class="rating-success" id="rating-success" style="display: none;">
                    <i class="bi bi-check-circle-fill"></i>
                    <h3>Thank you!</h3>
                    <p>Your rating has been submitted successfully.</p>
                </div>
            @else
                <div class="login-to-rate">
                    <i class="bi bi-star-half"></i>
                    <p>Please <a href="{{ route('customer.login') }}">login</a> to rate this product</p>
                </div>
            @endauth
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.cartAddUrl = "{{ route('cart.add', $product->id) }}";
    window.rateProductUrl = "{{ route('rate.product', $product->id) }}";

    function changeMainImage(el) {
        const img = el.querySelector('img') || el;
        document.getElementById('mainProductImage').src = img.src;
        
        document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
        el.classList.add('active');
    }

    // Interactive Rating System
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveStars = document.getElementById('interactive-stars');
        const selectedRating = document.getElementById('selected-rating');
        const emojiDisplay = document.getElementById('emoji-display');
        const ratingHint = document.getElementById('rating-hint');
        const submitBtn = document.getElementById('submit-rating-btn');
        const formContainer = document.getElementById('rating-form-container');
        const successMsg = document.getElementById('rating-success');

        if (!interactiveStars) return;

        const stars = interactiveStars.querySelectorAll('.interactive-star');
        const emojis = ['😞', '😟', '😐', '🙂', '😍'];
        const hints = ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent!'];

        // Hover effect
        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.dataset.value);
                highlightStars(value);
                updateEmoji(value);
                updateHint(value);
            });

            star.addEventListener('mouseleave', function() {
                const current = parseInt(selectedRating.value) || 0;
                highlightStars(current);
                updateEmoji(current);
                updateHint(current);
            });

            star.addEventListener('click', function() {
                const value = parseInt(this.dataset.value);
                selectedRating.value = value;
                highlightStars(value);
                updateEmoji(value);
                updateHint(value);
                submitBtn.disabled = false;
                submitBtn.classList.add('active');
            });
        });

        function highlightStars(count) {
            stars.forEach(star => {
                const value = parseInt(star.dataset.value);
                if (value <= count) {
                    star.classList.add('filled');
                } else {
                    star.classList.remove('filled');
                }
            });
        }

        function updateEmoji(value) {
            if (value > 0) {
                emojiDisplay.textContent = emojis[value - 1];
            } else {
                emojiDisplay.textContent = '😐';
            }
        }

        function updateHint(value) {
            if (value > 0) {
                ratingHint.textContent = hints[value - 1];
            } else {
                ratingHint.textContent = 'Click to rate';
            }
        }

        // Submit rating
        if (submitBtn) {
            submitBtn.addEventListener('click', function() {
                const rating = parseInt(selectedRating.value);
                if (rating === 0) return;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch(window.rateProductUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ rating: rating })
                })
                .then(response => response.json())
                .then(data => {
                    formContainer.style.display = 'none';
                    successMsg.style.display = 'block';

                    // Update the product rating display
                    const ratingText = document.querySelector('.rating-text');
                    if (ratingText && data.average) {
                        ratingText.textContent = `(${data.average.toFixed(1)} reviews)`;
                    }
                })
                .catch(err => {
                    console.error('Rating error:', err);
                    alert('Error submitting rating. Please try again.');
                });
            });
        }
    });
</script>

<script src="{{ asset('js/products/details.js') }}" defer></script>
@endsection
