{{-- resources/views/show/contact.blade.php (Modern Split Design) --}}
@extends('show.layouts.app') 


@section('title', 'Contact Us - Get in Touch')

@section('content')
{{-- قسم الاتصال الرئيسي --}}   
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">



<div class="container contact-container">
    <div class="card contact-card">
        <div class="row g-0">
            
            {{-- القسم الأيمن (معلومات الاتصال والأيقونات) --}}
            <div class="col-lg-5">
                <div class="info-section h-100">
                    <div>
                        <h2 class="fw-bold mb-4 text-center text-white">معلومات التواصل</h2>
                        
                        {{-- العنوان --}}
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <h5 class="mb-0">العنوان</h5>
                                <p class="mb-0 small">شارع رقم 123، الحي التجاري، المدينة</p>
                            </div>
                        </div>

                        {{-- الهاتف --}}
                        <div class="info-item">
                            <i class="bi bi-phone-fill"></i>
                            <div>
                                <h5 class="mb-0">الهاتف</h5>
                                <p class="mb-0 small">+20 123 456 789</p>
                            </div>
                        </div>

                        {{-- البريد الإلكتروني --}}
                        <div class="info-item">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <h5 class="mb-0">البريد الإلكتروني</h5>
                                <p class="mb-0 small">info@example.com</p>
                            </div>
                        </div>
                    </div>

                    {{-- أيقونات التواصل الاجتماعي --}}
                    <div class="mt-4 pt-3 border-top border-light social-icons text-center">
                        <div class="social-icons text-center">
                                <a href="https://www.facebook.com/profile.php?id=100090847241292&ref=_ig_profile_ac" target="_blank" class="facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>

                                <a href="https://x.com/ay603877ea" target="_blank" class="twitter">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>

                                <a href="https://www.instagram.com/amh_ahmed123/" target="_blank" class="instagram">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>

                                <a href="https://www.linkedin.com/in/ahmad-yasser-978796393" target="_blank" class="linkedin">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                                 <a href="https://www.tiktok.com/@c_a_408?is_from_webapp=1&sender_device=pc" target="_blank" class="tiktok">
                                    <i class="fa-brands fa-tiktok"></i>
                                </a>
                         </div>
                    </div>
                </div>
            </div>

            {{-- القسم الأيسر (نموذج الاتصال) --}}
            <div class="col-lg-7">
                <div class="form-section">
                    <h2 class="text-center">أرسل لنا رسالة</h2>

                    {{-- رسالة النجاح --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    {{-- نموذج الاتصال --}}
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="اسمك الكامل" value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="بريدك الإلكتروني" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">الموضوع</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="عنوان الرسالة" value="{{ old('subject') }}" required>
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">الرسالة</label>
                            <textarea name="message" class="form-control" id="message" rows="5" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-send-fill me-2"></i> إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- قسم الخريطة (اختياري) --}}
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-12 p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.799738670183!2d31.23354368523315!3d30.04441998188242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145839071060f785%3A0x6c9c6f9c4f7b0f6!2z2KzYqdi32LHYjCDYp9mE2YXZg9iqINmF2K3Yr9mI2YjYjCDZhdiq2KfZgdi42Kcg2KfZhNmD2KfZhNmC!5e0!3m2!1sar!2seg!4v1677840000000" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

@endsection