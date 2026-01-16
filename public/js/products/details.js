  
  const colorBoxes = document.querySelectorAll('.color-box');
    const productColorInput = document.getElementById('productColor');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ----------------------------------------------------
    // ✅ ضبط التحديد الافتراضي: تحديد اللون الأول آلياً
    // ----------------------------------------------------
    if (colorBoxes.length > 0) {
        // تحديد أول صندوق لون (عادة الأسود)
        const defaultBox = colorBoxes[0];
        
        // 1. تحديث حقل الإدخال المخفي بقيمة اللون الأول
        productColorInput.value = defaultBox.dataset.color;
        
        // 2. تطبيق الكلاس البصري 'selected-color' عليه
        defaultBox.classList.add('selected-color');
    }

    // إضافة مستمعي الأحداث لتبديل اللون عند النقر
    colorBoxes.forEach(box => {
        box.addEventListener('click', () => {
            // إزالة التحديد من جميع الألوان
            colorBoxes.forEach(b => b.classList.remove('selected-color'));
            
            // إضافة التحديد على المربع الذي تم النقر عليه
            box.classList.add('selected-color');
            
            // تحديث قيمة حقل الإدخال المخفي
            productColorInput.value = box.dataset.color;
        });
    });

    // إضافة للسلة AJAX
    document.getElementById('addToCartBtn').addEventListener('click', function () {
        
        let color = productColorInput.value; // استخدام القيمة المحدثة بالفعل (الافتراضية أو المختارة)

        if (!color) {
            alert("⚠ يرجى اختيار لون المنتج قبل الإضافة للسلة.");
            return;
        }

        fetch(window.cartAddUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                color: color
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && data.cart_count !== undefined) {
                 document.getElementById('cart-count').textContent = data.cart_count;
            }
            alert(data.message);
        })
        .catch(err => {
            alert("❌ حدث خطأ أثناء إضافة المنتج إلى السلة.");
            console.error(err);
        });
 });

    


    // المفضلة
    const favIcon = document.getElementById('heartIcon');
    const favButton = document.getElementById('addToFavBtn');
    let isFav = false;

    function toggleHeart() {
        if (isFav) {
            favIcon.classList.remove('bi-heart-fill', 'text-danger');
            favIcon.classList.add('bi-heart');
            // Remove text-danger only from the floating icon, keep the danger color for the button icon when filled
            favButton.querySelector('i').classList.remove('bi-heart-fill', 'text-danger');
            favButton.querySelector('i').classList.add('bi-heart');
        } else {
            favIcon.classList.remove('bi-heart');
            favIcon.classList.add('bi-heart-fill', 'text-danger');
            favButton.querySelector('i').classList.remove('bi-heart');
            favButton.querySelector('i').classList.add('bi-heart-fill', 'text-danger');
        }
        isFav = !isFav;
    }

    favButton.addEventListener('click', toggleHeart);
    document.getElementById('favIcon').addEventListener('click', toggleHeart);
