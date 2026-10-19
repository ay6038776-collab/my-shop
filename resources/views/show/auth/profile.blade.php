@extends('show.layouts.clean')

@section('title', 'My Account Settings')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container my-5">
    <div class="profile-main-card">

        {{-- Header Gradient --}}
        <div class="card-header-gradient">
            <div class="d-flex justify-content-start mb-3">
                <a href="{{ route('show.products.index') }}" class="btn btn-glass-back rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i> Back to Home
                </a>
            </div>
            <h1><i class="bi bi-gear-fill me-2"></i> Account Settings</h1>
        </div>

        {{-- Avatar Upload Section --}}
        <div class="avatar-section px-4">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="avatarForm">
                @csrf
                <div class="avatar-wrapper">
                    @if($customer->avatar && Storage::exists('public/avatars/' . $customer->avatar))
                        <img src="{{ asset('storage/avatars/' . $customer->avatar) }}"
                                class="avatar-preview"
                                alt="Profile Avatar"
                                id="avatarPreview">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=667eea&color=fff&size=130"
                                class="avatar-preview"
                                alt="Default Avatar"
                                id="avatarPreview">
                    @endif

                    <label for="avatarInput" class="avatar-upload-btn" title="Change Photo">
                        <i class="bi bi-camera-fill"></i>
                    </label>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>
                </div>
                <button type="submit" class="btn btn-save-avatar" id="saveAvatarBtn" style="display: none;">
                    <i class="bi bi-check-circle me-1"></i> Save Photo
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="mx-4">
                <div class="alert alert-success text-center rounded-pill">{{ session('success') }}</div>
            </div>
        @endif

        <div class="row p-4">
            {{-- Sidebar Navigation --}}
            <div class="col-md-3 mb-4">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                    <a class="nav-link active" id="v-pills-info-tab" data-bs-toggle="pill" href="#v-pills-info" role="tab">
                        <i class="bi bi-person-badge me-2"></i> Personal Info
                    </a>
                    <a class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab">
                        <i class="bi bi-lock-fill me-2"></i> Change Password
                    </a>
                    <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab">
                        <i class="bi bi-geo-alt-fill me-2"></i> Addresses
                    </a>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- Personal Info Tab --}}
                    <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel">
                        <h3 class="section-title"><i class="bi bi-info-circle me-2 text-primary"></i> My Details</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-person me-2"></i>Full Name</label>
                                <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $customer->name) }}" required
                                        placeholder="Enter your full name">
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-envelope me-2"></i>Email Address</label>
                                <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $customer->email) }}" required
                                        placeholder="Enter your email">
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-telephone me-2"></i>Phone Number</label>
                                <input type="tel" name="phone" class="form-control"
                                        value="{{ old('phone', $customer->phone) }}"
                                        placeholder="Enter your phone number">
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-house me-2"></i>Address</label>
                                <textarea name="address" class="form-control" rows="3"
                                            placeholder="Enter your address">{{ old('address', $customer->address) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-save2 me-2"></i> Save Changes
                            </button>
                        </form>
                    </div>

                    {{-- Change Password Tab --}}
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel">
                        <h3 class="section-title"><i class="bi bi-shield-lock me-2 text-primary"></i> Update Security</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-key me-2"></i>Current Password</label>
                                <input type="password" name="current_password" class="form-control"
                                        placeholder="Enter current password" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-lock me-2"></i>New Password</label>
                                <input type="password" name="password" class="form-control"
                                        placeholder="Enter new password" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-lock-fill me-2"></i>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm new password" required>
                            </div>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-key-fill me-2"></i> Change Password
                            </button>
                        </form>
                    </div>

                    {{-- Addresses Tab --}}
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel">
                        <h3 class="section-title"><i class="bi bi-geo-alt me-2 text-primary"></i> Shipping & Billing</h3>

                        <div class="address-card mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-circle">
                                    <i class="bi bi-house-fill"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-2 fw-bold">Default Address</h5>
                                    <p class="text-muted mb-2">{{ $customer->address ?? 'No address added yet' }}</p>
                                    <button class="btn btn-sm btn-outline-custom">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary-custom">
                            <i class="bi bi-plus-circle-fill me-2"></i> Add New Address
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Avatar Preview Script --}}
<script>
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
            document.getElementById('saveAvatarBtn').style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
