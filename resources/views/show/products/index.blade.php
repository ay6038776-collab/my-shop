
@extends('show.layouts.app')

@section('title', 'All Products')

@section('content')

<style>
/* ===== PRODUCTS PAGE HEADER ===== */
.products-page-header {
    padding: 30px 0 20px;
    margin-bottom: 10px;
}

.products-page-header .breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 0.85rem;
    color: #9ca3af;
}

.products-page-header .breadcrumb a {
    color: #6b7280;
    text-decoration: none;
}

.products-page-header .breadcrumb a:hover {
    color: #374151;
}

.products-page-header .breadcrumb i {
    font-size: 0.75rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.page-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 20px;
}

.quick-links {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
}

.quick-link:hover {
    color: #764ba2;
}

.quick-link i {
    font-size: 1rem;
}

.quick-link .count {
    background: #f3f4f6;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    color: #6b7280;
}

/* Filter Bar */
.filter-bar {
    background: white;
    border-radius: 16px;
    padding: 20px 28px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.filter-results {
    display: flex;
    align-items: center;
    gap: 12px;
}

.results-count {
    font-size: 0.95rem;
    color: #4a5568;
}

.results-count strong {
    color: #667eea;
    font-weight: 700;
}

/* Price Filter */
.price-filter {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.price-filter input {
    width: 100px;
    padding: 8px 12px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.85rem;
    color: #4a5568;
    transition: all 0.3s ease;
}

.price-filter input:focus {
    outline: none;
    border-color: #667eea;
}

.price-filter span {
    color: #a0aec0;
    font-size: 0.85rem;
}

.filter-btn {
    padding: 8px 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
}

.clear-filter-btn {
    padding: 8px 16px;
    background: #fee2e2;
    border: none;
    border-radius: 8px;
    color: #dc2626;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
}

.clear-filter-btn:hover {
    background: #fecaca;
}

/* Sort Dropdown */
.sort-dropdown {
    position: relative;
}

.sort-select {
    padding: 10px 40px 10px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.9rem;
    color: #4a5568;
    background: white;
    cursor: pointer;
    appearance: none;
    transition: all 0.3s ease;
}

.sort-select:focus {
    outline: none;
    border-color: #667eea;
}

.sort-dropdown::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    font-size: 0.75rem;
    color: #a0aec0;
}

.view-toggle {
    display: flex;
    gap: 8px;
}

.view-btn {
    width: 42px;
    height: 42px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #a0aec0;
}

.view-btn:hover,
.view-btn.active {
    border-color: #667eea;
    background: #667eea;
    color: white;
}

/* Container padding override */
.products-main {
    padding-bottom: 80px;
}
</style>



<div class="container" style="padding-top: 20px;">

    {{-- Page Header --}}
    <div class="products-page-header">
       

        <h1 class="page-title">Our Collection</h1>
        <p class="page-subtitle">Handpicked products just for you</p>

        <div class="quick-links">
            <a href="{{ route('home') }}" class="quick-link">
                <i class="bi bi-house-heart"></i>
                Home
            </a>
            <a href="#" class="quick-link">
                <i class="bi bi-tags"></i>
                Offers
                <span class="count">New</span>
            </a>
            <a href="#" class="quick-link">
                <i class="bi bi-lightning"></i>
                Best Sellers
            </a>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar">
        <div class="filter-results">
            <span class="results-count">Showing <strong>{{ $products->total() }}</strong> products</span>
            @if(request()->filled('price_min') || request()->filled('price_max') || request()->filled('search'))
                <a href="{{ route('show.products.index') }}" class="clear-filter-btn">
                    <i class="bi bi-x-circle me-1"></i> Clear Filters
                </a>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 flex-wrap">
            

            {{-- Price Filter --}}
            <form id="price-filter-form" class="price-filter">
                <input type="number" name="price_min" id="price_min" placeholder="Min" value="{{ request('price_min') }}" min="0">
                <span>-</span>
                <input type="number" name="price_max" id="price_max" placeholder="Max" value="{{ request('price_max') }}" min="0">
                <button type="submit" class="filter-btn">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </form>

            <div class="sort-dropdown">
                <select class="sort-select" id="sort-select" onchange="applySort(this.value)">
                    <option value="" {{ !request('sort') ? 'selected' : '' }}>Sort by: Featured</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                </select>
            </div>

            <div class="view-toggle">
                <button class="view-btn active" title="Grid View">
                    <i class="bi bi-grid-fill"></i>
                </button>
                <button class="view-btn" title="List View">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Products Container --}}
    <div id="products-container">
        @include('show.products.partials.products', ['products' => $products])
    </div>

    <div>
        @include('show.products.list')
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    const productsContainer = document.getElementById('products-container');
    const priceFilterForm = document.getElementById('price-filter-form');
    let timeout = null;

    // Function to build URL with filters
    function buildFilterUrl() {
        const params = new URLSearchParams(window.location.search);

        // Update search
        if (searchInput && searchInput.value) {
            params.set('search', searchInput.value);
        } else {
            params.delete('search');
        }

        // Update price filters
        const priceMin = document.getElementById('price_min')?.value;
        const priceMax = document.getElementById('price_max')?.value;

        if (priceMin) {
            params.set('price_min', priceMin);
        } else {
            params.delete('price_min');
        }

        if (priceMax) {
            params.set('price_max', priceMax);
        } else {
            params.delete('price_max');
        }

        return `/products/search?${params.toString()}`;
    }

    // Search with filters
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            const query = this.value;

            timeout = setTimeout(() => {
                fetch(buildFilterUrl())
                    .then(response => response.json())
                    .then(data => {
                        productsContainer.innerHTML = data.html;
                    })
                    .catch(err => console.error(err));
            }, 300);
        });
    }

    // Price filter form submit
    if (priceFilterForm) {
        priceFilterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const priceMin = document.getElementById('price_min').value;
            const priceMax = document.getElementById('price_max').value;
            const search = searchInput ? searchInput.value : '';
            const params = new URLSearchParams();

            if (priceMin) params.set('price_min', priceMin);
            if (priceMax) params.set('price_max', priceMax);
            if (search) params.set('search', search);

            fetch(`/products/search?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    productsContainer.innerHTML = data.html;
                    // Update URL without reload
                    const newUrl = `${window.location.pathname}?${params.toString()}`;
                    window.history.pushState({}, '', newUrl);
                })
                .catch(err => console.error(err));
        });
    }

    // Sort select change
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            applySort(this.value);
        });
    }

    // View toggle buttons
    const viewBtns = document.querySelectorAll('.view-btn');
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

// Apply sort filter
function applySort(sortValue) {
    const productsContainer = document.getElementById('products-container');
    const searchInput = document.querySelector('.search-input');
    const priceMin = document.getElementById('price_min')?.value;
    const priceMax = document.getElementById('price_max')?.value;

    const params = new URLSearchParams();

    if (searchInput && searchInput.value) {
        params.set('search', searchInput.value);
    }
    if (priceMin) params.set('price_min', priceMin);
    if (priceMax) params.set('price_max', priceMax);
    if (sortValue) params.set('sort', sortValue);

    fetch(`/products/search?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            productsContainer.innerHTML = data.html;
            // Update URL
            const newUrl = `${window.location.pathname}?${params.toString()}`;
            window.history.pushState({}, '', newUrl);
        })
        .catch(err => console.error(err));
}
</script>

@endsection
