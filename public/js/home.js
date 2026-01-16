 // تحديث الساعة الرقمية كل ثانية
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('digital-clock').innerText = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // إعداد العدادات التنازلية وأشرطة التقدم لكل منتج
    function initializeProductTimers() {
        if (!window.productTimers) return; // تأكد من وجود البيانات

        window.productTimers.forEach(product => {
            const countdownEl = document.getElementById(`countdown-${product.id}`);
            const progressBarEl = document.getElementById(`progress-${product.id}`);

            function updateTimer() {
                const now = new Date().getTime();
                const distance = product.end - now;

                if (distance < 0) {
                    countdownEl.innerText = "⏳ Offer Ended";
                    progressBarEl.style.width = "0%";
                    clearInterval(interval);
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.innerText = `⏳ ${days}d ${hours}h ${minutes}m ${seconds}s`;

                const totalDuration = product.end - product.start;
                const progressPercent = Math.max(0, Math.min(100, ((totalDuration - distance) / totalDuration) * 100));
                progressBarEl.style.width = `${progressPercent}%`;
            }

            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        });
    }
    
    // تأجيل تشغيل العدادات حتى يتم تحميل الـ DOM بالكامل
    document.addEventListener("DOMContentLoaded", initializeProductTimers);