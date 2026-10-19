@extends('layouts.app')
@section('title', 'Edit Employee - MyShop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - MyShop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
:root {
    --primary: #4f46e5;
    --primary-dark: #3730a3;
    --success: #10b981;
    --danger: #ef4444;
    --gray: #64748b;
    --light-gray: #e2e8f0;
    --bg: #f1f5f9;
    --white: #ffffff;
    --darker: #0f172a;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg);
    color: var(--darker);
    min-height: 100vh;
}

.topbar {
    background: var(--white);
    padding: 14px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 100;
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand img {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.brand h2 {
    font-size: 1.2rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary), #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.main-content {
    padding: 30px;
    max-width: 900px;
    margin: 0 auto;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    background: var(--white);
    border: 1px solid var(--light-gray);
    color: var(--darker);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-bottom: 25px;
}

.back-btn:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateX(-5px);
}

.form-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid var(--light-gray);
}

.form-header {
    padding: 24px 30px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-bottom: 1px solid var(--light-gray);
}

.form-header h2 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--darker);
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-header h2 i {
    color: var(--primary);
}

.form-header p {
    color: var(--gray);
    font-size: 0.9rem;
    margin-top: 6px;
    margin-left: 36px;
}

.form-body {
    padding: 30px;
}

.avatar-section {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    padding: 20px;
    background: var(--bg);
    border-radius: 12px;
}

.avatar-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--white);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.avatar-info h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--darker);
    margin-bottom: 4px;
}

.avatar-info p {
    font-size: 0.85rem;
    color: var(--gray);
    margin-bottom: 8px;
}

.avatar-info small {
    color: var(--gray);
    font-size: 0.75rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--darker);
    margin-bottom: 8px;
}

.form-label i {
    color: var(--primary);
    margin-right: 6px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--light-gray);
    border-radius: 12px;
    font-size: 0.95rem;
    font-family: 'Poppins';
    transition: all 0.3s ease;
    background: var(--white);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

.form-control:disabled {
    background: var(--bg);
    color: var(--gray);
    cursor: not-allowed;
}

select.form-control {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 45px;
}

.toggle-group {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    background: var(--bg);
    border-radius: 12px;
    margin-bottom: 20px;
}

.toggle-label {
    flex: 1;
}

.toggle-label h4 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--darker);
    margin-bottom: 4px;
}

.toggle-label p {
    font-size: 0.8rem;
    color: var(--gray);
}

.toggle-switch {
    position: relative;
    width: 56px;
    height: 30px;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--light-gray);
    transition: 0.3s;
    border-radius: 30px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.toggle-switch input:checked + .toggle-slider {
    background-color: var(--success);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

.file-upload {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    border: 2px dashed var(--light-gray);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafbfc;
}

.file-upload:hover {
    border-color: var(--primary);
    background: rgba(79, 70, 229, 0.05);
}

.file-upload i {
    font-size: 2rem;
    color: var(--gray);
    margin-bottom: 8px;
}

.file-upload span {
    font-size: 0.85rem;
    color: var(--gray);
}

.file-upload input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    padding-top: 20px;
    border-top: 1px solid var(--light-gray);
    margin-top: 30px;
}

.btn {
    padding: 12px 28px;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.btn-cancel {
    background: transparent;
    border: 2px solid var(--light-gray);
    color: var(--darker);
}

.btn-cancel:hover {
    background: var(--bg);
    border-color: var(--gray);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), #7c3aed);
    color: white;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .topbar {
        padding: 12px 15px;
    }
    
    .main-content {
        padding: 15px;
    }
    
    .form-header,
    .form-body {
        padding: 20px;
    }
    
    .avatar-section {
        flex-direction: column;
        text-align: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

@section('content')
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="MyShop">
        <h2>MyShop Admin</h2>
    </div>
</div>

<div class="main-content">
    <a href="{{ route('admin.employees.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Employees
    </a>

    <div class="form-card">
        <div class="form-header">
            <h2>
                <i class="fa-solid fa-user-pen"></i>
                Edit Employee
            </h2>
            <p>Update the employee information below</p>
        </div>

        <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-body">
                <!-- Avatar Section -->
                <div class="avatar-section">
                    @php
                      $empAvatar = $employee->avatar
    ? asset('img/' . $employee->avatar)
    : asset('img/33.jpg');
                    @endphp
                    <img src="{{ $empAvatar }}" alt="{{ $employee->name }}" class="avatar-preview">
                    <div class="avatar-info">
                        <h4>{{ $employee->name }}</h4>
                        <p>{{ $employee->email }}</p>
                        <small>Update image by uploading a new one below</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-user"></i>
                            Full Name
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               placeholder="Enter employee full name" 
                               value="{{ old('name', $employee->name) }}" 
                               required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               placeholder="employee@company.com" 
                               value="{{ old('email', $employee->email) }}" 
                               required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-lock"></i>
                            New Password (leave blank to keep current)
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               placeholder="Enter new password (min 6 chars)" 
                               minlength="6">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-phone"></i>
                            Phone (optional)
                        </label>
                        <input type="text" 
                               class="form-control" 
                               name="phone" 
                               placeholder="+20 1xx xxx xxxx" 
                               value="{{ old('phone', $employee->phone) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-id-badge"></i>
                            Role
                        </label>
                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $employee->roles->first()?->id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} - {{ $role->description ?? 'No description' }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-image"></i>
                            Update Avatar
                        </label>
                        <label class="file-upload">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Click to upload new avatar</span>
                            <small style="color: var(--gray); font-size: 0.75rem;">JPG, PNG, GIF (Max 2MB)</small>
                            <input type="file" name="avatar" accept="image/*">
                        </label>
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Status Toggle -->
                @if(!$employee->isOwner())
                    <div class="toggle-group">
                        <div class="toggle-label">
                            <h4>Account Status</h4>
                            <p>Enable or disable this employee's account access</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $employee->is_active) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                @endif

                <div class="form-actions">
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-cancel">
                        <i class="fa-solid fa-xmark"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-check"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
