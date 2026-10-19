@extends('layouts.app')
@section('title', 'Dashboard - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Shop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
:root {
    --primary: #4f46e5;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
    --dark: #1e293b;
    --gray: #64748b;
    --light-gray: #e2e8f0;
    --white: #ffffff;
    --bg: #f1f5f9;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg);
    color: var(--dark);
}

/* ===== TOPBAR ===== */
.topbar {
    background: var(--white);
    padding: 12px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 100;
}

.brand { display: flex; align-items: center; gap: 12px; }
.brand img { width: 42px; height: 42px; border-radius: 10px; }
.brand h2 { font-size: 1.2rem; font-weight: 700; color: var(--primary); }

.topbar-actions { display: flex; gap: 12px; align-items: center; }

.icon-btn {
    width: 40px; height: 40px;
    border-radius: 10px;
    border: none;
    background: var(--bg);
    color: var(--gray);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    position: relative;
    transition: all 0.3s;
}
.icon-btn:hover { background: var(--primary); color: var(--white); }
.icon-btn .badge {
    position: absolute; top: -5px; right: -5px;
    background: var(--danger); color: white;
    font-size: 0.6rem; padding: 3px 6px;
    border-radius: 10px; font-weight: 700;
}

.admin-profile { display: flex; align-items: center; gap: 10px; }
.admin-profile img {
    width: 38px; height: 38px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary);
}
.admin-profile span { font-weight: 600; font-size: 0.85rem; }

/* ===== NOTIFICATION BELL ===== */
.notif-wrap { position: relative; }

.notif-btn {
    width: 40px; height: 40px;
    border-radius: 10px; border: none;
    background: var(--bg); color: var(--gray);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    position: relative; transition: all 0.3s; font-size: 1rem;
}
.notif-btn:hover { background: var(--primary); color: white; }
.notif-btn .dot {
    position: absolute; top: -3px; right: -3px;
    width: 18px; height: 18px; border-radius: 50%;
    background: var(--danger); color: white;
    font-size: 0.6rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid var(--white);
}

.notif-dropdown {
    position: absolute; top: calc(100% + 8px); right: 0;
    width: 360px; background: var(--white);
    border-radius: 14px; box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    border: 1px solid var(--light-gray);
    z-index: 9999; display: none;
    animation: dropIn 0.2s ease;
}
.notif-dropdown.open { display: block; }

@keyframes dropIn {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

.notif-drop-head {
    padding: 14px 16px; border-bottom: 1px solid var(--light-gray);
    display: flex; justify-content: space-between; align-items: center;
}
.notif-drop-head h4 { font-size: 0.88rem; font-weight: 700; color: var(--dark); }
.notif-drop-head .drop-actions { display: flex; gap: 8px; }
.notif-drop-head .drop-actions button {
    background: none; border: none; color: var(--primary);
    font-size: 0.72rem; font-weight: 600; cursor: pointer; padding: 4px 8px;
    border-radius: 6px; transition: all 0.2s;
}
.notif-drop-head .drop-actions button:hover { background: #e0e7ff; }

.notif-drop-body { max-height: 360px; overflow-y: auto; }
.notif-drop-body::-webkit-scrollbar { width: 4px; }
.notif-drop-body::-webkit-scrollbar-thumb { background: var(--light-gray); border-radius: 4px; }

.notif-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 12px 16px; border-bottom: 1px solid var(--light-gray);
    transition: background 0.2s; cursor: pointer;
}
.notif-item:hover { background: var(--bg); }
.notif-item:last-child { border-bottom: none; }

.notif-icon {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; flex-shrink: 0;
}

.notif-body { flex: 1; min-width: 0; }
.notif-body strong { font-size: 0.8rem; color: var(--dark); display: block; line-height: 1.4; }
.notif-body small { font-size: 0.68rem; color: var(--gray); margin-top: 2px; display: block; }
.notif-time { font-size: 0.65rem; color: var(--gray); white-space: nowrap; margin-left: 8px; }

.notif-del {
    background: none; border: none; color: var(--light-gray);
    cursor: pointer; font-size: 0.75rem; padding: 4px; border-radius: 4px;
    transition: all 0.2s; flex-shrink: 0;
}
.notif-del:hover { background: #fee2e2; color: var(--danger); }

.notif-empty {
    padding: 32px 16px; text-align: center;
    color: var(--gray); font-size: 0.82rem;
}
.notif-empty i { font-size: 2rem; margin-bottom: 8px; display: block; color: var(--light-gray); }

.notif-overlay {
    position: fixed; inset: 0; z-index: 9998; display: none;
}
.notif-overlay.open { display: block; }

/* ===== MAIN ===== */
.main { padding: 20px 30px; }

/* ===== WELCOME ===== */
.welcome { margin-bottom: 20px; }
.welcome h1 { font-size: 1.4rem; font-weight: 700; color: var(--dark); }
.welcome p { color: var(--gray); font-size: 0.85rem; margin-top: 4px; }

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 20px;
}

.stat-box {
    background: var(--white);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.3s;
}
.stat-box:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }

.stat-icon {
    width: 50px; height: 50px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
}
.icon-purple { background: rgba(79, 70, 229, 0.12); color: #4f46e5; }
.icon-green { background: rgba(16, 185, 129, 0.12); color: #10b981; }
.icon-orange { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }
.icon-blue { background: rgba(59, 130, 246, 0.12); color: #3b82f6; }

.stat-text h3 { font-size: 1.5rem; font-weight: 800; line-height: 1; }
.stat-text p { font-size: 0.75rem; color: var(--gray); margin-top: 4px; }
.stat-change { display: flex; align-items: center; gap: 4px; font-size: 0.7rem; margin-top: 4px; }
.stat-change.up { color: #10b981; }
.stat-change.pending { color: #f59e0b; }

/* ===== GRID ROWS ===== */
.grid-row { display: grid; gap: 18px; margin-bottom: 18px; }
.row-2col { grid-template-columns: 2fr 1fr; }
.row-3col { grid-template-columns: 1fr 1fr 1fr; }
.row-6040 { grid-template-columns: 3fr 2fr; }

/* ===== PANEL ===== */
.panel {
    background: var(--white);
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    overflow: hidden;
}

.panel-head {
    padding: 15px 20px;
    border-bottom: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.panel-head h3 { font-size: 0.95rem; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.panel-head h3 i { color: var(--primary); }
.panel-head a { font-size: 0.75rem; color: var(--primary); text-decoration: none; }
.panel-head a:hover { text-decoration: underline; }

.panel-body { padding: 15px 20px; }

/* ===== TABLE ===== */
.table-msg { width: 100%; border-collapse: collapse; }
.table-msg thead th {
    padding: 8px 10px;
    text-align: left;
    font-size: 0.7rem; color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px; font-weight: 600;
}
.table-msg tbody td {
    padding: 12px 10px;
    font-size: 0.82rem;
    border-top: 1px solid var(--light-gray);
}
.table-msg tbody tr:hover { background: #f8fafc; }

.order-num { font-weight: 600; color: var(--primary); }
.customer-name { font-weight: 500; }
.price-value { font-weight: 700; color: var(--success); }

.badge-status {
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.68rem; font-weight: 600;
}
.badge-pending { background: #fef3c7; color: #92400e; }
.badge-approved { background: #d1fae5; color: #065f46; }
.badge-rejected { background: #fee2e2; color: #991b1b; }
.date-text { color: var(--gray); font-size: 0.75rem; }

/* ===== NOTIFICATIONS ===== */
.notif-list { list-style: none; }
.notif-item {
    padding: 12px 0;
    border-bottom: 1px solid var(--light-gray);
    display: flex; gap: 12px; align-items: flex-start;
}
.notif-item:last-child { border-bottom: none; }
.notif-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 0.85rem;
}
.notif-icon.order { background: #e0e7ff; color: #4338ca; }
.notif-icon.alert { background: #fee2e2; color: #dc2626; }
.notif-icon.success { background: #d1fae5; color: #059669; }
.notif-content strong { font-size: 0.82rem; display: block; margin-bottom: 2px; }
.notif-content span { font-size: 0.72rem; color: var(--gray); }
.notif-time { font-size: 0.68rem; color: var(--gray); white-space: nowrap; }

/* ===== CHARTS ===== */
.chart-container { position: relative; height: 220px; }

/* ===== SALES STATS ===== */
.sales-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
.sale-item {
    background: var(--bg); border-radius: 10px;
    padding: 15px; text-align: center;
}
.sale-item i { font-size: 1.3rem; margin-bottom: 6px; }
.sale-item h4 { font-size: 0.72rem; color: var(--gray); margin-bottom: 4px; }
.sale-item h3 { font-size: 1.1rem; font-weight: 700; }

/* ===== LOW STOCK ===== */
.stock-item {
    display: flex; justify-content: space-between;
    align-items: center;
    padding: 10px 0; border-bottom: 1px solid var(--light-gray);
}
.stock-item:last-child { border-bottom: none; }
.stock-item img {
    width: 38px; height: 38px;
    border-radius: 8px; object-fit: cover;
}
.stock-name { font-weight: 500; font-size: 0.82rem; }
.stock-sku { font-size: 0.7rem; color: var(--gray); }
.stock-count {
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.7rem; font-weight: 600;
}
.stock-low { background: #fee2e2; color: #dc2626; }

/* ===== SYSTEM STATUS ===== */
.sys-item {
    display: flex; justify-content: space-between;
    padding: 10px; background: #f8fafc;
    border-radius: 8px; margin-bottom: 10px;
}
.sys-item:last-child { margin-bottom: 0; }
.sys-item span:first-child { font-size: 0.82rem; display: flex; align-items: center; gap: 6px; }
.sys-item .status { font-weight: 600; font-size: 0.75rem; }
.status-ok { color: #10b981; }
.status-warn { color: #f59e0b; }
.status-err { color: #ef4444; }

/* ===== PROGRESS BARS ===== */
.progress-item { margin-bottom: 12px; }
.progress-item:last-child { margin-bottom: 0; }
.progress-label { display: flex; justify-content: space-between; font-size: 0.78rem; margin-bottom: 6px; }
.progress-bar-wrap {
    width: 100%; height: 10px;
    background: #e2e8f0; border-radius: 5px; overflow: hidden;
}
.progress-fill {
    height: 100%; border-radius: 5px;
    transition: width 0.5s ease; width: 0%;
}
.fill-purple { background: linear-gradient(90deg, #4f46e5, #7c3aed); }
.fill-green { background: linear-gradient(90deg, #10b981, #059669); }
.fill-orange { background: linear-gradient(90deg, #f59e0b, #d97706); }
.fill-blue { background: linear-gradient(90deg, #3b82f6, #2563eb); }

/* ===== ACTIVITY LOG ===== */
.activity-item {
    display: flex; gap: 12px;
    padding: 10px 0; border-bottom: 1px solid var(--light-gray);
}
.activity-item:last-child { border-bottom: none; }
.activity-dot {
    width: 10px; height: 10px; border-radius: 50%;
    margin-top: 5px; flex-shrink: 0;
}
.dot-green { background: #10b981; }
.dot-blue { background: #3b82f6; }
.dot-orange { background: #f59e0b; }
.dot-red { background: #ef4444; }
.activity-text { font-size: 0.82rem; }
.activity-time { font-size: 0.7rem; color: var(--gray); margin-top: 2px; }

/* ===== QUICK ACTIONS ===== */
.actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
.action-btn {
    padding: 12px; border-radius: 10px;
    background: var(--bg); border: 1px solid var(--light-gray);
    cursor: pointer; text-align: center;
    transition: all 0.3s;
    text-decoration: none; display: flex;
    flex-direction: column; align-items: center; gap: 6px;
    color: var(--dark);
}
.action-btn:hover { background: var(--primary); color: white; border-color: var(--primary); }
.action-btn i { font-size: 1.2rem; }
.action-btn span { font-size: 0.72rem; font-weight: 500; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1100px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .row-2col { grid-template-columns: 1fr; }
    .row-6040 { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .stats-grid { grid-template-columns: 1fr; }
    .row-3col { grid-template-columns: 1fr; }
    .sales-grid { grid-template-columns: 1fr; }
    .topbar { padding: 12px 15px; }
    .main { padding: 15px; }
}
</style>

@section('content')
<!-- TOPBAR -->
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="My Shop">
        <h2>My Shop Admin</h2>
    </div>

    <div class="topbar-actions">
        <!-- Notification Bell -->
        <div class="notif-wrap">
            <button class="notif-btn" id="notifBell" title="Notifications">
                <i class="fa-solid fa-bell"></i>
                @if(($notificationsCount ?? 0) > 0)
                    <span class="dot" id="notifDot">{{ $notificationsCount }}</span>
                @endif
            </button>

            <!-- Overlay for closing -->
            <div class="notif-overlay" id="notifOverlay"></div>

            <!-- Dropdown -->
            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-drop-head">
                    <h4>Notifications</h4>
                    <div class="drop-actions">
                        <button id="markAllRead">Mark all read</button>
                    </div>
                </div>
                <div class="notif-drop-body" id="notifList">
                    <div class="notif-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        No notifications yet
                    </div>
                </div>
            </div>
        </div>

      <div class="admin-profile">
    <img src="{{ Auth::guard('admin')->user()?->avatar ? asset('img/' . Auth::guard('admin')->user()->avatar) : asset('img/33.jpg') }}" alt="Admin">
    <span>{{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</span>
</div>
    </div>
</div>

<!-- Notification JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bell = document.getElementById('notifBell');
    const dropdown = document.getElementById('notifDropdown');
    const overlay = document.getElementById('notifOverlay');
    const list = document.getElementById('notifList');
    const dot = document.getElementById('notifDot');
    const markAllBtn = document.getElementById('markAllRead');

    function loadNotifs() {
        fetch('{{ route("admin.notifications") }}')
            .then(r => r.json())
            .then(data => {
                if (data.count > 0) {
                    if (dot) dot.textContent = data.count > 99 ? '99+' : data.count;
                    else {
                        const newDot = document.createElement('span');
                        newDot.className = 'dot';
                        newDot.id = 'notifDot';
                        newDot.textContent = data.count;
                        bell.appendChild(newDot);
                    }
                } else {
                    if (dot) dot.remove();
                }

                if (data.notifications.length === 0) {
                    list.innerHTML = `<div class="notif-empty"><i class="fa-regular fa-bell-slash"></i>No notifications yet</div>`;
                    return;
                }

                list.innerHTML = data.notifications.map(n => `
                    <div class="notif-item" onclick="window.location.href='${n.link || "#"}'">
                        <div class="notif-icon" style="background:${n.icon_color}20;color:${n.icon_color}">
                            <i class="${n.icon}"></i>
                        </div>
                        <div class="notif-body">
                            <strong>${n.message}</strong>
                            <small>${n.type}</small>
                        </div>
                        <span class="notif-time">${n.created_at}</span>
                        <button class="notif-del" onclick="event.stopPropagation();delNotif('${n.id}')" title="Delete">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                `).join('');
            })
            .catch(() => {});
    }

    bell.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('open');
        overlay.classList.toggle('open');
        if (dropdown.classList.contains('open')) loadNotifs();
    });

    overlay.addEventListener('click', () => {
        dropdown.classList.remove('open');
        overlay.classList.remove('open');
    });

    markAllBtn.addEventListener('click', () => {
        fetch('{{ route("admin.notifications.read-all") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(() => { loadNotifs(); });
    });

    window.delNotif = function(id) {
        fetch(`/admin/notifications/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(() => loadNotifs());
    };

    loadNotifs();
});
</script>

<!-- MAIN -->
<div class="main">
    <div class="welcome">
        <h1>Dashboard Overview</h1>
        <p>Monitor your store performance, orders, customers and revenue in real-time.</p>
    </div>

    <!-- ===== STATS GRID ===== -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon icon-purple">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="stat-text">
                <h3>{{ number_format($productsCount ?? 0) }}</h3>
                <p>Total Products</p>
                <div class="stat-change up"><i class="fa-solid fa-check-circle"></i> In Catalog</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon icon-green">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-text">
                <h3>{{ number_format($customersCount ?? 0) }}</h3>
                <p>Total Customers</p>
                <div class="stat-change up"><i class="fa-solid fa-user-plus"></i> Registered</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon icon-orange">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="stat-text">
                <h3>{{ number_format($ordersCount ?? 0) }}</h3>
                <p>Total Orders</p>
                <div class="stat-change pending"><i class="fa-solid fa-hourglass-half"></i> {{ $ordersPending ?? 0 }} pending</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon icon-blue">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div class="stat-text">
                <h3>{{ number_format($totalRevenue ?? 0) }}</h3>
                <p>Revenue (EGP)</p>
                <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> {{ $ordersApproved ?? 0 }} approved</div>
            </div>
        </div>
    </div>

    <!-- ===== ROW 1: CHART + SALES OVERVIEW ===== -->
    <div class="grid-row row-6040">
        <!-- Revenue Chart -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-chart-line"></i> Revenue & Orders Overview</h3>
                <span style="font-size: 0.75rem; color: var(--gray);">Last 6 Months</span>
            </div>
            <div class="panel-body">
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
                @php
                    $months = $monthlyOrders->pluck('month')->toArray() ?? [];
                    $revenues = $monthlyOrders->pluck('revenue')->toArray() ?? [];
                    $counts = $monthlyOrders->pluck('count')->toArray() ?? [];
                @endphp
                <script>
                    const months = @json($months);
                    const revenues = @json(array_map(fn($v) => (float)($v ?? 0), $revenues));
                    const counts = @json(array_map(fn($v) => (int)($v ?? 0), $counts));

                    const ctx = document.getElementById('revenueChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: months.map(m => {
                                const d = new Date(m + '-01');
                                return d.toLocaleString('en', { month: 'short', year: '2-digit' });
                            }),
                            datasets: [
                                {
                                    label: 'Revenue (EGP)',
                                    data: revenues,
                                    borderColor: '#4f46e5',
                                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y'
                                },
                                {
                                    label: 'Orders',
                                    data: counts,
                                    borderColor: '#f59e0b',
                                    backgroundColor: 'transparent',
                                    borderDash: [5, 5],
                                    tension: 0.4,
                                    yAxisID: 'y1'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: { mode: 'index', intersect: false },
                            plugins: { legend: { position: 'top', labels: { font: { size: 11 }, usePointStyle: true, pointStyle: 'circle' } } },
                            scales: {
                                y: { type: 'linear', position: 'left', grid: { color: '#e2e8f0' }, ticks: { font: { size: 10 } } },
                                y1: { type: 'linear', position: 'right', grid: { drawOnChartArea: false }, ticks: { font: { size: 10 } } }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Sales Overview -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-chart-pie"></i> Sales Overview</h3>
            </div>
            <div class="panel-body">
                <div class="sales-grid">
                    <div class="sale-item">
                        <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                        <h4>Approved</h4>
                        <h3 style="color: #10b981;">{{ $ordersApproved ?? 0 }}</h3>
                    </div>
                    <div class="sale-item">
                        <i class="fa-solid fa-hourglass-half" style="color: #f59e0b;"></i>
                        <h4>Pending</h4>
                        <h3 style="color: #f59e0b;">{{ $ordersPending ?? 0 }}</h3>
                    </div>
                    <div class="sale-item">
                        <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                        <h4>Rejected</h4>
                        <h3 style="color: #ef4444;">{{ max(0, ($ordersCount ?? 0) - ($ordersApproved ?? 0) - ($ordersPending ?? 0)) }}</h3>
                    </div>
                </div>

                <!-- Sales Funnel -->
                <div style="margin-top: 20px;">
                    <h4 style="font-size: 0.8rem; color: var(--gray); margin-bottom: 12px;">Order Funnel</h4>
                    @php
                        $total = $ordersCount ?? 1;
                        $apprPct = round(($ordersApproved ?? 0) / $total * 100);
                        $pendPct = round($ordersPending ?? 0 / $total * 100);
                        $rejcPct = 100 - $apprPct - $pendPct;
                    @endphp
                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fa-solid fa-check-circle me-1" style="color:#10b981;"></i> Approved</span>
                            <span>{{ $apprPct }}%</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-fill fill-green" style="width: {{ $apprPct }}%;"></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fa-solid fa-hourglass-half me-1" style="color:#f59e0b;"></i> Pending</span>
                            <span>{{ $pendPct }}%</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-fill fill-orange" style="width: {{ $pendPct }}%;"></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fa-solid fa-times-circle me-1" style="color:#ef4444;"></i> Rejected</span>
                            <span>{{ max(0, $rejcPct) }}%</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-fill fill-purple" style="width: {{ max(0, $rejcPct) }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ROW 2: RECENT ORDERS + NOTIFICATIONS ===== -->
    <div class="grid-row row-2col">
        <!-- Recent Orders -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}">View All <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="panel-body" style="padding: 0;">
                <table class="table-msg">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td><span class="order-num">{{ $order->order_number }}</span></td>
                                <td><span class="customer-name">{{ $order->customer->name ?? 'Guest' }}</span></td>
                                <td>{{ $order->items->count() }}</td>
                                <td><span class="price-value">{{ number_format($order->total_price, 0) }} EGP</span></td>
                                <td>
                                    <span class="badge-status badge-{{ $order->status }}">
                                        @switch($order->status)
                                            @case('pending') Pending @break
                                            @case('approved') Approved @break
                                            @case('rejected') Rejected @break
                                            @default {{ ucfirst($order->status) }}
                                        @endswitch
                                    </span>
                                </td>
                                <td><span class="date-text">{{ $order->created_at->format('d/m/Y') }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No orders yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notifications -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-bell"></i> Notifications</h3>
                @if($notifications->count() > 0)
                    <span class="badge-status badge-pending">{{ $notifications->count() }} new</span>
                @endif
            </div>
            <div class="panel-body" style="padding: 12px 20px;">
                @if($notifications->isEmpty())
                    <p class="text-center text-muted py-4">No new notifications</p>
                @else
                    <ul class="notif-list">
                        @foreach($notifications as $notif)
                            <li class="notif-item">
                                <div class="notif-icon order">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <div class="notif-content">
                                    <strong>{{ $notif->data['message'] ?? 'New Notification' }}</strong>
                                    <span>{{ class_basename($notif->type) }}</span>
                                </div>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== ROW 3: QUICK ACTIONS + LOW STOCK + SYSTEM STATUS ===== -->
    <div class="grid-row" style="grid-template-columns: repeat(3, 1fr);">
        <!-- Quick Actions -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-bolt"></i> Quick Actions</h3>
            </div>
            <div class="panel-body">
                <div class="actions-grid">
                    <a href="{{ route('products.create') }}" class="action-btn">
                        <i class="fa-solid fa-plus"></i>
                        <span>Add Product</span>
                    </a>
                    <a href="{{ route('admin.employees.create') }}" class="action-btn">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Add Employee</span>
                    </a>
                    <a href="{{ route('videos.create') }}" class="action-btn">
                        <i class="fa-solid fa-video"></i>
                        <span>Add Video</span>
                    </a>
                    <a href="{{ url('/') }}" class="action-btn" target="_blank">
                        <i class="fa-solid fa-globe"></i>
                        <span>Visit Store</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-triangle-exclamation"></i> Low Stock</h3>
                <span style="font-size: 0.75rem; color: #ef4444;">{{ $lowStockProducts->count() }} items</span>
            </div>
            <div class="panel-body" style="padding: 12px 20px;">
                @if($lowStockProducts->isEmpty())
                    <p class="text-center text-muted py-3" style="font-size: 0.82rem;">All products well stocked</p>
                @else
                    @foreach($lowStockProducts->take(5) as $product)
                        <div class="stock-item">
                            @php
                                $img = $product->img ? (is_array(json_decode($product->img)) ? json_decode($product->img)[0] : $product->img) : null;
                                $imgSrc = $img && file_exists(public_path('img/' . $img)) ? asset('img/' . $img) : 'https://via.placeholder.com/40';
                            @endphp
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ $imgSrc }}" alt="">
                                <div>
                                    <div class="stock-name">{{ $product->name }}</div>
                                    <div class="stock-sku">{{ $product->sku ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <span class="stock-count stock-low">{{ $product->stock }} left</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- System Status -->
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-server"></i> System Status</h3>
            </div>
            <div class="panel-body">
                <div class="sys-item">
                    <span><i class="fa-solid fa-database"></i> Database</span>
                    <span class="status status-ok">Connected</span>
                </div>
                <div class="sys-item">
                    <span><i class="fa-solid fa-storage"></i> Storage</span>
                    <span class="status status-ok">Available</span>
                </div>
                <div class="sys-item">
                    <span><i class="fa-solid fa-shield-halved"></i> Security</span>
                    <span class="status status-ok">Active</span>
                </div>
                <div class="sys-item">
                    <span><i class="fa-solid fa-clock"></i> Last Sync</span>
                    <span class="status" style="color: var(--gray);">{{ now()->format('H:i:s') }}</span>
                </div>
                <div class="sys-item">
                    <span><i class="fa-solid fa-users"></i> Online Users</span>
                    <span class="status status-warn">1</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ROW 4: RECENT ACTIVITY ===== -->
    <div class="grid-row" style="grid-template-columns: 1fr;">
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fa-solid fa-right-long"></i> Recent Activity</h3>
            </div>
            <div class="panel-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    @forelse($recentOrders->take(6) as $order)
                        <div class="activity-item">
                            <div class="activity-dot {{ $order->status === 'approved' ? 'dot-green' : ($order->status === 'pending' ? 'dot-orange' : 'dot-red') }}"></div>
                            <div>
                                <div class="activity-text">
                                    <strong>{{ $order->customer->name ?? 'Guest' }}</strong> placed order
                                    <strong>{{ $order->order_number }}</strong>
                                    <span style="color: var(--success);">{{ number_format($order->total_price, 0) }} EGP</span>
                                </div>
                                <div class="activity-time">{{ $order->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">No recent activity</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
