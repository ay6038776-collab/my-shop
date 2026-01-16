@extends('show.layouts.app')

@section('title', 'Home - Latest Products')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bolder display-5 text-dark-accent">🚀 Our Latest Products</h1>
        <p class="text-muted fs-5">Don't Miss Out on Our Featured Limited-Time Offers!</p>
    </div>

    <div class="text-center mb-5">
        <h4 class="fw-bold text-muted mb-2">Current Flash Time</h4>
        <div id="digital-clock" class="fs-1 fw-bolder text-primary-glow clock-style"></div>
    </div>

    @if ($products->count() > 0)
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-md-6 col-lg-3">
                    <div class="card clean-product-card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                        
                        <div class="product-image-container position-relative">
                            @if($product->img)
                                <img src="{{ asset('img/' . $product->img) }}" alt="{{ $product->name }}" class="img-fluid">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image" class="img-fluid">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column text-center p-3">
                            <h6 class="card-title fw-bold text-dark mb-1">{{ $product->name }}</h6>

                            {{-- عرض السعر القديم والجديد --}}
                            @if($product->discount_percentage > 0)
                                <p class="fw-bolder fs-5 text-muted mb-1" style="text-decoration: line-through;">
                                    {{ number_format($product->price, 2) }} E.G.P
                                </p>
                                <p class="fw-bolder fs-5 text-danger mb-2">
                                    {{ number_format($product->discounted_price, 2) }} E.G.P
                                    <span class="badge bg-danger ms-1">-{{ $product->discount_percentage }}%</span>
                                </p>
                            @else
                                <p class="fw-bolder fs-5 text-main-price mb-2">
                                    {{ number_format($product->price, 2) }}E.G.P
                                </p>
                            @endif

                            <div id="countdown-{{ $product->id }}" class="mb-2 text-danger fw-semibold small"></div>

                            <div class="progress simple-progress mb-3">
                                <div id="progress-{{ $product->id }}" 
                                     class="progress-bar progress-discount-bar" 
                                     role="progressbar" 
                                     style="width: 100%;" 
                                     aria-valuenow="100" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100"></div>
                            </div>

                            <a href="{{ url('/products/' . $product->id) }}" 
                               class="btn btn-outline-dark-accent rounded-pill fw-semibold mt-auto px-4 py-2 hover-scale">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                        </div>
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
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076500.png" width="100" class="mb-3">
            <h4 class="text-muted">🚀 No New Products Available Right Now</h4>
        </div>
    @endif
</div>
<script src="{{ asset('js/home.js') }}"></script>
@endsection