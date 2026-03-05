@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 text-center">
                    <div class="icon-box mb-2">
                        <i class="fas fa-user-plus text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="fw-bold" style="color: #2d3748;">إضافة موظف جديد</h3>
                    <p class="text-muted small">قم بتعبئة البيانات التالية لإنشاء ملف الموظف</p>
                </div>

                <div class="card-body px-5 pb-5">
                    <form method="POST" action="{{ route('admin.employees.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold small">اسم الموظف</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 shadow-none" name="name" placeholder="مثال: أحمد محمد" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold small">البريد الإلكتروني</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 ps-0 shadow-none" name="email" placeholder="name@company.com" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold small">رقم الهاتف</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 shadow-none" name="phone" placeholder="01xxxxxxxxx">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold small">ساعات العمل اليومية</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-clock text-muted"></i></span>
                                    <input type="number" class="form-control border-start-0 ps-0 shadow-none" name="daily_hours" placeholder="8">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('admin.employees.index') }}" class="btn btn-light px-4 fw-semibold border">إلغاء</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm" style="border-radius: 8px; background: linear-gradient(45deg, #4e73df, #224abe); border: none;">
                                <i class="fas fa-save me-2"></i> حفظ بيانات الموظف
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* تحسينات الحقول عند التركيز */
    .form-control:focus {
        border-color: #4e73df;
        background-color: #fff;
    }
    .input-group-text {
        border-radius: 8px 0 0 8px !important;
    }
    .form-control {
        border-radius: 0 8px 8px 0 !important;
        padding: 10px 15px;
    }
    body {
        background-color: #f8f9fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3) !important;
    }
</style>
@endsection