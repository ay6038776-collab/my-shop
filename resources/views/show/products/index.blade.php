@extends('show.layouts.app')

@section('title', 'All Products')

@section('content')

<link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bolder display-4 section-title">Explore Our Collection</h1>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden product-card-elegant">
                    
                    <div class="product-image-container-v2 position-relative"> 
                        @if($product->img)
                            <img src="{{ asset('img/' . $product->img) }}" 
                                 class="img-fluid product-img-fit-v2" 
                                 alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" 
                                 class="img-fluid product-img-fit-v2" 
                                 alt="No Image">
                        @endif

                        @if($product->isOnDiscount())
                            <span class="badge badge-discount position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow">
                                -{{ $product->discount_percentage }}% OFF
                            </span>
                        @endif
                    </div>

                    <div class="card-body text-center p-4 pb-5 d-flex flex-column"> 
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>

                        @if($product->isOnDiscount())
                            <div class="mb-3">
                                <span class="fw-bolder text-accent fs-4">{{ number_format($product->discounted_price, 2) }} EGP</span>
                                <span class="text-muted ms-2"><del>{{ number_format($product->price, 2) }} EGP</del></span>
                            </div>
                        @else
                            <span class="fw-bolder text-accent fs-4 mb-4">{{ number_format($product->price, 2) }} EGP</span>
                        @endif

                        <a href="{{ route('show.products.details', $product->id) }}" 
                           class="btn btn-dark-gradient mt-auto rounded-pill px-4 py-2 fw-semibold btn-hover-lift">
                            <i class="bi bi-basket-fill me-2"></i> Shop Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection