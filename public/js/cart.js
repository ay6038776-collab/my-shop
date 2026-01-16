$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateSummary(subtotal) {
        $('#subtotal').text(subtotal.toFixed(2) + ' EGP');
        $('#total').text((subtotal + 50).toFixed(2) + ' EGP'); // shipping ثابت
    }

    // زيادة الكمية
    $('#cart-items').on('click', '.btn-increase', function () {
        let parent = $(this).closest('.cart-item');
        let id = parent.data('id');
        let qtyElem = parent.find('.qty-display');
        let totalElem = parent.find('.total-price');

        let newQty = parseInt(qtyElem.text()) + 1;

        $.ajax({
            url: '/cart/update/' + id,
            method: 'PUT',
            data: { quantity: newQty },
            success: function(res) {
                qtyElem.text(res.quantity);
                parent.find('.btn-decrease').prop('disabled', false);
                totalElem.text(res.total_price.toFixed(2) + ' EGP');
                updateSummary(res.subtotal);
            }
        });
    });

    // نقصان الكمية
    $('#cart-items').on('click', '.btn-decrease', function () {
        let parent = $(this).closest('.cart-item');
        let id = parent.data('id');
        let qtyElem = parent.find('.qty-display');
        let totalElem = parent.find('.total-price');

        let newQty = parseInt(qtyElem.text()) - 1;
        if(newQty < 1) return;

        $.ajax({
            url: '/cart/update/' + id,
            method: 'PUT',
            data: { quantity: newQty },
            success: function(res) {
                qtyElem.text(res.quantity);
                parent.find('.btn-decrease').prop('disabled', res.quantity <= 1);
                totalElem.text(res.total_price.toFixed(2) + ' EGP');
                updateSummary(res.subtotal);
            }
        });
    });

    // حذف عنصر واحد
    $('#cart-items').on('click', '.btn-delete-single', function () {
        if(!confirm('Remove this item?')) return;
        let parent = $(this).closest('.cart-item');
        let id = parent.data('id');

        $.ajax({
            url: '/cart/remove/' + id,
            method: 'DELETE',
            success: function(res) {
                parent.slideUp(300, function(){ $(this).remove(); updateSummary(res.subtotal); });
            }
        });
    });

    // حذف العناصر المحددة
    $('#delete-selected').on('click', function () {
        if(!confirm('Delete selected items?')) return;

        let ids = $('.item-checkbox:checked').map(function(){ return $(this).val(); }).get();
        if(ids.length === 0) return;

        $.ajax({
            url: '/cart/clear',
            method: 'POST',
            data: { item_ids: ids, _method:'DELETE' },
            success: function(res) {
                ids.forEach(id => $('.cart-item[data-id="'+id+'"]').remove());
                updateSummary(res.subtotal);
            }
        });
    });

    // مسح كل السلة
    $('#clear-cart').on('click', function () {
        if(!confirm('Clear your entire cart?')) return;

        $.ajax({
            url: '/cart/clear',
            method: 'POST',
            data: {_method:'DELETE'},
            success: function(res) {
                $('#cart-items').empty();
                updateSummary(0);
            }
        });
    });
});

const colorBoxes = document.querySelectorAll('.color-box');
const productColorInput = document.getElementById('productColor');

// اختيار اللون
colorBoxes.forEach(box => {
    box.addEventListener('click', () => {
        colorBoxes.forEach(b => b.classList.remove('selected-color'));
        box.classList.add('selected-color');
        productColorInput.value = box.dataset.color; // القيمة اللي هتبعت للسيرفر
    });
});

// إضافة للسلة
document.getElementById('addToCartBtn').addEventListener('click', function () {
    let color = productColorInput.value || 'N/A';
    fetch(window.cartAddUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ color: color })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.cart_count !== undefined){
            document.getElementById('cart-count').textContent = data.cart_count;
        }
    });
});