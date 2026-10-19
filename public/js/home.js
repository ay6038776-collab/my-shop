// تحديث الساعة الرقمية كل ثانية
function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    const clockEl = document.getElementById('digital-clock');
    if (clockEl) {
        clockEl.innerHTML = `
            <div class="timer-block">
                <span class="timer-number">${hours}</span>
                <span class="timer-label">Hours</span>
            </div>
            <span class="timer-separator">:</span>
            <div class="timer-block">
                <span class="timer-number">${minutes}</span>
                <span class="timer-label">Minutes</span>
            </div>
            <span class="timer-separator">:</span>
            <div class="timer-block">
                <span class="timer-number">${seconds}</span>
                <span class="timer-label">Seconds</span>
            </div>
        `;
    }
}
setInterval(updateClock, 1000);
updateClock();

// إعداد العدادات التنازلية وأشرطة التقدم لكل منتج
function initializeProductTimers() {
    if (!window.productTimers) return;

    window.productTimers.forEach(product => {
        const countdownEl = document.getElementById(`countdown-${product.id}`);
        if (!countdownEl) return;

        function updateTimer() {
            const now = new Date().getTime();
            const distance = product.end - now;

            if (distance < 0) {
                countdownEl.innerHTML = '<i class="bi bi-clock-history"></i> Offer Ended';
                const progressBar = document.getElementById(`progress-${product.id}`);
                if (progressBar) progressBar.style.width = "0%";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML = `<i class="bi bi-clock-fill"></i> ${days}d ${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    });
}

// تشغيل عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", initializeProductTimers);

// Dark Mode Toggle
const toggleInput = document.getElementById('dark-mode-toggle');
if (toggleInput) {
    toggleInput.addEventListener('change', () => {
        if (toggleInput.checked) {
            document.body.classList.add('dark-theme');
        } else {
            document.body.classList.remove('dark-theme');
        }
    });
}

/* ===========================
      ADS SLIDER
============================== */
document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".ads-track");
    const cards = document.querySelectorAll(".ad-card");
    const next = document.querySelector(".ads-next");
    const prev = document.querySelector(".ads-prev");

    if (!track || cards.length === 0) return;

    let index = 0;

    function showSlide(i) {
        if (i >= cards.length) index = 0;
        else if (i < 0) index = cards.length - 1;
        else index = i;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    next?.addEventListener("click", () => showSlide(index + 1));
    prev?.addEventListener("click", () => showSlide(index - 1));

    let auto = setInterval(() => showSlide(index + 1), 4000);

    const slider = document.querySelector(".ads-slider");
    slider?.addEventListener("mouseenter", () => clearInterval(auto));
    slider?.addEventListener("mouseleave", () => auto = setInterval(() => showSlide(index + 1), 4000));
});

/* ===========================
      HOME SLIDER (Swiper)
============================== */
new Swiper(".homeSlider", {
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    speed: 900,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});
