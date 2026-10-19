@extends('layouts.app')
@section('title', 'Products - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - My Shop</title>
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

/* TOPBAR */
.topbar {
    background: var(--white);
    padding: 14px 28px;
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
.brand h2 { font-size: 1.15rem; font-weight: 700; color: var(--primary); }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.back-btn {
    padding: 8px 16px; border-radius: 8px; background: var(--bg);
    border: 1px solid var(--light-gray); color: var(--dark); text-decoration: none;
    font-size: 0.82rem; transition: all 0.3s;
}
.back-btn:hover { background: var(--primary); color: white; border-color: var(--primary); }

/* MAIN */
.main { 
    padding: 24px 28px;
    max-width: 1800px;
    margin: 0 auto;
}

/* Large screens adjustments */
@media (min-width: 1600px) {
    .main {
        max-width: 1700px;
        padding: 32px 48px;
    }
    .stats-bar {
        gap: 24px;
    }
    .stat-mini {
        min-width: 200px;
        padding: 20px 28px;
    }
}

/* PAGE HEADER */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.page-header h1 { font-size: 1.35rem; font-weight: 700; color: var(--dark); }
.page-header p { color: var(--gray); font-size: 0.82rem; margin-top: 2px; }

/* STATS BAR */
.stats-bar {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}
.stat-mini {
    background: var(--white);
    border-radius: 12px;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    min-width: 160px;
}
.stat-mini i { font-size: 1.2rem; }
.stat-mini.green i { color: var(--success); }
.stat-mini.orange i { color: var(--warning); }
.stat-mini.blue i { color: var(--primary); }
.stat-mini h3 { font-size: 1.3rem; font-weight: 700; line-height: 1; }
.stat-mini p { font-size: 0.72rem; color: var(--gray); margin-top: 2px; }

/* TOOLBAR */
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 12px;
}
.search-wrap {
    position: relative;
    flex: 1;
    max-width: 380px;
}
.search-wrap input {
    width: 100%;
    padding: 10px 14px 10px 40px;
    border: 1px solid var(--light-gray);
    border-radius: 10px;
    font-size: 0.85rem;
    font-family: 'Poppins';
    background: var(--white);
    transition: all 0.3s;
}
.search-wrap input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
.search-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    font-size: 0.85rem;
}
.toolbar-actions { display: flex; gap: 8px; }

/* BUTTONS */
.btn {
    padding: 9px 18px; border-radius: 8px; font-size: 0.82rem;
    font-weight: 500; cursor: pointer; transition: all 0.3s;
    border: none; display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Poppins';
}
.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover { background: #3730a3; }
.btn-success { background: var(--success); color: white; }
.btn-success:hover { background: #059669; }
.btn-danger { background: var(--danger); color: white; }
.btn-danger:hover { background: #dc2626; }
.btn-outline { background: transparent; border: 1px solid var(--light-gray); color: var(--dark); }
.btn-outline:hover { background: var(--bg); }
.btn-sm { padding: 6px 12px; font-size: 0.75rem; }

/* PANEL */
.panel {
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    overflow: hidden;
    width: 100%;
}
.panel-head {
    padding: 16px 20px;
    border-bottom: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.panel-head h3 { font-size: 0.92rem; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.panel-head h3 i { color: var(--primary); }

/* TABLE */
.table-wrap { 
    width: 100%; 
    border-collapse: collapse; 
    max-width: 100%;
}

/* Ensure table is properly sized on all screens */
.panel {
    width: 100%;
    max-width: 100%;
}

/* Desktop/TV screens - table fills width */
@media (min-width: 1200px) {
    .table-wrap {
        display: table !important;
        width: 100%;
    }
    .table-wrap thead { display: table-header-group; }
    .table-wrap tbody { display: table-row-group; }
    .table-wrap tr { display: table-row; }
    .table-wrap td, .table-wrap th { display: table-cell; }
    .table-wrap table {
        width: 100%;
        table-layout: auto;
    }
}

/* Force table to be responsive at ALL sizes */
.table-wrap table {
    width: 100%;
    table-layout: auto;
}

/* Column widths - flexible */
.table-wrap thead th { padding: 12px 16px; }
.table-wrap thead th {
    text-align: left;
    font-size: 0.7rem;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    background: var(--bg);
    white-space: nowrap;
}
.table-wrap tbody td {
    padding: 14px 16px;
    font-size: 0.85rem;
    border-top: 1px solid var(--light-gray);
    vertical-align: middle;
    word-wrap: break-word;
}
.table-wrap tbody tr:hover { background: #f8fafc; }
.table-wrap tbody tr.selected { background: rgba(79,70,229,0.05); }

/* PRODUCT ROW */
.product-info { display: flex; align-items: center; gap: 12px; }
.product-img {
    width: 52px; height: 52px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid var(--light-gray);
    flex-shrink: 0;
}
.product-name { font-weight: 600; font-size: 0.88rem; }
.product-desc { font-size: 0.72rem; color: var(--gray); margin-top: 2px; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
td[data-label="SKU"] { font-family: monospace; font-size: 0.8rem; color: var(--gray); }
.sku-val { font-family: monospace; }

/* BADGES */
.badge {
    display: inline-flex; align-items: center;
    padding: 4px 10px; border-radius: 20px;
    font-size: 0.68rem; font-weight: 600;
}
.badge-success { background: #d1fae5; color: #065f46; }
.badge-warning { background: #fef3c7; color: #92400e; }
.badge-danger { background: #fee2e2; color: #991b1b; }
.badge-primary { background: #e0e7ff; color: #4338ca; }
.badge-new { background: var(--primary); color: white; }

/* PRICE */
.price { font-weight: 700; font-size: 0.92rem; color: var(--dark); }
.price-old { font-size: 0.75rem; color: var(--gray); text-decoration: line-through; }
.price-new { color: var(--success); }

/* CHECKBOX */
input[type="checkbox"] {
    width: 18px; height: 18px;
    accent-color: var(--primary);
    cursor: pointer;
    border-radius: 4px;
}

/* ACTION BUTTONS */
.action-btns { display: flex; gap: 6px; }
.icon-btn {
    padding: 7px 10px; border-radius: 8px;
    border: none; cursor: pointer;
    font-size: 0.8rem; transition: all 0.3s;
}
.icon-btn.edit { background: #e0e7ff; color: #4338ca; }
.icon-btn.edit:hover { background: #4338ca; color: white; }
.icon-btn.delete { background: #fee2e2; color: #dc2626; }
.icon-btn.delete:hover { background: #dc2626; color: white; }
.icon-btn.view { background: #d1fae5; color: #059669; }
.icon-btn.view:hover { background: #059669; color: white; }

/* PAGINATION */
.pagination-wrap {
    padding: 16px 20px;
    border-top: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.pagination-info { font-size: 0.78rem; color: var(--gray); }

/* ALERT */
.alert {
    padding: 12px 16px; border-radius: 10px;
    font-size: 0.85rem; margin-bottom: 18px;
    display: flex; align-items: center; gap: 10px;
}
.alert-success { background: #d1fae5; color: #065f46; }
.alert-danger { background: #fee2e2; color: #991b1b; }

/* EMPTY STATE */
.empty-state {
    text-align: center; padding: 60px 20px;
}
.empty-state i { font-size: 3rem; color: var(--light-gray); margin-bottom: 12px; }
.empty-state h3 { font-size: 1.1rem; color: var(--dark); margin-bottom: 6px; }
.empty-state p { color: var(--gray); font-size: 0.85rem; }

/* RESPONSIVE */
@media (max-width: 900px) {
    .stats-bar { flex-wrap: wrap; }
    .toolbar { flex-direction: column; align-items: stretch; }
    .search-wrap { max-width: 100%; }
    .topbar { padding: 12px 16px; }
    .main { padding: 16px; }
    .page-header { flex-direction: column; gap: 12px; align-items: flex-start; }
}

/* TABLE RESPONSIVE - Cards on tablets and below (≤1024px) */
@media (max-width: 1024px) {
    .table-wrap {
        display: block !important;
        overflow: visible !important;
        width: 100%;
    }
    .table-wrap thead { display: none; }
    .table-wrap tbody { 
        display: flex !important; 
        flex-direction: column;
        gap: 12px;
        padding: 12px;
    }
    .table-wrap tbody tr {
        display: flex !important;
        flex-direction: column;
        background: var(--white);
        border-radius: 12px;
        padding: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        border: 1px solid var(--light-gray);
        position: relative;
    }
    .table-wrap tbody tr:hover {
        background: var(--white);
        box-shadow: 0 4px 12px rgba(79,70,229,0.12);
        border-color: var(--primary-light);
    }
    .table-wrap tbody td {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border: none !important;
        font-size: 0.85rem;
    }
    .table-wrap tbody td::before {
        content: attr(data-label);
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    /* Product cell - stacked */
    .table-wrap tbody td:nth-child(2) {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 8px;
    }
    .product-info { flex-direction: row; width: 100%; }
    .product-desc { max-width: 100%; white-space: normal; }
    /* Actions */
    .action-btns {
        width: 100%;
        justify-content: flex-end;
        padding-top: 8px;
        border-top: 1px dashed var(--light-gray);
        margin-top: 4px;
    }
    /* Checkbox */
    .table-wrap tbody td:first-child input[type="checkbox"] { width: 24px; height: 24px; }
    .table-wrap tbody td:first-child::before { display: none; }
    /* SKU badge */
    .sku-val { font-family: monospace; background: var(--bg); padding: 3px 8px; border-radius: 4px; font-size: 0.78rem; }
}

/* Large screens - 1920x1080 and similar */
@media (min-width: 1400px) {
    .panel {
        border-radius: 16px;
    }
    .table-wrap tbody td {
        padding: 16px 20px;
        font-size: 0.9rem;
    }
    .table-wrap thead th {
        padding: 14px 20px;
        font-size: 0.75rem;
    }
    .product-img {
        width: 60px;
        height: 60px;
    }
    .product-name { font-size: 0.95rem; }
    .product-desc { font-size: 0.78rem; max-width: 250px; }
}

/* Desktop - 1920x1080 */
@media (min-width: 1200px) and (max-width: 1399px) {
    .panel {
        border-radius: 14px;
    }
    .main {
        padding: 28px 32px;
    }
    .page-header h1 {
        font-size: 1.4rem;
    }
    .stat-mini {
        padding: 18px 28px;
    }
    .stat-mini h3 {
        font-size: 1.4rem;
    }
}

/* Laptop screens - 1366x768 */
@media (min-width: 992px) and (max-width: 1199px) {
    .main {
        padding: 24px 28px;
    }
    .table-wrap tbody td {
        padding: 12px 14px;
    }
    .product-desc {
        max-width: 180px;
    }
}

/* Portrait phones - 1080x1920 */
@media (max-width: 576px) {
    .stats-bar {
        flex-direction: column;
    }
    .stat-mini {
        width: 100%;
    }
    .toolbar-actions {
        width: 100%;
        flex-direction: column;
    }
    .toolbar-actions .btn {
        width: 100%;
    }
}

.table-wrap{
    width:100%;
    overflow-x:auto;
}

.table-wrap table{
    width:100%;
    min-width:1200px; /* أو 1200 حسب عدد الأعمدة */
    border-collapse:collapse;
}

.main{
    width:100%;
    max-width:none;
}

.panel{
   overflow-x:auto;
}

.table-wrap{
    width:100%;
    overflow-x:auto;
}
.table-wrap table{
    width:100%;
    min-width:1200px; /* أو 1200 حسب عدد الأعمدة */
    border-collapse:collapse;
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
    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1>Products</h1>
            <p>Manage your product catalog, inventory, and pricing</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Product
        </a>
    </div>

    <!-- ALERTS -->
    @if(session('success'))<div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</div>@endif

    <!-- STATS BAR -->
    <div class="stats-bar">
        <div class="stat-mini green">
            <i class="fa-solid fa-cube"></i>
            <div>
                <h3>{{ $products->count() }}</h3>
                <p>Total Products</p>
            </div>
        </div>
        <div class="stat-mini orange">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <h3>{{ $products->where('stock', '<', 5)->count() }}</h3>
                <p>Low Stock</p>
            </div>
        </div>
        <div class="stat-mini blue">
            <i class="fa-solid fa-tag"></i>
            <div>
                <h3>{{ $products->where('discount_percentage', '>', 0)->count() }}</h3>
                <p>On Discount</p>
            </div>
        </div>
    </div>

    <!-- TOOLBAR -->
    <div class="toolbar">
        <div class="search-wrap">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search products by name, SKU, or description...">
        </div>
        <div class="toolbar-actions">
            <form id="bulkDelete" action="{{ route('bulkDelete') }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <input type="hidden" id="selectedIds" name="ids">
                <button type="submit" class="btn btn-danger btn-sm" id="bulkDeleteBtn" disabled>
                    <i class="fa-solid fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
                </button>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="panel">
        <div class="panel-head">
            <h3><i class="fa-solid fa-list"></i> All Products</h3>
            <label style="display:flex;align-items:center;gap:6px;font-size:0.78rem;color:var(--gray);cursor:pointer;">
                <input type="checkbox" id="selectAll"> Select All
            </label>
        </div>

        @if($products->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                <h3>No Products Yet</h3>
                <p>Start by adding your first product to the catalog</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary" style="margin-top:16px;">
                    <i class="fa-solid fa-plus"></i> Add First Product
                </a>
            </div>
        @else
            <table class="table-wrap">
                <thead>
                    <tr>
                        <th style="width:40px;"><input type="checkbox" id="selectAllTop"></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>SKU</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTable">
                    @foreach($products as $product)
                        <tr data-id="{{ $product->id }}">
                            <td data-label=""><input type="checkbox" class="row-check" value="{{ $product->id }}"></td>
                            <td data-label="Product">
                                <div class="product-info">
                                    @php
                                        $img = null;
                                        if($product->img){
                                            $decoded = is_array(json_decode($product->img)) ? json_decode($product->img) : [$product->img];
                                            $img = $decoded[0] ?? null;
                                        }
                                        $imgSrc = $img && file_exists(public_path('img/' . $img)) ? asset('img/' . $img) : 'https://via.placeholder.com/60?text=No+Image';
                                    @endphp
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="product-img">
                                    <div>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-desc">{{ Str::limit($product->description, 40) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Price">
                                @if($product->discount_percentage > 0)
                                    <div class="price-old">{{ number_format($product->price, 0) }} EGP</div>
                                    <div class="price price-new">{{ number_format($product->discounted_price, 0) }} EGP</div>
                                @else
                                    <div class="price">{{ number_format($product->price, 0) }} EGP</div>
                                @endif
                            </td>
                            <td data-label="Stock">
                                @if($product->stock <= 0)
                                    <span class="badge badge-danger">Out of Stock</span>
                                @elseif($product->stock < 5)
                                    <span class="badge badge-warning">{{ $product->stock }} left</span>
                                @else
                                    <span class="badge badge-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td data-label="SKU"><span class="sku-val">{{ $product->sku ?? 'N/A' }}</span></td>
                            <td data-label="Discount">
                                @if($product->discount_percentage > 0)
                                    <span class="badge badge-primary">-{{ $product->discount_percentage }}%</span>
                                @else
                                    <span style="color:var(--gray);font-size:0.8rem;">—</span>
                                @endif
                            </td>
                            <td data-label="Status">
                                @if($product->is_new)
                                    <span class="badge badge-new"><i class="fa-solid fa-sparkles me-1"></i> New</span>
                                @else
                                    <span style="color:var(--gray);font-size:0.8rem;">Regular</span>
                                @endif
                            </td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <a href="{{ route('products.edit', $product->id) }}" class="icon-btn edit" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;" onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn delete" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrap">
                <span class="pagination-info">Showing {{ $products->count() }} products</span>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Search
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#productsTable tr');
    searchInput.addEventListener('keyup', function () {
        const term = this.value.toLowerCase();
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });

    // Select All
    function setupSelectAll(source) {
        document.querySelectorAll('.row-check').forEach(cb => cb.checked = source.checked);
        updateBulkCount();
    }
    document.getElementById('selectAll').addEventListener('change', function() { setupSelectAll(this); });
    document.getElementById('selectAllTop').addEventListener('change', function() { setupSelectAll(this); });

    // Row selection
    function updateBulkCount() {
        const checked = document.querySelectorAll('.row-check:checked').length;
        document.getElementById('selectedCount').textContent = checked;
        document.getElementById('bulkDeleteBtn').disabled = checked === 0;
    }
    document.querySelectorAll('.row-check').forEach(cb => cb.addEventListener('change', updateBulkCount));

    // Bulk delete
    document.getElementById('bulkDelete').addEventListener('submit', function(e) {
        e.preventDefault();
        const selected = Array.from(document.querySelectorAll('.row-check:checked')).map(cb => cb.value);
        if (selected.length === 0) return alert('Select products first.');
        if (!confirm('Delete ' + selected.length + ' product(s)?')) return;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ids: selected, _method: 'DELETE' })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Products deleted!');
                location.reload();
            } else {
                alert(data.message || 'Error deleting products.');
            }
        })
        .catch(() => alert('Something went wrong.'));
    });
});
</script>

@endsection
