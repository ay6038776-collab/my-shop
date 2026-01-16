@extends('show.layouts.videos')

@section('title', 'Website Videos')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .video-section {
        padding: 50px 0;
    }

    .video-section h2 {
        color: #ff4b5c;
        font-weight: 700;
        text-shadow: 0 0 10px rgba(255, 75, 92, 0.6);
    }

    .video-card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .video-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 12px 25px rgba(255, 75, 92, 0.4);
    }

    .video-card iframe {
        border-radius: 20px 20px 0 0;
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-body h5 {
        color: #fff;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-body p {
        color: #ccc;
        font-size: 14px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }
</style>

<div class="container video-section">
    <h2 class="text-center mb-5">🎬 Website Videos</h2>

    <div class="row">
        @foreach($videos as $video)
            <div class="col-md-4 col-sm-6">
                <div class="video-card">
                    @php
                        preg_match('/v=([^\&]+)/', $video->youtube_url, $matches);
                        $videoId = $matches[1] ?? '';
                    @endphp

                    @if($videoId)
                        <iframe width="100%" height="230"
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    @else
                        <p class="text-center text-danger py-5">❌ Invalid video link</p>
                    @endif

                    <div class="card-body">
                        <h5>{{ $video->title }}</h5>
                        <p>{{ $video->description ?? 'No description available for this video.' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection