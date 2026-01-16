@extends('layouts.domen')
@section('title', 'Add New Video - Admin Panel')
@section('content')
<link rel="icon" href="{{ asset('MYshop3d.ico') }}" type="image/MYshop3d.ico">
@php
    $stars = [];
    for ($i = 0; $i < 100; $i++) {
        $stars[] = [
            'top' => rand(0, 100).'vh',
            'left' => rand(0, 100).'vw',
            'size' => rand(1, 3).'px',
            'delay' => rand(0, 2000)/1000 . 's'
        ];
    }
@endphp

{{-- Stars animation --}}
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

{{-- Main Form Container --}}
<div class="container mt-5">
    <div class="card shadow-lg p-5 rounded-4 border-0" style="backdrop-filter: blur(12px); background: rgba(255,255,255,0.08); color: #fff;">
        <h2 class="text-center fw-bold mb-4">🎬 Add New Video</h2>

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add Video Form --}}
        <form action="{{ route('videos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-light fw-semibold">Video Title</label>
                <input type="text" name="title" class="form-control bg-dark text-white border-0 shadow-sm" placeholder="Enter video title" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light fw-semibold">YouTube URL</label>
                <input type="url" name="youtube_url" class="form-control bg-dark text-white border-0 shadow-sm" placeholder="Paste YouTube video link" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">💾 Save Video</button>
            <a href="{{ route('videos.vido') }}" class="btn btn-outline-light w-100 mt-3 fw-bold py-2">↩ Back to Videos</a>
        </form>
    </div>
</div>

{{-- Style --}}
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(ellipse at bottom, #0d1b2a 0%, #000000 100%);
        overflow-x: hidden;
    }

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
    }

    @keyframes twinkle {
        0%, 100% { opacity: 0.9; }
        50% { opacity: 0.3; }
    }

    .planet {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, #ffcc00, #ff6600);
        box-shadow: 0 0 20px rgba(255, 102, 0, 0.8);
        animation: orbit 25s linear infinite;
    }

    @keyframes orbit {
        from { transform: rotate(0deg) translateX(0) rotate(0deg); }
        to { transform: rotate(360deg) translateX(0) rotate(-360deg); }
    }

    .form-control:focus {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }
</style>
@endsection