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

<link rel="stylesheet" href="{{ asset('css/products/details.css') }}">

<div class="container product-details-container my-5">
    <div class="row g-5">

        <div class="col-lg-7">
            <div class="product-gallery-wrapper d-flex gap-3">
                @if(count($images) > 1)
                    <div class="thumbnail-stack d-none d-md-flex flex-column gap-3">
                        @foreach($images as $img)
                            <div class="thumb-item {{ $loop->first ? 'active' : '' }}" onclick="changeMainImage(this)">
                                <img src="{{ asset('img/' . $img) }}" class="img-fluid rounded-3" alt="thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="main-image-viewport flex-grow-1 shadow-sm rounded-4 position-relative">
                    @if($firstImage)
                        <img id="mainProductImage" src="{{ asset('img/' . $firstImage) }}" class="img-fluid" alt="{{ $product->name }}">
                    @else
                        <img id="mainProductImage" src="https://via.placeholder.com/600x600?text=No+Image" class="img-fluid" alt="No Image">
                    @endif

                    @if($product->isOnDiscount())
                        <div class="discount-tag">-{{ $product->discount_percentage }}%</div>
                    @endif
                    
                    <button id="favIcon" class="wishlist-float-btn shadow-sm">
                        <i class="bi bi-heart" id="heartIcon"></i>
                    </button>
                </div>
            </div>
            
            @if(count($images) > 1)
                <div class="d-flex d-md-none gap-2 mt-3 overflow-auto pb-2">
                    @foreach($images as $img)
                        <img src="{{ asset('img/' . $img) }}" class="mobile-thumb rounded-3" onclick="changeMainImage(this)">
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-5">
            <div class="product-info-card p-2">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Home</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </nav>

                <h1 class="product-title display-6 fw-bold mb-3">{{ $product->name }}</h1>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="stars-gold fs-5">
                        @for($i = 1; $i <= 5; $i++)
                            {!! $i <= round($product->averageRating()) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>' !!}
                        @endfor
                        <span class="text-muted fs-6 ms-1">({{ number_format($product->averageRating(), 1) }})</span>
                    </div>
                    <span class="badge bg-soft-success text-success px-3">In Stock</span>
                </div>

                <div class="price-section mb-4">
                    @if($product->isOnDiscount())
                        <div class="d-flex align-items-center gap-3">
                            <span class="current-price">{{ number_format($product->discounted_price, 2) }} <small>EGP</small></span>
                            <span class="old-price text-muted text-decoration-line-through">{{ number_format($product->price, 2) }} EGP</span>
                        </div>
                    @else
                        <span class="current-price">{{ number_format($product->price, 2) }} <small>EGP</small></span>
                    @endif
                </div>

                <p class="product-description text-muted mb-4">
                    {{ $product->description }}
                </p>

                <hr class="my-4 opacity-50">

                <div class="color-selection-v2 mb-5">
                    <h6 class="fw-bold mb-3 text-uppercase small letter-spacing">Select Color:</h6>
                   <div class="d-flex gap-3 flex-wrap" id="colorOptions">
                    <!-- نفس كود الألوان السابق -->
                    <div class="text-center"><div class="color-box" data-color="أسود" style="background-color:#000;"></div><small>أسود</small></div>
                    <div class="text-center"><div class="color-box" data-color="أبيض" style="background-color:#fff; border:1px solid #ccc;"></div><small>أبيض</small></div>
                    <div class="text-center"><div class="color-box" data-color="أحمر" style="background-color:#e30425;"></div><small>أحمر</small></div>
                    <div class="text-center"><div class="color-box" data-color="أزرق" style="background-color:#1565c0;"></div><small>أزرق</small></div>
                    <div class="text-center"><div class="color-box" data-color="أخضر" style="background-color:#28a745;"></div><small>أخضر</small></div>
                    <div class="text-center"><div class="color-box" data-color="أصفر" style="background-color:#ffc107;"></div><small>أصفر</small></div>
                    <div class="text-center"><div class="color-box" data-color="وردي" style="background-color:#ff69b4;"></div><small>وردي</small></div>
                    <div class="text-center"><div class="color-box" data-color="زهري" style="background-color:#ff69b4;"></div><small>زهري</small></div>
                    <div class="text-center"><div class="color-box" data-color="بنفسجي" style="background-color:#800080;"></div><small>بنفسجي</small></div>
                    <div class="text-center"><div class="color-box" data-color="برتقالي" style="background-color:#ff8c00;"></div><small>برتقالي</small></div>
                    <div class="text-center"><div class="color-box" data-color="رمادي" style="background-color:#808080;"></div><small>رمادي</small></div>
                    <div class="text-center"><div class="color-box" data-color="بني" style="background-color:#8b4513;"></div><small>بني</small></div>
                    <div class="text-center"><div class="color-box" data-color="كحلي" style="background-color:#000080;"></div><small>كحلي</small></div>
                    <div class="text-center"><div class="color-box" data-color="تركواز" style="background-color:#40e0d0;"></div><small>تركواز</small></div>
                    <div class="text-center"><div class="color-box" data-color="لافندر" style="background-color:#e6e6fa;"></div><small>لافندر</small></div>
                    <div class="text-center"><div class="color-box" data-color="زيتي" style="background-color:#808000;"></div><small>زيتي</small></div>
                    <div class="text-center"><div class="color-box" data-color="فضي" style="background-color:#c0c0c0;"></div><small>فضي</small></div>
                    <div class="text-center"><div class="color-box" data-color="ذهبي" style="background-color:#ffd700;"></div><small>ذهبي</small></div>
                    <div class="text-center"><div class="color-box" data-color="بيج" style="background-color:#f5f5dc;"></div><small>بيج</small></div>
                    <div class="text-center"><div class="color-box" data-color="عنابي" style="background-color:#800000;"></div><small>عنابي</small></div>
                    <div class="text-center"><div class="color-box" data-color="كريمي" style="background-color:#fffdd0;"></div><small>كريمي</small></div>
                    <div class="text-center"><div class="color-box" data-color="فيروزي" style="background-color:#40e0d0;"></div><small>فيروزي</small></div>
                    <div class="text-center"><div class="color-box" data-color="نيلي" style="background-color:#4b0082;"></div><small>نيلي</small></div>
                    <div class="text-center"><div class="color-box" data-color="كهرماني" style="background-color:#ffbf00;"></div><small>كهرماني</small></div>
                </div>
                    <input type="hidden" id="productColor" value="">
                </div>

                <div class="action-buttons-group d-grid gap-3">
                    <button id="addToCartBtn" class="btn btn-dark-modern py-3 fw-bold rounded-3">
                        <i class="bi bi-bag-plus me-2"></i> Add to Cart
                    </button>
                    <button id="addToFavBtn" class="btn btn-outline-dark-modern py-3 fw-bold rounded-3">
                        <i class="bi bi-heart me-2"></i> Add to Wishlist
                    </button>
                </div>

              <div class="mt-4">

    <a href="{{ url()->previous() }}" class="text-decoration-none">
        <!-- From Uiverse.io by gharsh11032000 --> 
        <button class="animated-button">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
            </svg>

            <span class="text">Back to Catalog</span>

            <span class="circle"></span>

            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
            </svg>
        </button>
    </a>

</div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 border-top">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="fw-bold mb-4">Customer Experience</h2>
            <form action="{{ route('rate.product', $product->id) }}" method="POST" class="modern-rating-card shadow-sm border p-4 rounded-4">
                @csrf
                <div class="emoji-feedback mb-3">
                    <div class="emoji-display" id="emoji-display">😐</div>
                    <p class="text-muted mt-2">How do you feel about this product?</p>
                </div>

                <div class="star-rating-input mb-4">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" class="rating-input">
                        <label for="rating-{{ $i }}" class="rating-label">★</label>
                    @endfor
                </div>

                <button type="submit" class="btn btn-primary-modern px-5 py-2 rounded-pill">Submit Review</button>
            </form>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.cartAddUrl = "{{ route('cart.add', $product->id) }}";

    function changeMainImage(el) {
        const imgSrc = el.querySelector('img') ? el.querySelector('img').src : el.src;
        document.getElementById('mainProductImage').src = imgSrc;
        
        // تحديث الـ active state
        document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
        if(el.classList.contains('thumb-item')) el.classList.add('active');
    }
</script>

<script src="{{ asset('js/products/details.js') }}" defer></script>
@endsection