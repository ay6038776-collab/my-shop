@extends('show.layouts.videos')

@section('title', 'MyShop Videos')

@section('content')

<style>
    /* ============================================
       HERO SECTION
    ============================================ */
    .videos-hero {
        position: relative;
        padding: 4rem 0 3rem;
        text-align: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        background: rgba(129, 140, 248, 0.15);
        border: 1px solid rgba(129, 140, 248, 0.3);
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .hero-badge i {
        color: #818cf8;
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
        animation: fadeInUp 0.6s ease-out;
    }

    .hero-title .highlight {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.125rem;
        color: #94a3b8;
        max-width: 600px;
        margin: 0 auto 2rem;
        animation: fadeInUp 0.6s ease-out 0.2s backwards;
    }

    .videos-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin-top: 2rem;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
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
        margin-top: 0.25rem;
    }

    /* ============================================
       VIDEO CARDS
    ============================================ */
    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .video-card {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1.5rem;
        overflow: hidden;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .video-card:nth-child(1) { animation-delay: 0.1s; }
    .video-card:nth-child(2) { animation-delay: 0.2s; }
    .video-card:nth-child(3) { animation-delay: 0.3s; }
    .video-card:nth-child(4) { animation-delay: 0.4s; }
    .video-card:nth-child(5) { animation-delay: 0.5s; }
    .video-card:nth-child(6) { animation-delay: 0.6s; }

    .video-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(129, 140, 248, 0.25);
        border-color: rgba(129, 140, 248, 0.3);
    }

    .video-thumbnail {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 aspect ratio */
        overflow: hidden;
        background: #0f172a;
    }

    .video-thumbnail iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .video-play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(129, 140, 248, 0.1), rgba(192, 132, 252, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .video-card:hover .video-play-overlay {
        opacity: 1;
    }

    .video-content {
        padding: 1.5rem;
    }

    .video-category {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.75rem;
        background: rgba(129, 140, 248, 0.2);
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .video-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .video-description {
        font-size: 0.95rem;
        color: #94a3b8;
        line-height: 1.7;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .video-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .video-date {
        font-size: 0.85rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .video-date i {
        color: #818cf8;
    }

    .video-actions {
        display: flex;
        gap: 0.5rem;
    }

    .video-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .video-action-btn:hover {
        background: rgba(129, 140, 248, 0.2);
        border-color: #818cf8;
        color: #818cf8;
        transform: translateY(-2px);
    }

    /* ============================================
       EMPTY STATE
    ============================================ */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(30, 41, 59, 0.5);
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: 1.5rem;
        margin-top: 3rem;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(129, 140, 248, 0.2), rgba(129, 140, 248, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .empty-icon i {
        font-size: 3rem;
        color: #818cf8;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .empty-description {
        color: #94a3b8;
        margin-bottom: 1.5rem;
    }

    .btn-add-video {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #818cf8, #c084fc);
        border: none;
        border-radius: 50px;
        color: #ffffff;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-add-video:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(129, 140, 248, 0.4);
        color: #ffffff;
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
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .videos-stats {
            gap: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .video-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .video-content {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .videos-hero {
            padding: 2rem 0 2rem;
        }

        .hero-badge {
            font-size: 0.75rem;
            padding: 0.4rem 1rem;
        }
    }
</style>

<!-- ============================================
     HERO SECTION
============================================ -->
<section class="videos-hero">
    <div class="container">
        <div class="hero-badge">
            <i class="fa-solid fa-video"></i>
            <span>Watch & Learn</span>
        </div>
        <h1 class="hero-title">
            Discover Our <span class="highlight">Videos</span>
        </h1>
        <p class="hero-description">
            Explore our collection of videos showcasing our products, tutorials, and behind-the-scenes content. Stay updated with the latest from MyShop!
        </p>
        
        @if(isset($videos) && count($videos) > 0)
        <div class="videos-stats">
            <div class="stat-item">
                <div class="stat-number">{{ count($videos) }}</div>
                <div class="stat-label">Videos</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">HD</div>
                <div class="stat-label">Quality</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Available</div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- ============================================
     VIDEOS GRID
============================================ -->
<div class="container">
    @if(isset($videos) && count($videos) > 0)
        <div class="video-grid">
            @foreach($videos as $video)
                <div class="video-card">
                    <div class="video-thumbnail">
                        @php
                            preg_match('/v=([^\&]+)/', $video->youtube_url, $matches);
                            $videoId = $matches[1] ?? '';
                        @endphp

                        @if($videoId)
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center p-4">
                                    <i class="fa-solid fa-link-slash fa-3x text-secondary mb-2"></i>
                                    <p class="text-secondary mb-0">Invalid video link</p>
                                </div>
                            </div>
                        @endif
                        <div class="video-play-overlay">
                            <i class="fa-solid fa-play-circle fa-4x text-white"></i>
                        </div>
                    </div>
                    <div class="video-content">
                        <div class="video-category">
                            <i class="fa-solid fa-play"></i>
                            Tutorial
                        </div>
                        <h3 class="video-title">{{ $video->title }}</h3>
                        <p class="video-description">
                            {{ $video->description ?? 'No description available for this video. Check back soon for more content!' }}
                        </p>
                        <div class="video-meta">
                            <div class="video-date">
                                <i class="fa-solid fa-calendar"></i>
                                {{ $video->created_at ? $video->created_at->format('M d, Y') : 'Recently added' }}
                            </div>
                            <div class="video-actions">
                                <a href="{{ $video->youtube_url }}" target="_blank" class="video-action-btn" title="Open on YouTube">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="#" class="video-action-btn" title="Share">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-video-slash"></i>
            </div>
            <h3 class="empty-title">No Videos Yet</h3>
            <p class="empty-description">
                We're working on adding exciting videos. Check back soon for tutorials, product showcases, and more!
            </p>
            <a href="{{ route('home') }}" class="btn-add-video">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
    @endif
</div>

@endsection
