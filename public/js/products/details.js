document.addEventListener('DOMContentLoaded', function() {
    const colorBoxes = document.querySelectorAll('.color-box-new');
    const productColorInput = document.getElementById('productColor');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ----------------------------------------------------
    // ✅ Color Selection
    // ----------------------------------------------------
    if (colorBoxes.length > 0) {
        // Set default color
        productColorInput.value = colorBoxes[0].dataset.color;

        colorBoxes.forEach(box => {
            box.addEventListener('click', () => {
                colorBoxes.forEach(b => b.classList.remove('selected'));
                box.classList.add('selected');
                productColorInput.value = box.dataset.color;
            });
        });
    }

    // ----------------------------------------------------
    // ✅ Add to Cart - AJAX
    // ----------------------------------------------------
    const addToCartBtn = document.getElementById('addToCartBtn');
    
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function () {
            let color = productColorInput.value;

            if (!color) {
                alert("Please select a product color before adding to cart.");
                return;
            }

            // Show loading state
            const originalHTML = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Adding...';
            addToCartBtn.disabled = true;

            fetch(window.cartAddUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ color: color })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const cartCountEl = document.getElementById('cart-count');
                    if (cartCountEl && data.cart_count !== undefined) {
                        cartCountEl.textContent = data.cart_count;
                    }
                    alert(data.message || 'Product added to cart!');
                } else if (data.error === 'login_required') {
                    alert('Please login first');
                    window.location.href = '/customer/login';
                } else {
                    alert(data.message || 'An error occurred.');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert("Error adding product to cart. Please try again.");
            })
            .finally(() => {
                addToCartBtn.innerHTML = originalHTML;
                addToCartBtn.disabled = false;
            });
        });
    }

    // ----------------------------------------------------
    // ✅ Wishlist / Favorites
    // ----------------------------------------------------
    const favIcon = document.getElementById('heartIcon');
    const favButton = document.getElementById('addToFavBtn');
    const wishlistBtn = document.getElementById('addToWishlistBtn');
    let isFav = false;

    function toggleHeart(btn, icon) {
        if (isFav) {
            icon.classList.remove('bi-heart-fill', 'text-danger');
            icon.classList.add('bi-heart');
            btn.classList.remove('favorited');
        } else {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill', 'text-danger');
            btn.classList.add('favorited');
        }
        isFav = !isFav;
    }

    if (favButton && favIcon) {
        favButton.addEventListener('click', () => toggleHeart(favButton, favIcon));
    }
    
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', () => {
            const icon = wishlistBtn.querySelector('i');
            toggleHeart(wishlistBtn, icon);
        });
    }

    // ----------------------------------------------------
    // ✅ Star Rating Display (Emoji)
    // ----------------------------------------------------
    document.querySelectorAll('.rating-input').forEach(input => {
        input.addEventListener('change', function() {
            const emojiDisplay = document.getElementById('emoji-display');
            if (!emojiDisplay) return;
            
            switch(this.value) {
                case '1': emojiDisplay.textContent = '😞'; break;
                case '2': emojiDisplay.textContent = '😕'; break;
                case '3': emojiDisplay.textContent = '😐'; break;
                case '4': emojiDisplay.textContent = '😊'; break;
                case '5': emojiDisplay.textContent = '😍'; break;
                default: emojiDisplay.textContent = '😐';
            }
        });
    });
});
