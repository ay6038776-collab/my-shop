
@extends('show.layouts.app')

@section('title', 'Home - Latest Products')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

{{-- ===== شريط الإعلانات (بدون تغيير) ===== --}}
<div class="swiper homeSlider">
    <div class="swiper-wrapper">
        @foreach($allProducts as $product)
            @php
                $images = [];
                if($product->img){
                    $decoded = json_decode($product->img);
                    $images = is_array($decoded) ? $decoded : [$product->img];
                }
                $firstImage = $images[0] ?? null;
            @endphp

            <div class="swiper-slide">
                <div class="hero-banner">
                    <div class="hero-text">
                        @if($product->discount_percentage > 0)
                            <span class="sale">
                                🔥 {{ $product->discount_percentage }}% OFF
                            </span>
                        @endif
                        <h1>{{ $product->name }}</h1>
                        @if($product->discount_percentage > 0)
                            <p class="old-price">{{ number_format($product->price, 2) }} E.G.P</p>
                            <h2>{{ number_format($product->discounted_price, 2) }} E.G.P</h2>
                        @else
                            <h2>{{ number_format($product->discounted_price, 2) }} E.G.P</h2>
                        @endif
                        <a href="{{ url('/products/'.$product->id) }}" class="shop-btn">Shop Now</a>
                    </div>
                    @if($firstImage)
                        <img src="{{ asset('img/'.$firstImage) }}" class="hero-image">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<style>
/* ===== HOME PAGE PRODUCTS SECTION ===== */
.home-products-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
    padding: 60px 0 80px;
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 12px;
}

.section-header p {
    font-size: 1.1rem;
    color: #718096;
    max-width: 500px;
    margin: 0 auto;
}

/* Flash Sale Timer */
.flash-timer-wrapper {
    text-align: center;
    margin-bottom: 40px;
}

.flash-timer-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 16px;
}

.flash-timer {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    padding: 16px 32px;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
}

.timer-block {
    text-align: center;
    min-width: 70px;
}

.timer-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    line-height: 1;
    text-shadow: 0 2px 10px rgba(102, 126, 234, 0.5);
}

.timer-label {
    font-size: 0.7rem;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 4px;
}

.timer-separator {
    font-size: 2rem;
    font-weight: 800;
    color: #667eea;
    margin-top: -8px;
}

/* Products Grid */
.products-grid-home {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 28px;
}

/* Product Card */
.product-card-home {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
}

.product-card-home:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Product Image */
.product-image-wrap {
    position: relative;
    padding-top: 75%;
    background: #f8f9fa;
    overflow: hidden;
}

.product-image-wrap img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card-home:hover .product-image-wrap img {
    transform: scale(1.08);
}

/* Discount Badge */
.discount-tag {
    position: absolute;
    top: 16px;
    left: 16px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
    color: white;
    padding: 6px 14px;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 700;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    z-index: 2;
}

/* Countdown Timer */
.countdown-tag {
    position: absolute;
    top: 16px;
    right: 16px;
    background: rgba(0,0,0,0.8);
    color: #fff;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 2;
}

/* Progress Bar */
.sales-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #e2e8f0;
    z-index: 2;
}

.sales-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    transition: width 0.5s ease;
}

/* Product Info */
.product-info-home {
    padding: 24px;
}

.product-category-home {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #667eea;
    font-weight: 600;
    margin-bottom: 8px;
}

.product-name-home {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-name-home a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s;
}

.product-name-home a:hover {
    color: #667eea;
}

/* Price */
.price-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}

.price-current-home {
    font-size: 1.3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.price-old-home {
    font-size: 0.9rem;
    color: #a0aec0;
    text-decoration: line-through;
}

/* View Button */
.view-btn-home {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 14px;
    color: white;
    font-size: 0.95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
    text-decoration: none;
}

.view-btn-home:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.45);
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    background: white;
    border-radius: 20px;
    grid-column: 1 / -1;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 1.5rem;
    color: #2d3748;
    margin-bottom: 12px;
}

.empty-state p {
    color: #718096;
    font-size: 1rem;
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product-card-home {
    animation: fadeInUp 0.5s ease forwards;
}

.product-card-home:nth-child(1) { animation-delay: 0.05s; }
.product-card-home:nth-child(2) { animation-delay: 0.1s; }
.product-card-home:nth-child(3) { animation-delay: 0.15s; }
.product-card-home:nth-child(4) { animation-delay: 0.2s; }
.product-card-home:nth-child(5) { animation-delay: 0.25s; }
.product-card-home:nth-child(6) { animation-delay: 0.3s; }
.product-card-home:nth-child(7) { animation-delay: 0.35s; }
.product-card-home:nth-child(8) { animation-delay: 0.4s; }

/* Responsive */
@media (max-width: 768px) {
    .section-header h1 {
        font-size: 1.8rem;
    }
    
    .timer-number {
        font-size: 1.8rem;
    }
    
    .timer-block {
        min-width: 50px;
    }
    
    .products-grid-home {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .product-info-home {
        padding: 16px;
    }
    
    .product-name-home {
        font-size: 0.95rem;
    }
    
    .price-current-home {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .products-grid-home {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="home-products-section">
    <div class="container">
        {{-- Section Header --}}
        <div class="section-header">
            <h1>Latest Products</h1>
            <p>Don't Miss Out on Our Featured Limited-Time Offers!</p>
        </div>

        {{-- Flash Sale Timer --}}
        <div class="flash-timer-wrapper">
            <div class="flash-timer-label">Current Flash Time</div>
            <div class="flash-timer" id="digital-clock"></div>
        </div>

        {{-- Products Grid --}}
        @if ($products->count() > 0)
            <div class="products-grid-home">
                @foreach($products as $product)
                    @php
                        $images = [];
                        $firstImage = null;
                        
                        if ($product->img) {
                            $decoded = json_decode($product->img, true);
                            if (is_array($decoded)) {
                                $images = $decoded;
                                $firstImage = $decoded[0];
                            } else {
                                $firstImage = $product->img;
                            }
                        }
                        
                        // Calculate progress (mock - based on days remaining)
                        $start = \Carbon\Carbon::parse($product->created_at)->timestamp;
                        $end = \Carbon\Carbon::parse($product->created_at)->addDays(8)->timestamp;
                        $now = now()->timestamp;
                        $totalDuration = $end - $start;
                        $elapsed = $now - $start;
                        $progress = min(100, max(0, ($elapsed / $totalDuration) * 100));
                        $remaining = 100 - $progress;
                    @endphp

                    <div class="product-card-home">
                        <div class="product-image-wrap">
                            @if($firstImage)
                                <img src="{{ asset('img/' . $firstImage) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image">
                            @endif

                            @if($product->isOnDiscount())
                                <span class="discount-tag">
                                    <i class="bi bi-tag-fill me-1"></i>
                                    -{{ $product->discount_percentage }}%
                                </span>
                            @endif

                            <div class="countdown-tag" id="countdown-{{ $product->id }}"></div>
                            <div class="sales-progress">
                                <div class="sales-progress-bar" style="width: {{ $remaining }}%"></div>
                            </div>
                        </div>

                        <div class="product-info-home">
                            <span class="product-category-home">
                                @if($product->category)
                                    {{ $product->category->name }}
                                @else
                                    Uncategorized
                                @endif
                            </span>

                            <h3 class="product-name-home">
                                <a href="{{ url('/products/' . $product->id) }}">{{ $product->name }}</a>
                            </h3>

                            <div class="price-wrap">
                                @if($product->isOnDiscount())
                                    <span class="price-current-home">{{ number_format($product->discounted_price, 2) }} EGP</span>
                                    <span class="price-old-home">{{ number_format($product->price, 2) }} EGP</span>
                                @else
                                    <span class="price-current-home">{{ number_format($product->price, 2) }} EGP</span>
                                @endif
                            </div>

                            <a href="{{ url('/products/' . $product->id) }}" class="view-btn-home">
                                <i class="bi bi-eye-fill"></i>
                                View Details
                            </a>
                        </div>
                    </div>

                    <script>
                        window.productTimers = window.productTimers || [];
                        window.productTimers.push({
                            id: "{{ $product->id }}",
                            start: new Date("{{ \Carbon\Carbon::parse($product->created_at) }}").getTime(),
                            end: new Date("{{ \Carbon\Carbon::parse($product->created_at)->addDays(8) }}").getTime()
                        });
                    </script>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🚀</div>
                <h3>No New Products Available Right Now</h3>
                <p>Check back soon for exciting new arrivals!</p>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/home.js') }}"></script>

@endsection
