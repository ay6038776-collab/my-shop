@extends('layouts.app')
@section('title', 'Videos - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos - My Shop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<style>
:root {
    --primary: #4f46e5;
    --primary-light: #818cf8;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #0f172a;
    --gray: #64748b;
    --light-gray: #e2e8f0;
    --bg: #f1f5f9;
    --white: #ffffff;
}

* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--dark); }

.topbar {
    background: var(--white); padding: 14px 28px;
    display: flex; justify-content: space-between; align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100;
}
.brand { display: flex; align-items: center; gap: 12px; }
.brand img { width: 42px; height: 42px; border-radius: 10px; }
.brand h2 { font-size: 1.15rem; font-weight: 700; color: var(--primary); }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.back-btn {
    padding: 8px 16px; border-radius: 8px; background: var(--bg);
    border: 1px solid var(--light-gray); color: var(--dark); text-decoration: none;
    font-size: 0.82rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;
}
.back-btn:hover { background: var(--primary); color: white; border-color: var(--primary); }

.main { padding: 24px 28px; }

.page-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
}
.page-header h1 { font-size: 1.35rem; font-weight: 700; color: var(--dark); }
.page-header p { color: var(--gray); font-size: 0.82rem; margin-top: 2px; }

.alert {
    padding: 12px 16px; border-radius: 10px; font-size: 0.85rem;
    margin-bottom: 18px; display: flex; align-items: center; gap: 10px;
}
.alert-success { background: #d1fae5; color: #065f46; }

.stats-bar { display: flex; gap: 16px; margin-bottom: 24px; }
.stat-mini {
    background: var(--white); border-radius: 12px; padding: 16px 24px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04); min-width: 160px;
}
.stat-mini i { font-size: 1.2rem; }
.stat-mini.purple i { color: #9333ea; }
.stat-mini h3 { font-size: 1.3rem; font-weight: 700; line-height: 1; }
.stat-mini p { font-size: 0.72rem; color: var(--gray); margin-top: 2px; }

.btn {
    padding: 9px 18px; border-radius: 8px; font-size: 0.82rem;
    font-weight: 600; cursor: pointer; transition: all 0.3s;
    border: none; display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Poppins'; text-decoration: none;
}
.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover { background: #3730a3; }
.btn-danger { background: var(--danger); color: white; }
.btn-danger:hover { background: #dc2626; }

/* VIDEO GRID */
.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
    margin-top: 4px;
}

.video-card {
    background: var(--white); border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    overflow: hidden; transition: all 0.3s;
}
.video-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(79,70,229,0.12);
}

.video-embed {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0; overflow: hidden;
}
.video-embed iframe {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%; border: none;
}

.video-body { padding: 16px; }
.video-title {
    font-size: 0.92rem; font-weight: 600; color: var(--dark);
    margin-bottom: 12px; display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; line-height: 1.4;
}
.video-meta {
    display: flex; justify-content: space-between; align-items: center;
    font-size: 0.75rem; color: var(--gray); margin-bottom: 12px;
}
.video-actions { display: flex; gap: 8px; }
.video-actions .btn { padding: 7px 14px; font-size: 0.78rem; flex: 1; justify-content: center; }

.empty-state { text-align: center; padding: 60px 20px; }
.empty-state i { font-size: 3rem; color: var(--light-gray); margin-bottom: 12px; }
.empty-state h3 { font-size: 1.1rem; color: var(--dark); margin-bottom: 6px; }
.empty-state p { color: var(--gray); font-size: 0.85rem; }

@media (max-width: 900px) {
    .stats-bar { flex-wrap: wrap; }
    .topbar { padding: 12px 16px; }
    .main { padding: 16px; }
    .video-grid { grid-template-columns: 1fr; }
}
</style>

@section('content')
<!-- TOPBAR -->
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="My Shop">
        <h2>My Shop Admin</h2>
    </div>
    <div class="topbar-right">
        <a href="{{ url('admin/index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="page-header">
        <div>
            <h1>Video Management</h1>
            <p>Manage YouTube videos shown on the store's video gallery</p>
        </div>
        <a href="{{ route('videos.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add New Video
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="stats-bar">
        <div class="stat-mini purple">
            <i class="fa-brands fa-youtube"></i>
            <div>
                <h3>{{ $videos->count() }}</h3>
                <p>Total Videos</p>
            </div>
        </div>
    </div>

    @if($videos->isEmpty())
        <div class="empty-state">
            <i class="fa-brands fa-youtube" style="font-size:3.5rem;"></i>
            <h3>No Videos Yet</h3>
            <p>Start by adding your first YouTube video to the gallery</p>
            <a href="{{ route('videos.create') }}" class="btn btn-primary" style="margin-top:16px;">
                <i class="fa-solid fa-plus"></i> Add First Video
            </a>
        </div>
    @else
        <div class="video-grid">
            @foreach($videos as $video)
                @php
                    $videoId = '';
                    $url = $video->youtube_url ?? '';
                    if (str_contains($url, 'v=')) {
                        $videoId = substr($url, strpos($url, 'v=') + 2);
                        $videoId = preg_replace('/[&].*/', '', $videoId);
                    } elseif (preg_match('/\/embed\/([^?&]+)/', $url, $m)) {
                        $videoId = $m[1];
                    }
                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                @endphp
                <div class="video-card">
                    <div class="video-embed">
                        <iframe src="{{ $embedUrl }}"
                                title="{{ $video->title }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-body">
                        <div class="video-title">{{ $video->title }}</div>
                        <div class="video-meta">
                            <span><i class="fa-solid fa-calendar me-1"></i> {{ $video->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="video-actions">
                            <form method="POST" action="{{ route('videos.destroy', $video->id) }}"
                                  onsubmit="return confirm('Delete this video?')" style="flex:1;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width:100%;">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection