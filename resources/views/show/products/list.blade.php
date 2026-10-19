
@if ($products->hasPages())
    <style>
        /* ===== MODERN PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
            margin-top: 40px;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 12px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            color: #4a5568;
            background: white;
            border: 2px solid #e2e8f0;
        }

        .pagination li a:hover:not(.disabled):not(.active) {
            background: #667eea;
            border-color: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
        }

        .pagination li.active span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .pagination li.disabled span {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f7fafc;
        }

        .pagination li:first-child a,
        .pagination li:first-child span {
            border-radius: 12px 0 0 12px;
        }

        .pagination li:last-child a,
        .pagination li:last-child span {
            border-radius: 0 12px 12px 0;
        }

        .page-icon {
            font-size: 0.85rem;
        }

        /* Loading State */
        .pagination-loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .pagination li a,
            .pagination li span {
                min-width: 38px;
                height: 38px;
                font-size: 0.85rem;
            }
        }
    </style>

    <nav aria-label="Page navigation" class="pagination-wrapper">
        <ul class="pagination">
            {{-- Previous Button --}}
            @if ($products->onFirstPage())
                <li class="disabled">
                    <span><i class="fa-solid fa-chevron-left page-icon"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-chevron-left page-icon"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                @if ($page == $products->currentPage())
                    <li class="active">
                        <span>{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($products->hasMorePages())
                <li>
                    <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" rel="next">
                        <i class="fa-solid fa-chevron-right page-icon"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span><i class="fa-solid fa-chevron-right page-icon"></i></span>
                </li>
            @endif
        </ul>
    </nav>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                appendproducts(url);
            });

            function appendproducts(url) {
                $('#products-container').css('opacity', '0.5').addClass('pagination-loading');

                $.ajax({
                    url: url,
                    type: "get",
                    datatype: "html"
                }).done(function(data) {
                    $('#products-container').empty().html(data);
                    $('#products-container').css('opacity', '1').removeClass('pagination-loading');
                    window.history.pushState({}, "", url);
                    
                    // Scroll to top smoothly
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }).fail(function() {
                    alert('Error loading products. Please try again.');
                    $('#products-container').css('opacity', '1').removeClass('pagination-loading');
                });
            }
        });
    </script>
@endif
