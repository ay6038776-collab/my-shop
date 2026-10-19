{{-- resources/views/show/contact.blade.php (Professional Contact Page 2024) --}}
@extends('show.layouts.app')

@section('title', 'Contact Us - MyShop')

@section('content')

<style>
    /* ============================================
       HERO SECTION
    ============================================ */
    .contact-hero {
        position: relative;
        min-height: 50vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        overflow: hidden;
        margin-top: -1.5rem;
        padding: 4rem 0;
    }

    .contact-hero::before {
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
        text-align: center;
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
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
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
        max-width: 600px;
        margin: 0 auto;
    }

    /* ============================================
       CONTACT SECTION
    ============================================ */
    .contact-section {
        padding: 6rem 0;
        background: var(--bg-primary);
    }

    .contact-info-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 2.5rem;
        height: 100%;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .contact-info-card::before {
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

    .contact-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.2);
    }

    .contact-info-card:hover::before {
        transform: scaleX(1);
    }

    .info-icon {
        width: 70px;
        height: 70px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, rgba(129, 140, 248, 0.2), rgba(129, 140, 248, 0.1));
        color: #818cf8;
    }

    .contact-info-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .contact-info-card p {
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.7;
    }

    .contact-info-card a {
        color: #818cf8;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-info-card a:hover {
        color: #c084fc;
    }

    /* ============================================
       FORM SECTION
    ============================================ */
    .form-section {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 3rem;
        box-shadow: 0 10px 40px -15px rgba(0, 0, 0, 0.1);
    }

    .form-section h3 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .form-section .form-subtitle {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-floating > .form-control {
        background: var(--input-bg);
        border: 2px solid var(--input-border);
        border-radius: 1rem;
        padding: 1.5rem 1rem 0.75rem;
        height: auto;
        min-height: 60px;
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .form-floating > .form-control:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.15);
    }

    .form-floating > label {
        color: var(--text-secondary);
        padding: 1.25rem 1rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #818cf8;
    }

    textarea.form-control {
        min-height: 150px;
        resize: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        border: none;
        color: #ffffff;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(129, 140, 248, 0.4);
        color: #ffffff;
    }

    .btn-submit i {
        font-size: 1.25rem;
    }

    /* ============================================
       SOCIAL SECTION
    ============================================ */
    .social-section {
        padding: 4rem 0;
        background: var(--bg-secondary);
    }

    .social-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.4s ease;
    }

    .social-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
    }

    .social-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-link {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: #ffffff;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-link:hover {
        transform: translateY(-5px) scale(1.1);
        color: #ffffff;
    }

    .social-link.facebook {
        background: linear-gradient(135deg, #1877f2, #0d65d9);
    }

    .social-link.twitter {
        background: linear-gradient(135deg, #000000, #333333);
    }

    .social-link.instagram {
        background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    }

    .social-link.linkedin {
        background: linear-gradient(135deg, #0077b5, #00a0dc);
    }

    .social-link.tiktok {
        background: linear-gradient(135deg, #000000, #25f4ee, #fe2c55);
    }

    .social-link.youtube {
        background: linear-gradient(135deg, #ff0000, #cc0000);
    }

    .social-link.whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
    }

    /* ============================================
       MAP SECTION
    ============================================ */
    .map-section {
        padding: 4rem 0;
        background: var(--bg-primary);
    }

    .map-container {
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 20px 50px -20px rgba(0, 0, 0, 0.3);
        border: 4px solid var(--border-color);
    }

    .map-container iframe {
        width: 100%;
        height: 450px;
        border: none;
    }

    /* ============================================
       FAQ / HOURS SECTION
    ============================================ */
    .hours-section {
        padding: 4rem 0;
        background: var(--bg-secondary);
    }

    .hours-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        padding: 2.5rem;
        height: 100%;
    }

    .hours-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .hours-card h4 i {
        color: #818cf8;
    }

    .hours-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .hours-list li {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-secondary);
    }

    .hours-list li:last-child {
        border-bottom: none;
    }

    .hours-list li span:first-child {
        font-weight: 600;
        color: var(--text-primary);
    }

    .hours-list li span:last-child {
        color: #34d399;
        font-weight: 600;
    }

    /* ============================================
       ALERTS
    ============================================ */
    .alert-success-custom {
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.1), rgba(52, 211, 153, 0.05));
        border: 1px solid rgba(52, 211, 153, 0.3);
        border-radius: 1rem;
        color: #34d399;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .alert-success-custom i {
        font-size: 1.5rem;
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

    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 992px) {
        .contact-hero {
            min-height: auto;
            padding: 3rem 0;
        }

        .form-section {
            padding: 2rem;
        }

        .map-container iframe {
            height: 350px;
        }
    }

    @media (max-width: 768px) {
        .social-links {
            gap: 0.75rem;
        }

        .social-link {
            width: 50px;
            height: 50px;
            font-size: 1.1rem;
        }
    }
</style>

<!-- ============================================
     HERO SECTION
============================================ -->
<section class="contact-hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa-solid fa-headset"></i>
                <span>We're Here to Help</span>
            </div>
            <h1 class="hero-title">
                Get in <span class="highlight">Touch</span>
            </h1>
            <p class="hero-description">
                Have questions or feedback? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </div>
    </div>
</section>

<!-- ============================================
     CONTACT INFO SECTION
============================================ -->
<section class="contact-section">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Address -->
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4>Our Location</h4>
                    <p>123 Commerce Street<br>Business District<br>Cairo, Egypt</p>
                </div>
            </div>
            <!-- Phone -->
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <h4>Phone Number</h4>
                    <p>
                        <a href="tel:+20123456789">+20 123 456 789</a><br>
                        <a href="tel:+20123456790">+20 123 456 790</a><br>
                        <small class="text-muted">Sun - Thu: 9AM - 6PM</small>
                    </p>
                </div>
            </div>
            <!-- Email -->
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card">
                    <div class="info-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h4>Email Address</h4>
                    <p>
                        <a href="mailto:info@myshop.com">info@myshop.com</a><br>
                        <a href="mailto:support@myshop.com">support@myshop.com</a><br>
                        <small class="text-muted">We reply within 24 hours</small>
                    </p>
                </div>
            </div>
        </div>

        <!-- ============================================
             CONTACT FORM SECTION
        ============================================= -->
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <div class="form-section">
                    <h3><i class="fa-solid fa-paper-plane text-primary me-2"></i>Send Us a Message</h3>
                    <p class="form-subtitle">Fill out the form below and we'll get back to you shortly.</p>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert-success-custom">
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <strong>Message Sent!</strong><br>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Your Name" value="{{ old('name') }}" required>
                                    <label for="name"><i class="fa-solid fa-user me-2"></i>Your Name</label>
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Email Address" value="{{ old('email') }}" required>
                                    <label for="email"><i class="fa-solid fa-at me-2"></i>Email Address</label>
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-floating">
                            <input type="text" name="subject" class="form-control" id="subject"
                                   placeholder="Subject" value="{{ old('subject') }}" required>
                            <label for="subject"><i class="fa-solid fa-heading me-2"></i>Subject</label>
                        </div>
                        @error('subject')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-floating">
                            <textarea name="message" class="form-control" id="message"
                                      placeholder="Your Message" style="height: 150px" required>{{ old('message') }}</textarea>
                            <label for="message"><i class="fa-solid fa-comment me-2"></i>Your Message</label>
                        </div>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-5">
                <!-- Working Hours -->
                <div class="hours-card mb-4">
                    <h4><i class="fa-solid fa-clock"></i> Working Hours</h4>
                    <ul class="hours-list">
                        <li>
                            <span>Saturday - Thursday</span>
                            <span>9:00 AM - 6:00 PM</span>
                        </li>
                        <li>
                            <span>Friday</span>
                            <span>Closed</span>
                        </li>
                        <li>
                            <span>Emergency Support</span>
                            <span>24/7</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Response -->
                <div class="contact-info-card">
                    <div class="info-icon" style="background: linear-gradient(135deg, rgba(52, 211, 153, 0.2), rgba(52, 211, 153, 0.1)); color: #34d399;">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h4>Quick Response</h4>
                    <p>We typically respond within <strong>2-4 hours</strong> during business hours. For urgent matters, call us directly!</p>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ============================================
     SOCIAL SECTION
============================================ -->
<section class="social-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="social-card">
                    <h3 class="social-title">Connect With Us</h3>
                    <p class="text-muted mb-4">Follow us on social media for updates, offers, and more!</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/profile.php?id=100090847241292&ref=_ig_profile_ac"
                           target="_blank" class="social-link facebook" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/ay603877ea"
                           target="_blank" class="social-link twitter" title="X (Twitter)">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/amh_ahmed123/"
                           target="_blank" class="social-link instagram" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/ahmad-yasser-978796393"
                           target="_blank" class="social-link linkedin" title="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.tiktok.com/@c_a_408?is_from_webapp=1&sender_device=pc"
                           target="_blank" class="social-link tiktok" title="TikTok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://www.youtube.com/@Car-q5o" class="social-link youtube" title="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://wa.me/201505422414" class="social-link whatsapp" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     MAP SECTION
============================================ -->
<section class="map-section">
    <div class="container">
        <div class="map-container">
       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7776.470026684667!2d31.520159535003632!3d31.024679405528335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sar!2seg!4v1782909299173!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
    </div>
</section>

@endsection
