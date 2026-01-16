@extends('show.layouts.app')

@section('title', $product->name)

@section('content')

<link rel="stylesheet" href="{{ asset('css/products/details.css') }}">

<div class="container product-details-container">
    <div class="row g-5 align-items-center">

        <div class="col-lg-6 position-relative">
            <span id="favIcon" class="position-absolute top-0 end-0 m-4 fs-2 text-danger" style="cursor:pointer; z-index:10;">
                <i class="bi bi-heart" id="heartIcon"></i>
            </span>
            <div class="product-image-card shadow-lg rounded-4 overflow-hidden">
                @if($product->img)
                    <img src="{{ asset('img/' . $product->img) }}"
                         class="img-fluid"
                         alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/480x480?text=Product+Image"
                         class="img-fluid"
                         alt="No Image">
                @endif

                @if($product->isOnDiscount())
                    <span class="badge badge-discount position-absolute top-0 start-0 m-4 px-3 py-2 rounded-pill shadow">
                        -{{ $product->discount_percentage }}% OFF
                    </span>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <h1 class="fw-bolder mb-3 text-dark">{{ $product->name }}</h1>
            <p class="text-muted fs-5 mb-4 border-bottom pb-3">{{ $product->description }}</p>

            <div class="mb-4">
                <label class="fw-bold mb-3 d-block text-dark">🎨 Select Color:</label>
            <div class="d-flex gap-3 flex-wrap" id="colorOptions">
    <div class="text-center">
        <div class="color-box" data-color="أسود" style="background-color:#000;"></div>
        <small>أسود</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="أبيض" style="background-color:#fff; border:1px solid #ccc;"></div>
        <small>أبيض</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="أحمر" style="background-color:#e30425;"></div>
        <small>أحمر</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="أزرق" style="background-color:#1565c0;"></div>
        <small>أزرق</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="أخضر" style="background-color:#28a745;"></div>
        <small>أخضر</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="أصفر" style="background-color:#ffc107;"></div>
        <small>أصفر</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="وردي" style="background-color:#ff69b4;"></div>
        <small>وردي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="زهري" style="background-color:#ff69b4;"></div>
        <small>زهري</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="بنفسجي" style="background-color:#800080;"></div>
        <small>بنفسجي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="برتقالي" style="background-color:#ff8c00;"></div>
        <small>برتقالي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="رمادي" style="background-color:#808080;"></div>
        <small>رمادي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="بني" style="background-color:#8b4513;"></div>
        <small>بني</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="كحلي" style="background-color:#000080;"></div>
        <small>كحلي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="تركواز" style="background-color:#40e0d0;"></div>
        <small>تركواز</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="لافندر" style="background-color:#e6e6fa;"></div>
        <small>لافندر</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="زيتي" style="background-color:#808000;"></div>
        <small>زيتي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="فضي" style="background-color:#c0c0c0;"></div>
        <small>فضي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="ذهبي" style="background-color:#ffd700;"></div>
        <small>ذهبي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="بيج" style="background-color:#f5f5dc;"></div>
        <small>بيج</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="عنابي" style="background-color:#800000;"></div>
        <small>عنابي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="كريمي" style="background-color:#fffdd0;"></div>
        <small>كريمي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="فيروزي" style="background-color:#40e0d0;"></div>
        <small>فيروزي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="نيلي" style="background-color:#4b0082;"></div>
        <small>نيلي</small>
    </div>
    <div class="text-center">
        <div class="color-box" data-color="كهرماني" style="background-color:#ffbf00;"></div>
        <small>كهرماني</small>
    </div>
</div>
                <input type="hidden" id="productColor" value="">
            </div>

            <div class="d-flex align-items-center mb-5 mt-4">
                @if($product->isOnDiscount())
                    <h3 class="fw-bolder text-main-price mb-0">{{ number_format($product->discounted_price, 2) }} EGP</h3>
                    <span class="text-muted ms-4 fs-5"><del>{{ number_format($product->price, 2) }} EGP</del></span>
                @else
                    <h3 class="fw-bolder text-main-price mb-0">{{ number_format($product->price, 2) }} EGP</h3>
                @endif
            </div>

            <div class="d-flex gap-4 flex-wrap">
                <button id="addToCartBtn" class="btn btn-gradient-new px-5 py-3 rounded-pill shadow-lg fw-semibold">
                    <i class="bi bi-bag-plus-fill me-2"></i> Add to Cart
                </button>

                <button id="addToFavBtn" class="btn btn-outline-custom px-5 py-3 rounded-pill fw-semibold">
                    <i class="bi bi-heart me-2"></i> Add to Wishlist
                </button>
            </div>

            <div class="mt-5 pt-3 border-top">
                <a href="{{ url()->previous() }}" class="btn btn-secondary px-4 py-2 rounded-pill small">
                    ← Back to Products
                </a>
            </div>
        </div>

    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.cartAddUrl = "{{ route('cart.add', $product->id) }}";
</script>

<script src="{{ asset('js/products/details.js') }}" defer></script>

@endsection