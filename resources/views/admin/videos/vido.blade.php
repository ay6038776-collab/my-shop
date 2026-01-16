@extends('layouts.domen')

@section('title', 'Video Dashboard')

@section('content')

@php
    $stars = [];
    for ($i = 0; $i < 100; $i++) {
        $stars[] = [
            'top' => rand(0, 100) . 'vh',
            'left' => rand(0, 100) . 'vw',
            'size' => rand(1, 3) . 'px',
            'delay' => rand(0, 2000) / 1000 . 's'
        ];
    }
@endphp

{{-- Stars Background --}}
@foreach ($stars as $star)
    <div class="star" style="
        --top: {{ $star['top'] }};
        --left: {{ $star['left'] }};
        --size: {{ $star['size'] }};
        --delay: {{ $star['delay'] }};
    "></div>
@endforeach

{{-- Planets --}}
<div class="planet" style="top: 20%; left: 30%; width: 60px; height: 60px;"></div>
<div class="planet" style="top: 70%; left: 70%; width: 80px; height: 80px;"></div>
<div class="planet" style="top: 50%; left: 10%; width: 40px; height: 40px;"></div>

<div class="container py-5 position-relative" style="z-index: 5;">
    
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold shadow-lg rounded-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-light">🎬 Video List</h2>
        <a href="{{ route('videos.create') }}" class="btn btn-primary btn-lg rounded-4 shadow">
            ➕ Add New Video
        </a>
    </div>

    {{-- Videos Grid --}}
    <div class="row">
        @forelse($videos as $video)
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden video-card">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($video->youtube_url, 'v=') }}" 
                            title="{{ $video->title }}" 
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold text-white">{{ $video->title }}</h5>
                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this video?')" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 rounded-4 fw-bold">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted fs-5 mt-5">🚫 No videos available yet.</p>
        @endforelse
    </div>
</div>

{{-- Custom Styles --}}
<style>
    /* Galaxy Background */
    body {
        background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
        color: #fff;
        overflow-x: hidden;
        position: relative;
    }

    /* Stars */
    .star {
        position: absolute;
        top: var(--top);
        left: var(--left);
        width: var(--size);
        height: var(--size);
        background: white;
        border-radius: 50%;
        opacity: 0.8;
        animation: twinkle 2s infinite;
        animation-delay: var(--delay);
        z-index: 1;
    }

    @keyframes twinkle {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 0.2; }
    }

    /* Planets */
    .planet {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle at 20% 20%, #ffcc00, #ff6600);
        box-shadow: 0 0 20px rgba(255, 102, 0, 0.7);
        z-index: 1;
        opacity: 0.6;
    }

    /* Cards */
    .video-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease-in-out;
    }

    .video-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 10px 25px rgba(255, 75, 92, 0.4);
    }

    iframe {
        border: none;
    }
</style>

@endsection