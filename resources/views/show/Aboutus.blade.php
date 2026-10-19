{{-- resources/views/show/Aboutus.blade.php (Professional Design 2024) --}}
@extends('show.layouts.app')

@section('title', 'About Us - MyShop')

@section('content')

<style>
    /* ============================================
       HERO SECTION STYLES
    ============================================ */
    .about-hero {
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        overflow: hidden;
        margin-top: -1.5rem;
        padding: 4rem 0;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(99, 102, 241, 0.2);
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        animation: fadeInDown 0.8s ease-out;
    }

    .hero-badge i {
        color: #818cf8;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-title .highlight {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.25rem;
        color: #94a3b8;
        line-height: 1.8;
        margin-bottom: 2rem;
        max-width: 600px;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .hero-stats {
        display: flex;
        gap: 3rem;
        margin-top: 3rem;
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0.5rem;
    }

    .hero-image-container {
        position: relative;
        animation: fadeInRight 1s ease-out 0.3s backwards;
    }

    .hero-image {
        width: 90%;
        max-width: 500px;
        border-radius: 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        position: relative;
    }

    .floating-badge {
        position: absolute;
        background: rgba(30, 41, 59, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: float 3s ease-in-out infinite;
    }

    .floating-badge.badge-1 {
        top: 20%;
        left: -20px;
        animation-delay: 0s;
    }

    .floating-badge.badge-2 {
        bottom: 20%;
        right: -20px;
        animation-delay: 1.5s;
    }

    .floating-badge i {
        font-size: 1.5rem;
        color: #818cf8;
    }

    .floating-badge .badge-text {
        color: #ffffff;
        font-weight: 600;
    }

    /* ============================================
       MISSION & VISION SECTION
    ============================================ */
    .mission-section {
        padding: 6rem 0;
        background: var(--bg-primary);
        position: relative;
    }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #818cf8;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
    }

    .section-label::before,
    .section-label::after {
        content: '';
        width: 30px;
        height: 2px;
        background: linear-gradient(90deg, #818cf8, transparent);
    }

    .section-label::after {
        background: linear-gradient(90deg, transparent, #818cf8);
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.125rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto 3rem;
    }

    .mission-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 3rem;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .mission-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #818cf8, #c084fc);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .mission-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .mission-card:hover::before {
        transform: scaleX(1);
    }

    .mission-icon {
        width: 80px;
        height: 80px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        transition: transform 0.4s ease;
    }

    .mission-card:hover .mission-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .mission-card:nth-child(1) .mission-icon {
        background: linear-gradient(135deg, rgba(129, 140, 248, 0.2), rgba(129, 140, 248, 0.1));
        color: #818cf8;
    }

    .mission-card:nth-child(2) .mission-icon {
        background: linear-gradient(135deg, rgba(192, 132, 252, 0.2), rgba(192, 132, 252, 0.1));
        color: #c084fc;
    }

    .mission-card:nth-child(3) .mission-icon {
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.2), rgba(52, 211, 153, 0.1));
        color: #34d399;
    }

    .mission-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .mission-card p {
        color: var(--text-secondary);
        line-height: 1.8;
    }

    /* ============================================
       VALUES SECTION
    ============================================ */
    .values-section {
        padding: 6rem 0;
        background: linear-gradient(180deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
    }

    .value-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        transition: all 0.4s ease;
        height: 100%;
    }

    .value-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
        border-color: #818cf8;
    }

    .value-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: linear-gradient(135deg, #818cf8, #c084fc);
        color: #ffffff;
    }

    .value-content h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .value-content p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.7;
        margin: 0;
    }

    /* ============================================
       FEATURES SECTION
    ============================================ */
    .features-section {
        padding: 6rem 0;
        background: var(--bg-primary);
        position: relative;
    }

    .features-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(129, 140, 248, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 70% 50%, rgba(192, 132, 252, 0.1) 0%, transparent 50%);
    }

    .feature-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 2.5rem;
        text-align: center;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .feature-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #818cf8, #c084fc, #34d399, #fbbf24);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .feature-card:hover::after {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1.5rem;
        transition: transform 0.4s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(10deg);
    }

    .feature-card:nth-child(1) .feature-icon {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #3b82f6;
    }

    .feature-card:nth-child(2) .feature-icon {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #22c55e;
    }

    .feature-card:nth-child(3) .feature-icon {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #f59e0b;
    }

    .feature-card:nth-child(4) .feature-icon {
        background: linear-gradient(135deg, #fce7f3, #fbcfe8);
        color: #ec4899;
    }

    .feature-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .feature-card p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.7;
        margin: 0;
    }

    /* ============================================
       TEAM SECTION
    ============================================ */
    .team-section {
        padding: 6rem 0;
        background: var(--bg-secondary);
    }

    .team-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .team-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        overflow: hidden;
        border: 4px solid transparent;
        background: linear-gradient(var(--bg-card), var(--bg-card)) padding-box,
                    linear-gradient(135deg, #818cf8, #c084fc) border-box;
    }

    .team-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .team-card .role {
        color: #818cf8;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .team-card p {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .team-social {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .team-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        color: var(--text-secondary);
        transition: all 0.3s ease;
    }

    .team-social a:hover {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        color: #ffffff;
        transform: translateY(-3px);
    }

    /* ============================================
       CTA SECTION
    ============================================ */
    .cta-section {
        padding: 6rem 0;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(129, 140, 248, 0.1) 0%, transparent 50%);
        animation: pulse 4s ease-in-out infinite;
    }

    .cta-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .cta-content h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .cta-content p {
        font-size: 1.25rem;
        color: #94a3b8;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        border: none;
        color: #ffffff;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(129, 140, 248, 0.4);
        color: #ffffff;
    }

    .btn-outline-light-custom {
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: transparent;
    }

    .btn-outline-light-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #ffffff;
        color: #ffffff;
        transform: translateY(-3px);
    }

    /* ============================================
       ANIMATIONS
    ============================================ */
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

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 0.5;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.1);
        }
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 992px) {
        .about-hero {
            min-height: auto;
            padding: 3rem 0;
        }

        .hero-stats {
            justify-content: center;
            gap: 2rem;
        }

        .hero-image-container {
            margin-top: 3rem;
        }

        .floating-badge {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .hero-stats {
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .stat-item {
            flex: 1 1 40%;
        }

        .mission-card {
            padding: 2rem;
        }

        .feature-card,
        .value-item {
            padding: 1.5rem;
        }
    }
</style>

<!-- ============================================
     HERO SECTION
============================================ -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <div class="hero-badge">
                    <i class="fa-solid fa-heart"></i>
                    <span>Welcome to MyShop</span>
                </div>
                <h1 class="hero-title">
                    Discover the Future of <span class="highlight">Online Shopping</span>
                </h1>
                <p class="hero-description">
                    We are a modern e-commerce platform committed to providing you with an exceptional shopping experience. Our journey began with a simple idea: make quality products accessible to everyone, everywhere.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('show.products.index') }}" class="btn btn-primary-gradient">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Explore Products
                    </a>
                    <a href="#mission" class="btn btn-outline-light-custom">
                        <i class="fa-solid fa-play"></i>
                        Our Story
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Products</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">4.9</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-image-container">
                <img src="{{ asset('img/images/myshop.jpg.jpeg') }}" 
                     alt="MyShop - Premium E-commerce" 
                     class="hero-image">
                <div class="floating-badge badge-1">
                    <i class="fa-solid fa-truck-fast"></i>
                    <div>
                        <div class="badge-text">Free Shipping</div>
                        <small style="color: #94a3b8;">Orders over $50</small>
                    </div>
                </div>
                <div class="floating-badge badge-2">
                    <i class="fa-solid fa-shield-halved"></i>
                    <div>
                        <div class="badge-text">Secure Payment</div>
                        <small style="color: #94a3b8;">100% Protected</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     MISSION & VISION SECTION
============================================ -->
<section class="mission-section" id="mission">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">
                <span>Who We Are</span>
            </div>
            <h2 class="section-title">Our Mission & Vision</h2>
            <p class="section-subtitle">
                Dedicated to transforming your shopping experience through innovation, quality, and unwavering commitment to customer satisfaction.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To deliver a seamless shopping experience that combines competitive prices, premium quality, and outstanding customer service. We strive to make every purchase a delightful journey.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To become the most trusted e-commerce platform in the region, recognized for our commitment to quality, innovation, and customer-centric approach in everything we do.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h3>Our Promise</h3>
                    <p>We promise transparency in every transaction, authenticity in every product, and excellence in every interaction. Your trust is our most valuable asset.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     VALUES SECTION
============================================ -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">
                <span>Our Principles</span>
            </div>
            <h2 class="section-title">Core Values That Drive Us</h2>
            <p class="section-subtitle">
                These principles guide every decision we make and every interaction we have with our customers.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="value-content">
                        <h4>Trust & Transparency</h4>
                        <p>We believe in complete honesty and openness. Every product listing is accurate, every price is fair, and every transaction is secure.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <div class="value-content">
                        <h4>Quality Assurance</h4>
                        <p>We handpick every product ensuring it meets our strict quality standards. Your satisfaction is our guarantee on every purchase.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="value-content">
                        <h4>Customer First</h4>
                        <p>Our customers are at the heart of everything we do. Your needs, feedback, and satisfaction drive our continuous improvement.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <div class="value-content">
                        <h4>Innovation</h4>
                        <p>We constantly evolve and innovate to bring you the latest trends, best technologies, and most convenient shopping experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     FEATURES SECTION
============================================ -->
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">
                <span>Why Choose Us</span>
            </div>
            <h2 class="section-title">The MyShop Advantage</h2>
            <p class="section-subtitle">
                Experience the difference with our premium services designed to make your shopping effortless and enjoyable.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h4>Fast Delivery</h4>
                    <p>Get your orders delivered quickly and reliably. Free shipping on orders over $50 with real-time tracking.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <h4>Secure Payment</h4>
                    <p>Multiple payment options with bank-level security. Your financial data is always protected with us.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Our dedicated support team is available around the clock to assist you via chat, email, or phone.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-rotate-left"></i>
                    </div>
                    <h4>Easy Returns</h4>
                    <p>Not satisfied? Return within 30 days for a full refund. Hassle-free returns with no questions asked.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     TEAM SECTION
============================================ -->
<section class="team-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">
                <span>Meet The Team</span>
            </div>
            <h2 class="section-title">The People Behind MyShop</h2>
            <p class="section-subtitle">
                A passionate team dedicated to bringing you the best online shopping experience.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://ui-avatars.com/api/?name=Ahmed+Smith&background=667eea&color=fff&size=150" alt="Team Member">
                    </div>
                    <h4>Ahmed Smith</h4>
                    <span class="role">Founder & CEO</span>
                    <p>Visionary leader with 15+ years in e-commerce, driving innovation and customer satisfaction.</p>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=c084fc&color=fff&size=150" alt="Team Member">
                    </div>
                    <h4>Sarah Johnson</h4>
                    <span class="role">Head of Operations</span>
                    <p>Operations expert ensuring smooth logistics and exceptional customer experiences daily.</p>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://ui-avatars.com/api/?name=Mike+Chen&background=34d399&color=fff&size=150" alt="Team Member">
                    </div>
                    <h4>Mike Chen</h4>
                    <span class="role">Chief Technology Officer</span>
                    <p>Tech innovator building robust, scalable solutions for the best shopping platform.</p>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                        <a href="#"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CTA SECTION
============================================ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Start Shopping?</h2>
            <p>Join thousands of satisfied customers and discover amazing products at unbeatable prices.</p>
            <div class="cta-buttons">
                <a href="{{ route('show.products.index') }}" class="btn btn-primary-gradient">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Start Shopping Now
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-outline-light-custom">
                    <i class="fa-solid fa-headset"></i>
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
