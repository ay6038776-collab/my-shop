<!-- Language Switcher Component -->
@php
    $currentLang = app()->getLocale();
    $otherLang = $currentLang == 'ar' ? 'en' : 'ar';
    $langName = $currentLang == 'ar' ? 'English' : 'العربية';
@endphp

<li class="nav-item dropdown ms-lg-2">
    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 rounded-3 bg-light bg-opacity-10"
       href="#" role="button" data-bs-toggle="dropdown" title="Switch Language"
       style="font-size: 1rem;">
        <i class="fa-solid fa-globe fs-5"></i>
        <span class="fw-bold d-none d-lg-inline">{{ $langName }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
        <li>
            <a class="dropdown-item py-2 px-3 rounded-2 mx-2 mb-1 {{ $currentLang == 'ar' ? 'active bg-primary text-white' : '' }}"
               href="{{ route('lang.switch', 'ar') }}"
               style="font-size: 0.95rem;">
                🇪🇬 العربية
            </a>
        </li>
        <li>
            <a class="dropdown-item py-2 px-3 rounded-2 mx-2 {{ $currentLang == 'en' ? 'active bg-primary text-white' : '' }}"
               href="{{ route('lang.switch', 'en') }}"
               style="font-size: 0.95rem;">
                🇬🇧 English
            </a>
        </li>
    </ul>
</li>
