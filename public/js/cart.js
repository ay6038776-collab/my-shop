$(function () {
    // ----------------------------------------------------
    // ✅ CSRF Token Setup for all AJAX requests
    // ----------------------------------------------------
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ----------------------------------------------------
    // ✅ Update summary totals
    // ----------------------------------------------------
    function updateSummary(subtotal) {
        var shipping = 50;
        var total = subtotal + shipping;
        
        $('#subtotal').text(subtotal.toFixed(2) + ' EGP');
        $('#total').text(total.toFixed(2) + ' EGP');
    }

    // ----------------------------------------------------
    // ✅ Increase Quantity
    // ----------------------------------------------------
    $('#cart-items').on('click', '.qty-btn.increase', function () {
        var parent = $(this).closest('.cart-item');
        var id = parent.data('id');
        var qtyElem = parent.find('.qty-display');
        var priceCurrent = parent.find('.price-current');

        var newQty = parseInt(qtyElem.text()) + 1;

        $.ajax({
            url: '/cart/update/' + id,
            method: 'PUT',
            data: { quantity: newQty },
            success: function(res) {
                qtyElem.text(res.quantity);
                parent.find('.qty-btn.decrease').prop('disabled', false);
                priceCurrent.text(res.total_price.toFixed(2) + ' EGP');
                updateSummary(res.subtotal);
                
                // Update navbar cart count
                updateNavbarCartCount();
            },
            error: function(xhr) {
                console.error('Error updating quantity:', xhr);
                alert('❌ Error updating quantity. Please try again.');
            }
        });
    });

    // ----------------------------------------------------
    // ✅ Decrease Quantity
    // ----------------------------------------------------
    $('#cart-items').on('click', '.qty-btn.decrease', function () {
        var parent = $(this).closest('.cart-item');
        var id = parent.data('id');
        var qtyElem = parent.find('.qty-display');
        var priceCurrent = parent.find('.price-current');

        var newQty = parseInt(qtyElem.text()) - 1;
        if (newQty < 1) return;

        $.ajax({
            url: '/cart/update/' + id,
            method: 'PUT',
            data: { quantity: newQty },
            success: function(res) {
                qtyElem.text(res.quantity);
                parent.find('.qty-btn.decrease').prop('disabled', res.quantity <= 1);
                priceCurrent.text(res.total_price.toFixed(2) + ' EGP');
                updateSummary(res.subtotal);
                
                // Update navbar cart count
                updateNavbarCartCount();
            },
            error: function(xhr) {
                console.error('Error updating quantity:', xhr);
                alert('❌ Error updating quantity. Please try again.');
            }
        });
    });

    // ----------------------------------------------------
    // ✅ Delete Single Item
    // ----------------------------------------------------
    $('#cart-items').on('click', '.delete-btn', function () {
        if (!confirm('Remove this item from cart?')) return;
        
        var parent = $(this).closest('.cart-item');
        var id = parent.data('id');

        $.ajax({
            url: '/cart/remove/' + id,
            method: 'DELETE',
            success: function(res) {
                parent.slideUp(300, function() { 
                    $(this).remove(); 
                    updateSummary(res.subtotal);
                    
                    // Update navbar cart count
                    updateNavbarCartCount();
                    
                    // Check if cart is empty
                    if ($('.cart-item').length === 0) {
                        location.reload();
                    }
                });
            },
            error: function(xhr) {
                console.error('Error removing item:', xhr);
                alert('❌ Error removing item. Please try again.');
            }
        });
    });

    // ----------------------------------------------------
    // ✅ Clear Entire Cart
    // ----------------------------------------------------
    $('#clear-cart').on('click', function () {
        if (!confirm('Clear your entire cart?')) return;

        $.ajax({
            url: '/cart/clear',
            method: 'POST',
            data: { _method: 'DELETE' },
            success: function(res) {
                $('#cart-items').empty();
                updateSummary(0);
                
                // Update navbar cart count
                updateNavbarCartCount();
                
                // Show empty cart message
                location.reload();
            },
            error: function(xhr) {
                console.error('Error clearing cart:', xhr);
                alert('❌ Error clearing cart. Please try again.');
            }
        });
    });

    // ----------------------------------------------------
    // ✅ Helper: Update navbar cart count
    // ----------------------------------------------------
    function updateNavbarCartCount() {
        var totalQty = 0;
        $('.cart-item').each(function() {
            var qty = parseInt($(this).find('.qty-display').text()) || 0;
            totalQty += qty;
        });
        
        var cartCountEl = $('#cart-count');
        if (cartCountEl.length) {
            cartCountEl.text(totalQty);
        }
    }
});
