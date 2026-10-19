{{-- Cyber Theme Language Switch --}}
@php
    $currentLang = app()->getLocale();
@endphp

<a href="{{ route('lang.switch', $currentLang == 'ar' ? 'en' : 'ar') }}"
   class="lang-switch-btn"
   title="{{ $currentLang == 'ar' ? 'Switch to English' : 'التبديل للعربية' }}">
    <span class="lang-code">{{ $currentLang == 'ar' ? 'EN' : 'ع' }}</span>
</a>

<style>
.lang-switch-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0a0f1c, #1a2744);
    border: 2px solid #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
    text-decoration: none;
    transition: all 0.3s ease;
}

.lang-switch-btn:hover {
    background: linear-gradient(135deg, #00d4ff, #0066ff);
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(0, 212, 255, 0.6);
}

.lang-code {
    font-weight: 700;
    font-size: 0.85rem;
    color: #00d4ff;
}

.lang-switch-btn:hover .lang-code {
    color: #fff;
}
</style>
