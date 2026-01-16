@extends('show.layouts.clean') {{-- Assuming a layout without a navbar --}}

@section('title', 'My Account Settings')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container my-5 col-xl-8 col-lg-10">
    <div class="profile-main-card shadow-lg rounded-4 p-5">
        
        {{-- 🆕 الزر الجديد: زر الرجوع إلى الصفحة الرئيسية --}}
        <div class="text-start mb-4">
            {{-- افترضنا أن اسم المسار للصفحة الرئيسية هو 'home' --}}
            <a href="{{ route('home') }}" class="btn btn-outline-light rounded-pill btn-glass-back">
                <i class="bi bi-arrow-left me-2"></i> Back to Home
            </a>
        </div>
        {{-- نهاية الزر الجديد --}}

        <h1 class="mb-5 text-center text-light fw-bold">
            <i class="bi bi-gear-fill me-2"></i> Account Settings
        </h1>

        @if(session('success'))
            <div class="alert alert-success text-center border-0 rounded-pill">{{ session('success') }}</div>
        @endif

        <div class="row">
            {{-- Sidebar for Tabs --}}
            <div class="col-md-3">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link glass-tab active" id="v-pills-info-tab" data-bs-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true">
                        <i class="bi bi-person-badge me-2"></i> Personal Info
                    </a>
                    <a class="nav-link glass-tab" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">
                        <i class="bi bi-lock-fill me-2"></i> Change Password
                    </a>
                    <a class="nav-link glass-tab" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="bi bi-geo-alt-fill me-2"></i> Addresses & Shipping
                    </a>
                    {{-- Add more tabs here (e.g., Orders, Notifications) --}}
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- 1. Personal Info Tab --}}
                    <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                        <h3 class="mb-4 text-primary fw-bold"><i class="bi bi-info-circle-fill me-2"></i> My Details</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-light">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill shadow-sm input-glass"
                                       value="{{ old('name', $customer->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-light">Email</label>
                                <input type="email" name="email" class="form-control rounded-pill shadow-sm input-glass"
                                       value="{{ old('email', $customer->email) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 w-100 rounded-pill btn-glass">
                                <i class="bi bi-save2 me-1"></i> Save Changes
                            </button>
                        </form>
                    </div>

                    {{-- 2. Change Password Tab --}}
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <h3 class="mb-4 text-primary fw-bold"><i class="bi bi-shield-lock-fill me-2"></i> Update Security</h3>
                        {{-- تم تغيير المسار هنا بناءً على المناقشة السابقة ليعمل مع الدالة الجديدة --}}
                        <form method="POST" action="{{ route('profile.update') }}"> 
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-light">Current Password</label>
                                <input type="password" name="current_password" class="form-control rounded-pill shadow-sm input-glass" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-light">New Password</label>
                                <input type="password" name="password" class="form-control rounded-pill shadow-sm input-glass" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-light">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-pill shadow-sm input-glass" required>
                            </div>
                            <button type="submit" class="btn btn-warning mt-3 w-100 rounded-pill btn-glass">
                                <i class="bi bi-key-fill me-1"></i> Change Password
                            </button>
                        </form>
                    </div>

                    {{-- 3. Addresses Tab (Example) --}}
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h3 class="mb-4 text-primary fw-bold"><i class="bi bi-house-door-fill me-2"></i> Shipping & Billing</h3>
                        <div class="card p-3 mb-3 input-glass border-0">
                            <p class="fw-bold mb-1 text-light">Default Address:</p>
                            <p class="text-light">123 Main St, Apt 4B</p>
                            <p class="text-light">Springfield, IL 62704</p>
                            <button class="btn btn-sm btn-outline-light rounded-pill float-end">Edit</button>
                        </div>
                        <button class="btn btn-success mt-3 w-100 rounded-pill btn-glass">
                            <i class="bi bi-plus-circle-fill me-1"></i> Add New Address
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection