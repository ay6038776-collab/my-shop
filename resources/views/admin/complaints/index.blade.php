@extends('layouts.app')
@section('title', 'Complaints - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints - My Shop Admin</title>
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

.topbar-right { display: flex; align-items: center; gap: 14px; }

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
.main { padding: 28px 32px; max-width: 1400px; margin: 0 auto; }

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
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header p { color: var(--gray); font-size: 0.92rem; }

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 18px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}

.stat-card.blue::before { background: linear-gradient(180deg, var(--primary), var(--primary-dark)); }
.stat-card.orange::before { background: linear-gradient(180deg, var(--warning), #d97706); }
.stat-card.green::before { background: linear-gradient(180deg, var(--success), #059669); }
.stat-card.red::before { background: linear-gradient(180deg, var(--danger), #dc2626); }

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
}

.stat-card.blue .stat-icon { background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); color: var(--primary); }
.stat-card.orange .stat-icon { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: var(--warning); }
.stat-card.green .stat-icon { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: var(--success); }
.stat-card.red .stat-icon { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: var(--danger); }

.stat-info h3 { font-size: 1.6rem; font-weight: 700; color: var(--dark); line-height: 1; margin-bottom: 4px; }
.stat-info p { font-size: 0.82rem; color: var(--gray); font-weight: 500; }

/* Alert */
.alert {
    padding: 16px 20px;
    border-radius: 12px;
    font-size: 0.9rem;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideDown 0.4s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.alert-success { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border: 1px solid #a7f3d0; }

/* Complaints Cards Grid */
.complaints-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 20px;
}

.complaint-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.complaint-card:nth-child(1) { animation-delay: 0.05s; }
.complaint-card:nth-child(2) { animation-delay: 0.1s; }
.complaint-card:nth-child(3) { animation-delay: 0.15s; }
.complaint-card:nth-child(4) { animation-delay: 0.2s; }
.complaint-card:nth-child(5) { animation-delay: 0.25s; }
.complaint-card:nth-child(6) { animation-delay: 0.3s; }

.complaint-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 45px rgba(0,0,0,0.12);
    border-color: var(--primary);
}

.complaint-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.sender-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.sender-avatar {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.sender-details {}

.sender-name {
    font-weight: 600;
    font-size: 1rem;
    color: var(--dark);
    margin-bottom: 2px;
}

.sender-email {
    font-size: 0.8rem;
    color: var(--gray);
}

.complaint-date {
    text-align: right;
}

.complaint-date .date {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--dark);
}

.complaint-date .time {
    font-size: 0.75rem;
    color: var(--gray);
}

.complaint-subject {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.complaint-subject i {
    color: var(--primary);
    font-size: 0.9rem;
}

.complaint-message {
    font-size: 0.88rem;
    color: var(--gray);
    line-height: 1.6;
    margin-bottom: 18px;
    padding: 14px;
    background: var(--bg);
    border-radius: 10px;
    border-left: 3px solid var(--primary);
}

.complaint-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid var(--border);
}

.complaint-id {
    font-size: 0.75rem;
    color: var(--gray);
    display: flex;
    align-items: center;
    gap: 6px;
}

.complaint-id i {
    font-size: 0.7rem;
}

.action-btns {
    display: flex;
    gap: 10px;
}

.icon-btn {
    padding: 10px 18px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: 'Poppins', sans-serif;
}

.icon-btn.view {
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: var(--primary-dark);
}

.icon-btn.view:hover {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.35);
}

.icon-btn.delete {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
}

.icon-btn.delete:hover {
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.8rem;
    color: var(--success);
}

.empty-state h3 { font-size: 1.4rem; color: var(--dark); margin-bottom: 8px; }
.empty-state p { color: var(--gray); font-size: 0.95rem; }

/* Pagination */
.pagination-wrap {
    margin-top: 28px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 8px;
    align-items: center;
}

.pagination a, .pagination span {
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination a {
    background: white;
    color: var(--gray);
    border: 1px solid var(--border);
}

.pagination a:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination span {
    background: var(--primary);
    color: white;
}

/* Responsive */
@media (max-width: 992px) {
    .complaints-grid { grid-template-columns: 1fr; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .topbar { padding: 14px 20px; }
    .main { padding: 20px; }
    .stats-grid { grid-template-columns: 1fr; }
    .complaint-card { padding: 18px; }
    .page-header h1 { font-size: 1.4rem; }
}

@media (max-width: 480px) {
    .complaint-footer { flex-direction: column; gap: 12px; }
    .action-btns { width: 100%; }
    .icon-btn { flex: 1; justify-content: center; }
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
            <i class="fa-solid fa-arrow-left"></i>
            Dashboard
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="page-header">
        <div>
            <h1><i class="fa-solid fa-envelope-open-text"></i> Customer Complaints</h1>
            <p>Review and manage all customer complaints and feedback</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $complaints->total() }}</h3>
                <p>Total Complaints</p>
            </div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $complaints->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>This Week</p>
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $complaints->count() }}</h3>
                <p>This Page</p>
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fa-solid fa-fire"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $complaints->count() }}</h3>
                <p>Pending Review</p>
            </div>
        </div>
    </div>

    @if($complaints->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3>No Complaints</h3>
            <p>All clear! No customer complaints at the moment.</p>
        </div>
    @else
        <div class="complaints-grid">
            @foreach($complaints as $complaint)
                <div class="complaint-card">
                    <div class="complaint-header">
                        <div class="sender-info">
                            <div class="sender-avatar">
                                {{ strtoupper(substr($complaint->name, 0, 1)) }}
                            </div>
                            <div class="sender-details">
                                <div class="sender-name">{{ $complaint->name }}</div>
                                <div class="sender-email">{{ $complaint->email }}</div>
                            </div>
                        </div>
                        <div class="complaint-date">
                            <div class="date">{{ $complaint->created_at->format('M d, Y') }}</div>
                            <div class="time">{{ $complaint->created_at->format('H:i') }}</div>
                        </div>
                    </div>

                    <div class="complaint-subject">
                        <i class="fa-solid fa-tag"></i>
                        {{ $complaint->subject }}
                    </div>

                    <div class="complaint-message">
                        {{ Str::limit($complaint->message, 150) }}
                    </div>

                    <div class="complaint-footer">
                        <div class="complaint-id">
                            <i class="fa-solid fa-hashtag"></i>
                            #{{ $complaint->id }}
                        </div>
                        <div class="action-btns">
                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="icon-btn view">
                                <i class="fa-solid fa-eye"></i>
                                View
                            </a>
                            <form method="POST" action="{{ route('admin.complaints.destroy', $complaint->id) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="icon-btn delete" onclick="return confirm('Delete this complaint?')">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            <div class="pagination">
                {{ $complaints->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
