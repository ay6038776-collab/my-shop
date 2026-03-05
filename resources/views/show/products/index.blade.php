@extends('show.layouts.app')

@section('title', 'All Products')

@section('content')

<link rel="stylesheet" href="{{ asset('css/products/index.css') }}">

<div class="container py-5">

    <h1 class="mb-4 text-center fw-bolder display-4 section-title">
        Explore Our Collection
    </h1>



    {{-- نتيجة البحث + المنتجات --}}
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
    let timeout = null;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        const query = this.value;

        timeout = setTimeout(() => {
            fetch(`/products/search?search=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    productsContainer.innerHTML = data.html;
                })
                .catch(err => console.error(err));
        }, 300); // تأخير 300ms لتقليل عدد الطلبات
    });
});



</script>

@endsection