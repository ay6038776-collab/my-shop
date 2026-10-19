@extends('layouts.app')
@section('title', 'Complaint Details - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint #{{ $complaint->id }} - My Shop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #1e293b;
    --gray: #64748b;
    --light-gray: #e2e8f0;
    --bg: #f1f5f9;
    --white: #ffffff;
    --border: #e2e8f0;
}

* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--dark); }

/* Topbar */
.topbar {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 16px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
}

.brand { display: flex; align-items: center; gap: 14px; }
.brand img { width: 44px; height: 44px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
.brand h2 { font-size: 1.2rem; font-weight: 700; color: white; text-shadow: 0 2px 10px rgba(0,0,0,0.2); }

.back-btn {
    padding: 10px 20px;
    border-radius: 10px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    backdrop-filter: blur(10px);
}

.back-btn:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-2px);
}

/* Main Content */
.main { padding: 28px 32px; max-width: 900px; margin: 0 auto; }

/* Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
    font-size: 0.85rem;
}

.breadcrumb a {
    color: var(--gray);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb a:hover { color: var(--primary); }

.breadcrumb span { color: var(--dark); font-weight: 500; }
.breadcrumb i { font-size: 0.7rem; color: var(--light-gray); }

/* Page Header */
.page-header {
    margin-bottom: 28px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 16px;
}

.page-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-header h1 i {
    color: var(--primary);
}

.page-header p { color: var(--gray); font-size: 0.92rem; }

/* Detail Card */
.detail-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.06);
    border: 1px solid var(--border);
    overflow: hidden;
    margin-bottom: 24px;
    animation: fadeInUp 0.5s ease;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-header {
    padding: 24px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
}

.card-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header .complaint-id-badge {
    background: rgba(255,255,255,0.2);
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
}

.card-body { padding: 28px; }

/* Sender Section */
.sender-section {
    display: flex;
    gap: 20px;
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 1px dashed var(--border);
}

.sender-avatar {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.6rem;
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
    flex-shrink: 0;
}

.sender-details { flex: 1; }

.sender-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 4px;
}

.sender-email {
    font-size: 0.92rem;
    color: var(--gray);
    display: flex;
    align-items: center;
    gap: 6px;
}

.sender-email i { color: var(--primary); }

.sender-meta {
    display: flex;
    gap: 20px;
    margin-top: 12px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.82rem;
    color: var(--gray);
}

.meta-item i { color: var(--primary); font-size: 0.8rem; }

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

@media (max-width: 600px) {
    .info-grid { grid-template-columns: 1fr; }
}

.info-box {
    background: var(--bg);
    border-radius: 14px;
    padding: 18px;
    border-left: 4px solid var(--primary);
}

.info-box.full-width { grid-column: 1 / -1; }

.info-label {
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.info-label i { color: var(--primary); }

.info-value {
    font-size: 0.95rem;
    color: var(--dark);
    font-weight: 500;
    line-height: 1.5;
}

/* Message Box */
.message-box {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 16px;
    padding: 24px;
    border-left: 5px solid var(--warning);
    margin-bottom: 24px;
}

.message-box .info-label { color: #92400e; margin-bottom: 10px; }
.message-box .info-label i { color: #f59e0b; }
.message-box .info-value { color: #78350f; font-size: 1rem; line-height: 1.7; white-space: pre-wrap; }

/* Actions */
.card-actions {
    padding: 20px 28px;
    border-top: 1px solid var(--border);
    background: var(--bg);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.action-left {
    display: flex;
    gap: 12px;
    align-items: center;
}

.action-right { display: flex; gap: 12px; }

.btn {
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
}

.btn-view {
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: var(--primary-dark);
}

.btn-view:hover {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
}

.btn-delete {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
}

.btn-delete:hover {
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.35);
}

.btn-back {
    background: white;
    color: var(--gray);
    border: 1px solid var(--border);
}

.btn-back:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateY(-2px);
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.82rem;
    font-weight: 600;
}

.status-badge.pending {
    background: #fef3c7;
    color: #92400e;
}

.status-badge.resolved {
    background: #d1fae5;
    color: #065f46;
}

/* Responsive */
@media (max-width: 768px) {
    .topbar { padding: 14px 20px; }
    .main { padding: 20px; }
    .sender-section { flex-direction: column; align-items: center; text-align: center; }
    .sender-meta { justify-content: center; }
    .card-header { flex-direction: column; gap: 12px; align-items: flex-start; }
    .card-actions { flex-direction: column; }
    .action-left, .action-right { width: 100%; justify-content: center; }
    .btn { flex: 1; justify-content: center; }
}
</style>

@section('content')
<!-- TOPBAR -->
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="My Shop">
        <h2>My Shop Admin</h2>
    </div>
    <a href="{{ route('admin.complaints.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Complaints
    </a>
</div>

<!-- MAIN -->
<div class="main">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ url('admin/index') }}">Dashboard</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('admin.complaints.index') }}">Complaints</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>#{{ $complaint->id }}</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1><i class="fa-solid fa-envelope-open-text"></i> Complaint #{{ $complaint->id }}</h1>
            <p>Review customer complaint details and take action</p>
        </div>
        <div class="status-badge pending">
            <i class="fa-solid fa-clock"></i>
            {{ $complaint->status ?? 'Pending Review' }}
        </div>
    </div>

    <!-- Detail Card -->
    <div class="detail-card">
        <div class="card-header">
            <h3>
                <i class="fa-solid fa-user-circle"></i>
                Complaint Details
            </h3>
            <span class="complaint-id-badge">
                <i class="fa-solid fa-hashtag"></i>
                {{ $complaint->id }}
            </span>
        </div>

        <div class="card-body">
            <!-- Sender Info -->
            <div class="sender-section">
                <div class="sender-avatar">
                    {{ strtoupper(substr($complaint->name, 0, 1)) }}
                </div>
                <div class="sender-details">
                    <div class="sender-name">{{ $complaint->name }}</div>
                    <div class="sender-email">
                        <i class="fa-solid fa-envelope"></i>
                        {{ $complaint->email }}
                    </div>
                    <div class="sender-meta">
                        <div class="meta-item">
                            <i class="fa-solid fa-calendar"></i>
                            {{ $complaint->created_at->format('M d, Y') }}
                        </div>
                        <div class="meta-item">
                            <i class="fa-solid fa-clock"></i>
                            {{ $complaint->created_at->format('H:i') }}
                        </div>
                        <div class="meta-item">
                            <i class="fa-solid fa-hourglass-half"></i>
                            {{ $complaint->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject & Message -->
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-label">
                        <i class="fa-solid fa-tag"></i>
                        Subject
                    </div>
                    <div class="info-value">{{ $complaint->subject }}</div>
                </div>

                <div class="info-box">
                    <div class="info-label">
                        <i class="fa-solid fa-flag"></i>
                        Status
                    </div>
                    <div class="info-value">
                        @if($complaint->status == 'resolved')
                            <span class="status-badge resolved">
                                <i class="fa-solid fa-check-circle"></i>
                                Resolved
                            </span>
                        @else
                            <span class="status-badge pending">
                                <i class="fa-solid fa-clock"></i>
                                Pending Review
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="message-box">
                <div class="info-label">
                    <i class="fa-solid fa-comment-dots"></i>
                    Message Content
                </div>
                <div class="info-value">{{ $complaint->message }}</div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card-actions">
            <div class="action-left">
                <a href="{{ route('admin.complaints.index') }}" class="btn btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to List
                </a>
            </div>
            <div class="action-right">
                <a href="{{ route('admin.complaints.index') }}" class="btn btn-view">
                    <i class="fa-solid fa-list"></i>
                    All Complaints
                </a>
                <form method="POST" action="{{ route('admin.complaints.destroy', $complaint->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this complaint?')">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
