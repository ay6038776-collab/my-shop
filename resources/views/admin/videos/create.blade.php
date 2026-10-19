@extends('layouts.app')
@section('title', 'Add Video - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video - My Shop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<style>
:root {
    --primary: #4f46e5;
    --primary-light: #818cf8;
    --success: #10b981;
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
.alert-danger { background: #fee2e2; color: #991b1b; }

.panel {
    background: var(--white); border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); overflow: hidden; max-width: 640px;
}
.panel-head {
    padding: 18px 24px; border-bottom: 1px solid var(--light-gray);
    display: flex; justify-content: space-between; align-items: center;
}
.panel-head h3 { font-size: 0.95rem; font-weight: 600; display: flex; align-items: center; gap: 8px; color: var(--dark); }
.panel-head h3 i { color: #9333ea; }

.form-body { padding: 28px 24px; }

.form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; }
.form-group:last-child { margin-bottom: 0; }

.form-label {
    font-size: 0.8rem; font-weight: 600; color: var(--dark);
    display: flex; align-items: center; gap: 5px;
}
.form-label i { color: var(--primary); font-size: 0.75rem; }

.form-control {
    padding: 10px 14px;
    border: 1.5px solid var(--light-gray);
    border-radius: 10px; font-size: 0.85rem; font-family: 'Poppins';
    color: var(--dark); background: var(--white);
    transition: all 0.3s; outline: none;
}
.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
}
.form-control::placeholder { color: #94a3b8; }

/* YOUTUBE PREVIEW */
.preview-box {
    border: 2px dashed var(--light-gray); border-radius: 12px;
    padding: 20px; text-align: center; background: var(--bg);
    transition: all 0.3s;
}
.preview-box.has-video { border-color: #9333ea; background: rgba(147,51,234,0.04); }
.preview-box iframe {
    width: 100%; max-width: 480px; aspect-ratio: 16/9;
    border-radius: 10px; border: none; margin: 0 auto;
}
.preview-placeholder { color: var(--gray); font-size: 0.82rem; margin-top: 8px; }
.preview-placeholder i { color: #9333ea; font-size: 1.5rem; margin-bottom: 4px; display: block; }

.form-hint { font-size: 0.72rem; color: var(--gray); margin-top: 4px; }

.form-actions {
    padding: 16px 24px; border-top: 1px solid var(--light-gray);
    display: flex; justify-content: space-between; align-items: center;
    background: #fafafa;
}

.btn {
    padding: 10px 22px; border-radius: 10px; font-size: 0.85rem;
    font-weight: 600; cursor: pointer; transition: all 0.3s;
    border: none; display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Poppins'; text-decoration: none;
}
.btn-primary { background: #9333ea; color: white; }
.btn-primary:hover { background: #7e22ce; }
.btn-outline { background: transparent; border: 1.5px solid var(--light-gray); color: var(--gray); }
.btn-outline:hover { background: var(--bg); color: var(--dark); }

@media (max-width: 600px) {
    .topbar { padding: 12px 16px; }
    .main { padding: 16px; }
}
</style>

@section('content')
<!-- TOPBAR -->
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="My Shop">
        <h2>My Shop Admin</h2>
    </div>
    <a href="{{ route('videos.video') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back to Videos
    </a>
</div>

<!-- MAIN -->
<div class="main">
    <div class="page-header">
        <div>
            <h1>Add New Video</h1>
            <p>Add a YouTube video to your store's video gallery</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul style="margin:4px 0 0 16px;padding:0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="panel">
        <div class="panel-head">
            <h3><i class="fa-brands fa-youtube"></i> Video Details</h3>
            <span style="font-size:0.75rem;color:var(--gray);">YouTube URL required</span>
        </div>

        <form action="{{ route('videos.store') }}" method="POST" id="videoForm">
            @csrf

            <div class="form-body">
                <!-- Title -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-heading"></i> Video Title *</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title') }}"
                           placeholder="e.g. Summer Collection 2025 Preview" required>
                </div>

                <!-- YouTube URL -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-youtube"></i> YouTube URL *</label>
                    <input type="url" name="youtube_url" class="form-control"
                           id="youtubeUrl"
                           value="{{ old('youtube_url') }}"
                           placeholder="https://www.youtube.com/watch?v=..."
                           required>
                    <span class="form-hint">Paste a full YouTube video URL</span>
                </div>

                <!-- Preview -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-eye"></i> Preview</label>
                    <div class="preview-box" id="previewBox">
                        <div id="previewPlaceholder">
                            <i class="fa-brands fa-youtube" style="font-size:2rem;"></i>
                            <p class="preview-placeholder">Enter a YouTube URL above to preview</p>
                        </div>
                        <div id="previewVideo" style="display:none;"></div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('videos.video') }}" class="btn btn-outline">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Video
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const urlInput = document.getElementById('youtubeUrl');
    const previewBox = document.getElementById('previewBox');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const previewVideo = document.getElementById('previewVideo');

    urlInput.addEventListener('input', function () {
        const url = this.value.trim();
        let videoId = '';

        if (url.includes('v=')) {
            videoId = url.substring(url.indexOf('v=') + 2);
            videoId = videoId.split('&')[0];
        } else if (url.includes('youtu.be/')) {
            videoId = url.substring(url.indexOf('youtu.be/') + 9);
            videoId = videoId.split('?')[0];
        } else if (url.includes('/embed/')) {
            const match = url.match(/\/embed\/([^?&]+)/);
            if (match) videoId = match[1];
        }

        if (videoId) {
            previewPlaceholder.style.display = 'none';
            previewVideo.style.display = 'block';
            previewVideo.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}" allowfullscreen></iframe>`;
            previewBox.classList.add('has-video');
        } else {
            previewPlaceholder.style.display = 'block';
            previewVideo.style.display = 'none';
            previewVideo.innerHTML = '';
            previewBox.classList.remove('has-video');
        }
    });

    // Auto-trigger if there's a value on load
    if (urlInput.value) urlInput.dispatchEvent(new Event('input'));
});
</script>

@endsection