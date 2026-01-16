@extends('show.layouts.app')

@section('title', 'Order Details - Order #' . $order->id)

@section('content')

<style>
    /* 🎨 لوحة الألوان والأساسيات الجديدة */
    :root {
        --primary-dark: #3a506b; /* أزرق داكن (للنصوص الأساسية) */
        --accent-green: #59b275; /* أخضر ناعم (للنجاح/التسليم) */
        --accent-orange: #ffb74d; /* برتقالي (للمعلق) */
        --accent-blue: #4db6ac; /* أزرق مخضر (للشحن) */
    }

    /* CSS للحالات الجديدة */
    .status-pending-new { background: var(--accent-orange); color: #fff; }
    .status-shipped-new { background: var(--accent-blue); color: #fff; }
    .status-delivered-new { background: var(--accent-green); color: #fff; }

    /* التصميم العام للبطاقة */
    .order-summary-card {
        background: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: 0.4s;
        border: 1px solid #e9ecef;
    }
    .order-summary-card:hover {
        box-shadow: 0 15px 45px rgba(0,0,0,0.1);
    }
    .order-header-bg {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #6b7a8f 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }
    .status-badge-new {
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 15px;
        min-width: 120px;
        text-align: center;
    }

    /* تفاصيل المنتج داخل القائمة */
    .product-list-item {
        transition: background-color 0.3s;
        border-left: 5px solid transparent;
        border-radius: 8px;
    }
    .product-list-item:hover {
        background-color: #f8f9fa;
        border-left-color: var(--accent-green);
    }
    .product-image-thumb {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .info-box {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
    }
    .info-box h6 {
        color: var(--primary-dark);
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
</style>

<div class="container py-5 product-details-container">
    <div class="row">
        <div class="col-12">
            <div class="order-summary-card">
                
                <div class="order-header-bg">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="display-6 mb-0 fw-bold">الطلب #{{ $order->id }}</h1>
                        <span class="status-badge-new shadow 
                            @if($order->status == 'pending') status-pending-new 
                            @elseif($order->status == 'shipped') status-shipped-new 
                            @elseif($order->status == 'delivered') status-delivered-new 
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <p class="mt-2 mb-0 small text-light-50">تاريخ الطلب: {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="row p-4 p-md-5 g-4">
                    
                    <div class="col-lg-8">
                        <h3 class="mb-4 fw-bold text-dark">📦 المنتجات المطلوبة</h3>
                        
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($order->items as $item)
                                <li class="list-group-item product-list-item py-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="product-image-thumb me-3">
                                            @if($item->product->img)
                                                <img src="{{ asset('img/' . $item->product->img) }}" alt="{{ $item->product->name }}" class="img-fluid w-100 h-100 object-fit-cover">
                                            @else
                                                <img src="https://via.placeholder.com/60" alt="No Image" class="img-fluid">
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <h6 class="mb-0 fw-bold text-primary-dark">{{ $item->product->name }}</h6>
                                            <small class="text-muted">الكمية: {{ $item->quantity }}</small>
                                            </div>
                                    </div>
                                    
                                    <span class="fw-bold text-secondary">{{ $item->product->price * $item->quantity }} ج.م</span>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="p-4 rounded-4" style="background: #e6f3f0;">
                            <h4 class="fw-bold mb-3 text-dark">ملخص الفاتورة</h4>
                            <ul class="list-unstyled mb-0 small">
                                <li class="d-flex justify-content-between mb-2">
                                    <span>المجموع الفرعي:</span>
                                    <span>{{ $order->items->sum(fn($i) => $i->product->price * $i->quantity) }} ج.م</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span>تكلفة الشحن:</span>
                                    <span>50 ج.م</span> </li>
                                <li class="d-flex justify-content-between pt-2 border-top">
                                    <span class="fw-bolder fs-5 text-success">💰 الإجمالي النهائي:</span>
                                    <span class="fw-bolder fs-5 text-success">{{ $order->items->sum(fn($i) => $i->product->price * $i->quantity) + 50 }} ج.م</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <h3 class="mb-4 fw-bold text-dark">معلومات التسليم</h3>

                        <div class="info-box shadow-sm">
                            <h6 class="text-primary-dark">العنوان المرسل إليه:</h6>
                            <p class="small mb-0 text-muted">
                                {{ $order->address ?? 'العنوان غير متاح في البيانات الحالية، يرجى إضافته.' }}
                            </p>
                        </div>
                        
                        <div class="info-box shadow-sm">
                            <h6 class="text-primary-dark">طريقة الدفع:</h6>
                            <p class="small mb-0 text-muted">
                                {{ $order->payment_method ?? 'الدفع عند الاستلام (افتراضي)' }}
                            </p>
                        </div>

                        <div class="info-box shadow-sm">
                            <h6 class="text-primary-dark">ملاحظات:</h6>
                            <p class="small mb-0 text-muted">
                                لتتبع الشحنة أو طلب إلغاء، يرجى التواصل مع خدمة العملاء عبر البريد الإلكتروني أو الهاتف.
                            </p>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">
                                ← الرجوع إلى طلباتي
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection