@if($products->count() > 0)
    <style>
        /* ===== MODERN PRODUCTS GRID ===== */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 300px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-wrapper img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image-wrapper img {
            transform: scale(1.05);
        }

        /* Responsive for product cards */
        @media (max-width: 768px) {
            .product-image-wrapper {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .product-image-wrapper {
                height: 220px;
            }
        }

        /* Overlay Actions */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 20px;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .overlay-actions {
            display: flex;
            gap: 10px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .product-card:hover .overlay-actions {
            transform: translateY(0);
        }

        .overlay-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .overlay-btn.view {
            background: white;
            color: #333;
        }

        .overlay-btn.view:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .overlay-btn.favorite {
            background: rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(5px);
        }

        .overlay-btn.favorite:hover {
            background: #ff6b6b;
            transform: scale(1.1);
        }

        /* Discount Badge */
        .discount-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            z-index: 2;
        }

        /* New Badge */
        .new-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            z-index: 2;
        }

        /* Product Info */
        .product-info {
            padding: 24px;
        }

        .product-category {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-name a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-name a:hover {
            color: #667eea;
        }

        /* Rating Stars */
        .product-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 16px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .star {
            color: #fbbf24;
            font-size: 0.9rem;
        }

        .star.empty {
            color: #e2e8f0;
        }

        .rating-count {
            font-size: 0.8rem;
            color: #718096;
            margin-left: 6px;
        }

        /* Available Colors */
        .available-colors {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .colors-label {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 500;
        }

        .color-dots {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .color-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }

        .color-dot:hover {
            transform: scale(1.2);
        }

        .color-dot.more-colors {
            background: #f3f4f6;
            color: #6b7280;
            font-size: 0.55rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
        }

        /* Price Section */
        .product-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .price-current {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .price-original {
            font-size: 0.9rem;
            color: #a0aec0;
            text-decoration: line-through;
            margin-left: 8px;
        }

        /* Add to Cart Button */
        .add-to-cart-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.45);
        }

        .add-to-cart-btn:active {
            transform: translateY(0);
        }

        /* Stock Badge */
        .stock-badge {
            position: absolute;
            bottom: 16px;
            right: 16px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 2;
        }

        .stock-badge.in-stock {
            background: #d1fae5;
            color: #059669;
        }

        .stock-badge.low-stock {
            background: #fef3c7;
            color: #d97706;
        }

        .stock-badge.out-of-stock {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Quick View Modal */
        .quick-view-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .quick-view-modal.active {
            display: flex;
        }

        /* Animation for loading */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .product-card:nth-child(1) { animation-delay: 0.05s; }
        .product-card:nth-child(2) { animation-delay: 0.1s; }
        .product-card:nth-child(3) { animation-delay: 0.15s; }
        .product-card:nth-child(4) { animation-delay: 0.2s; }
        .product-card:nth-child(5) { animation-delay: 0.25s; }
        .product-card:nth-child(6) { animation-delay: 0.3s; }
        .product-card:nth-child(7) { animation-delay: 0.35s; }
        .product-card:nth-child(8) { animation-delay: 0.4s; }
    </style>

    <div class="products-grid">
        @foreach($products as $product)
            @php
                $images = [];
                $firstImage = null;
                
                if ($product->img) {
                    $decoded = json_decode($product->img, true);
                    if (is_array($decoded)) {
                        $images = $decoded;
                        $firstImage = $decoded[0];
                    } else {
                        $images = [$product->img];
                        $firstImage = $product->img;
                    }
                }
                
                // Fake rating for demo
                $rating = 4.0 + (rand(0, 10) / 10);
                $reviewCount = rand(5, 150);
            @endphp

            <div class="product-card">
                {{-- Image --}}
                <div class="product-image-wrapper">
                    @if($firstImage)
                        <img src="{{ asset('img/' . $firstImage) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No Image">
                    @endif

                    {{-- Discount Badge --}}
                    @if($product->isOnDiscount())
                        <span class="discount-badge">
                            <i class="bi bi-tag-fill me-1"></i>
                            -{{ $product->discount_percentage }}%
                        </span>
                    @endif

                    {{-- New Badge --}}
                    @if($product->created_at && $product->created_at->diffInDays() < 7)
                        <span class="new-badge">NEW</span>
                    @endif

                    {{-- Stock Badge --}}
                    <span class="stock-badge in-stock">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        In Stock
                    </span>

                    {{-- Overlay Actions --}}
                    <div class="product-overlay">
                        <div class="overlay-actions">
                            <a href="{{ route('show.products.details', $product->id) }}" class="overlay-btn view" title="Quick View">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <button class="overlay-btn favorite" title="Add to Wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="product-info">
                    {{-- Category --}}
                    <span class="product-category">
                        @if($product->category)
                            {{ $product->category->name }}
                        @else
                            Uncategorized
                        @endif
                    </span>

                    {{-- Name --}}
                    <h3 class="product-name">
                        <a href="{{ route('show.products.details', $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </h3>

                    {{-- Rating --}}
                    <div class="product-rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star {{ $i <= round($rating) ? '' : 'empty' }}"></i>
                            @endfor
                        </div>
                        <span class="rating-count">({{ $reviewCount }})</span>
                    </div>

                    {{-- Available Colors --}}
                    <div class="available-colors">
                        <span class="colors-label">Colors:</span>
                        <div class="color-dots">
                            <span class="color-dot" style="background-color: #000;" title="أسود"></span>
                            <span class="color-dot" style="background-color: #fff; border: 1px solid #e2e8f0;" title="أبيض"></span>
                            <span class="color-dot" style="background-color: #e30425;" title="أحمر"></span>
                            <span class="color-dot" style="background-color: #1565c0;" title="أزرق"></span>
                            <span class="color-dot" style="background-color: #28a745;" title="أخضر"></span>
                            <span class="color-dot" style="background-color: #ffc107;" title="أصفر"></span>
                            <span class="color-dot" style="background-color: #ff69b4;" title="وردي"></span>
                            <span class="color-dot" style="background-color: #800080;" title="بنفسجي"></span>
                            <span class="color-dot" style="background-color: #ff8c00;" title="برتقالي"></span>
                            <span class="color-dot" style="background-color: #808080;" title="رمادي"></span>
                            <span class="color-dot more-colors" title="+5">+5</span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="product-price">
                        <div>
                            @if($product->isOnDiscount())
                                <span class="price-current">{{ number_format($product->discounted_price, 2) }} EGP</span>
                                <span class="price-original">{{ number_format($product->price, 2) }} EGP</span>
                            @else
                                <span class="price-current">{{ number_format($product->price, 2) }} EGP</span>
                            @endif
                        </div>
                    </div>

                    {{-- Add to Cart Button --}}
                    <a href="{{ route('show.products.details', $product->id) }}" class="add-to-cart-btn">
                        <i class="bi bi-bag-plus-fill"></i>
                        Add to Cart
                    </a>
                </div>
            </div>
        @endforeach
    </div>
     
@else
    <style>
        .empty-products {
            text-align: center;
            padding: 80px 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        
        .empty-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        
        .empty-products h3 {
            font-size: 1.5rem;
            color: #2d3748;
            margin-bottom: 12px;
        }
        
        .empty-products p {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 24px;
        }
        
        .browse-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .browse-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
            color: white;
        }
    </style>
    
    <div class="empty-products">
        <div class="empty-icon">📦</div>
        <h3>No Products Found</h3>
        <p>We couldn't find any products matching your criteria.</p>
        <a href="{{ route('show.products.index') }}" class="browse-btn">
            <i class="bi bi-arrow-left"></i>
            Browse All Products
        </a>
    </div>
@endif
