@if ($products->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- زر السابق --}}
            @if ($products->onFirstPage())
                <li class="disabled"><span><i class="fa-solid fa-chevron-left"></i></span></li>
            @else
                <li><a href="{{ $products->appends(request()->query())->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-chevron-left"></i></a></li>
            @endif

            {{-- أرقام الصفحات --}}
            @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                @if ($page == $products->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                @endif
            @endforeach

            {{-- زر التالي --}}
            @if ($products->hasMorePages())
                <li><a href="{{ $products->appends(request()->query())->nextPageUrl() }}" rel="next"><i class="fa-solid fa-chevron-right"></i></a></li>
            @else
                <li class="disabled"><span><i class="fa-solid fa-chevron-right"></i></span></li>
            @endif
        </ul>
    </nav>
@endif
<script>
    $(document).ready(function(){
    $(document).on('click' , '.pagination a', function(e){
        e.preventDefault();
        let url= $(this).attr('href');
        appendproducts(url);
    });

    function appendproducts(url) {
     $('#products-container').css('opacity', '0.5');

        $.ajax({
            url:url,
            type:"get",
            datatype:"html"
        }).done(function(data){
            $('#products-conatainer').empty().html(data);
            $('#products-container').css('opacity' , '1');


             window.history.pushState({},"", url );
     
        }).fail(function(){

        alert('حدث خطاء اثناء تحميل المنتجات')
        })
           
   
   
   
    }
});

</script>