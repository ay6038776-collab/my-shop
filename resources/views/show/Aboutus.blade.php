{{-- resources/views/show/about.blade.php (New Professional Style - English Version) --}}
@extends('show.layouts.app')

@section('title', 'About Us - Our Story & Commitment')

@section('content')

<link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">

<script>
    // Keeping the original JS scroll observer
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                entry.target.style.animation = var$entry.target.dataset.animate;
            }
        });
    }, {threshold: 0.2});

    document.addEventListener("DOMContentLoaded", ()=>{
        document.querySelectorAll("[data-animate]").forEach(el=>observer.observe(el));
    });
</script>

<main>
    <div class="container section-separator pt-5 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-7" data-animate="fade-up">
                <h1 class="display-5 text-primary mb-3">Our Story: Commitment to Quality and Innovation</h1>
                <p class="lead text-secondary mb-4">
                    Since our founding, our goal has been to provide an unparalleled online shopping experience. We believe that access to high-quality products should be easy, secure, and fast for everyone.
                </p>
                <p class="text-muted">
                    We are a modern online store specializing in offering a carefully selected range of products, and we constantly strive to provide the best prices and exclusive deals for our valued customers.
                </p>
                <a href="#vision-mission" class="btn btn-primary mt-3">Discover Our Vision</a>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0" data-animate="fade-up">
                <img src="{{ asset('img/images/Ahmed .jpeg') }}" 
                     alt="Online Shopping Concept" class="img-fluid rounded-4 shadow-lg" style="max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="section-separator bg-alt" id="vision-mission">
        <div class="container">
            <h2 class="text-center mb-5" data-animate="fade-in">Our Vision and Mission</h2>
            <div class="row text-center">
                <div class="col-md-6 mb-4" data-animate="fade-up">
                    <div class="p-4 feature-card rounded-4">
                        <i class="bi bi-lightbulb feature-icon text-primary mb-3"></i>
                        <h4 class="fw-bold">Our Vision</h4>
                        <p class="text-secondary">
                            To become the leading online shopping destination in the region, by providing a reliable and innovative platform that offers unlimited variety.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-4" data-animate="fade-up">
                    <div class="p-4 feature-card rounded-4">
                        <i class="bi bi-flag feature-icon text-success mb-3"></i>
                        <h4 class="fw-bold">Our Mission</h4>
                        <p class="text-secondary">
                            To deliver a unique shopping experience combining competitive prices, superior quality, and exceptional after-sales services to ensure complete customer satisfaction.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container section-separator">
        <h2 class="text-center mb-5" data-animate="fade-in">Our Core Values</h2>
        <div class="row">
            <div class="col-lg-4 mb-4" data-animate="fade-up">
                <div class="d-flex p-3 bg-light rounded-4 h-100 align-items-center">
                    <i class="bi bi-shield-check fs-2 text-primary me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Trust and Transparency</h5>
                        <p class="text-muted small mb-0">Ensuring a safe and transparent experience in every purchase.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4" data-animate="fade-up">
                <div class="d-flex p-3 bg-light rounded-4 h-100 align-items-center">
                    <i class="bi bi-gem fs-2 text-warning me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Guaranteed Quality</h5>
                        <p class="text-muted small mb-0">Commitment to the highest quality standards in all products we offer.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4" data-animate="fade-up">
                <div class="d-flex p-3 bg-light rounded-4 h-100 align-items-center">
                    <i class="bi bi-people fs-2 text-success me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Customer First</h5>
                        <p class="text-muted small mb-0">Customer satisfaction is the main driver behind all our decisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-separator bg-alt">
        <div class="container text-center">
            <h2 class="fw-bold mb-5" data-animate="fade-in">Why Are We Your Best Choice?</h2>
            <div class="row">
                <div class="col-md-3 mb-4" data-animate="fade-up">
                    <i class="bi bi-truck fs-1 text-primary mb-3"></i>
                    <h6 class="fw-bold">Fast Delivery</h6>
                    <p class="text-muted small">Your products arrive at your doorstep as quickly as possible.</p>
                </div>
                <div class="col-md-3 mb-4" data-animate="fade-up">
                    <i class="bi bi-credit-card fs-1 text-success mb-3"></i>
                    <h6 class="fw-bold">Secure Payment</h6>
                    <p class="text-muted small">Multiple payment options that are 100% protected.</p>
                </div>
                <div class="col-md-3 mb-4" data-animate="fade-up">
                    <i class="bi bi-headset fs-1 text-warning mb-3"></i>
                    <h6 class="fw-bold">24/7 Support</h6>
                    <p class="text-muted small">Customer service is available to serve you at any time.</p>
                </div>
                <div class="col-md-3 mb-4" data-animate="fade-up">
                    <i class="bi bi-tags fs-1 text-danger mb-3"></i>
                    <h6 class="fw-bold">Best Deals</h6>
                    <p class="text-muted small">Discover exclusive discounts and unbeatable offers.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 text-center">
        <h3 class="fw-bold mb-3" data-animate="fade-in">Do You Have an Inquiry?</h3>
        <p class="lead text-muted mb-4" data-animate="fade-in">
            Our team is ready to answer all your questions and assist you on your shopping journey.
        </p>
        {{-- IMPORTANT: Keeping the route name consistent with the backend setup, use 'contact.index' as per our previous fix --}}
        <a href="{{ route('contact.index') }}" class="btn btn-lg btn-outline-primary" data-animate="fade-up">Contact Us Now</a>
    </div>

</main>

@endsection