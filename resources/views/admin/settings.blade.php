@extends('layouts.app')
@section('title', 'Settings - My Shop Admin')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

<style>
:root {
    --primary: #4f46e5;
    --primary-light: #818cf8;
    --primary-dark: #3730a3;
    --success: #10b981;
    --success-light: #34d399;
    --warning: #f59e0b;
    --warning-light: #fbbf24;
    --danger: #ef4444;
    --danger-light: #f87171;
    --dark: #1e293b;
    --darker: #0f172a;
    --gray: #64748b;
    --gray-light: #94a3b8;
    --gray-lighter: #cbd5e1;
    --bg: #f1f5f9;
    --bg-card: #ffffff;
    --border: #e2e8f0;
    --shadow: 0 1px 3px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 40px rgba(0,0,0,0.1);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--dark);
    min-height: 100vh;
}

/* Layout */
.settings-layout {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.settings-sidebar {
    width: 280px;
    background: var(--bg-card);
    border-right: 1px solid var(--border);
    padding: 24px 0;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 100;
}

.sidebar-header {
    padding: 0 24px 24px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.sidebar-logo-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.sidebar-logo-text h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--dark);
}

.sidebar-logo-text span {
    font-size: 0.75rem;
    color: var(--gray);
}

/* Sidebar Nav */
.sidebar-nav {
    padding: 0 12px;
}

.sidebar-section {
    margin-bottom: 8px;
}

.sidebar-section-title {
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 8px 16px;
    margin-bottom: 4px;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: var(--gray);
    text-decoration: none;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.sidebar-link:hover {
    background: var(--bg);
    color: var(--dark);
}

.sidebar-link.active {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(129, 140, 248, 0.1) 100%);
    color: var(--primary);
}

.sidebar-link i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
}

.sidebar-link .badge {
    margin-right: auto;
    background: var(--danger);
    color: white;
    font-size: 0.65rem;
    padding: 2px 8px;
    border-radius: 10px;
    font-weight: 600;
}

/* Main Content */
.settings-main {
    flex: 1;
    margin-left: 280px;
    padding: 32px 40px;
    max-width: 1000px;
}

/* Page Header */
.page-header {
    margin-bottom: 32px;
}

.page-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-header h1 i {
    color: var(--primary);
}

.page-header p {
    color: var(--gray);
    font-size: 0.95rem;
}

/* Alerts */
.alert {
    padding: 16px 20px;
    border-radius: 12px;
    font-size: 0.9rem;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.alert-success {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert-error {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    color: #991b1b;
    border: 1px solid #fecaca;
}

/* Settings Sections */
.settings-section {
    background: var(--bg-card);
    border-radius: 16px;
    border: 1px solid var(--border);
    margin-bottom: 24px;
    overflow: hidden;
}

.section-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
    background: linear-gradient(135deg, #fafafa 0%, #f8fafc 100%);
}

.section-header i {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.section-header h2 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark);
}

.section-header p {
    font-size: 0.8rem;
    color: var(--gray);
    margin-top: 2px;
}

.section-body {
    padding: 24px;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.form-grid.full {
    grid-template-columns: 1fr;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 6px;
}

.form-group label .required {
    color: var(--danger);
}

.form-input {
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 10px;
    font-size: 0.9rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.2s ease;
    background: var(--bg-card);
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

.form-input::placeholder {
    color: var(--gray-light);
}

textarea.form-input {
    resize: vertical;
    min-height: 100px;
}

select.form-input {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
}

input[type="color"].form-input {
    padding: 6px;
    height: 48px;
    cursor: pointer;
}

/* Toggle Items */
.toggle-list {
    display: flex;
    flex-direction: column;
}

.toggle-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
}

.toggle-item:last-child {
    border-bottom: none;
}

.toggle-info h4 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 4px;
}

.toggle-info p {
    font-size: 0.8rem;
    color: var(--gray);
}

/* Toggle Switch */
.toggle-switch {
    position: relative;
    width: 52px;
    height: 28px;
    flex-shrink: 0;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background: var(--gray-lighter);
    border-radius: 28px;
    transition: 0.3s;
}

.toggle-slider:before {
    content: '';
    position: absolute;
    width: 22px;
    height: 22px;
    left: 3px;
    bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: 0.3s;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.toggle-switch input:checked + .toggle-slider {
    background: var(--primary);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(24px);
}

/* Buttons */
.btn {
    padding: 12px 24px;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'Inter', sans-serif;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
}

.btn-outline {
    background: white;
    color: var(--gray);
    border: 2px solid var(--border);
}

.btn-outline:hover {
    border-color: var(--dark);
    color: var(--dark);
}

.btn-group {
    display: flex;
    gap: 12px;
    margin-top: 24px;
}

/* Danger Zone */
.danger-zone {
    border-color: var(--danger);
}

.danger-zone .section-header {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
}

.danger-zone .section-header i {
    background: linear-gradient(135deg, var(--danger) 0%, var(--danger-light) 100%);
}

.danger-zone .section-header h2 {
    color: var(--danger);
}

.danger-card {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
}

.danger-card:last-child {
    margin-bottom: 0;
}

.danger-card h4 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--danger);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.danger-card p {
    font-size: 0.8rem;
    color: #991b1b;
    margin-bottom: 12px;
}

/* Payment Icons */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.payment-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: var(--bg);
    border-radius: 12px;
    border: 2px solid var(--border);
    transition: all 0.2s ease;
}

.payment-card:hover {
    border-color: var(--primary);
}

.payment-card.active {
    border-color: var(--primary);
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(129, 140, 248, 0.05) 100%);
}

.payment-icon {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
}

.payment-info h4 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--dark);
}

.payment-info p {
    font-size: 0.75rem;
    color: var(--gray);
}

/* Action Bar */
.action-bar {
    position: fixed;
    bottom: 0;
    left: 280px;
    right: 0;
    background: white;
    border-top: 1px solid var(--border);
    padding: 16px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 99;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
}

.action-bar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.action-bar-left i {
    color: var(--success);
}

.action-bar-left span {
    font-size: 0.85rem;
    color: var(--gray);
}

.action-bar-right {
    display: flex;
    gap: 12px;
}

/* Responsive - Large screens (1920x1080 and similar) */
@media (max-width: 1920px) {
    .settings-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 1001;
        width: 280px;
    }
    
    .settings-sidebar.open {
        transform: translateX(0);
    }
    
    .settings-main {
        margin-left: 0;
        padding: 24px 20px;
        width: 100%;
    }
    
    .action-bar {
        left: 0;
        width: 100%;
        padding: 16px 20px;
    }
    
    /* Mobile menu toggle button */
    .mobile-menu-btn {
        display: flex !important;
    }
    
    .settings-layout {
        position: relative;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .payment-methods {
        grid-template-columns: 1fr;
    }
}

/* Tablet */
@media (max-width: 992px) {
    .settings-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 1001;
        width: 280px;
    }
    
    .settings-sidebar.open {
        transform: translateX(0);
    }
    
    .settings-main {
        margin-left: 0;
        padding: 24px 20px;
        width: 100%;
    }
    
    .action-bar {
        left: 0;
        width: 100%;
        padding: 16px 20px;
    }
    
    /* Mobile menu toggle button */
    .mobile-menu-btn {
        display: flex !important;
    }
    
    .settings-layout {
        position: relative;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .payment-methods {
        grid-template-columns: 1fr;
    }
    
    .section-grid {
        grid-template-columns: 1fr;
    }
}

/* Sidebar overlay */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
}

.sidebar-overlay.active {
    display: block;
}

/* Mobile menu button */
.mobile-menu-btn {
    display: none;
    position: fixed;
    left: 16px;
    top: 16px;
    z-index: 1002;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border: none;
    background: var(--primary);
    border-radius: 10px;
    cursor: pointer;
    font-size: 1.2rem;
    color: white;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.mobile-menu-btn:hover {
    background: #4338ca;
    transform: scale(1.05);
}

.mobile-menu-btn.active {
    left: 296px;
}

@media (max-width: 1920px) {
    .mobile-menu-btn {
        display: flex;
    }
}
</style>

@section('content')

<div class="settings-layout">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn" title="Open Menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <aside class="settings-sidebar" id="settingsSidebar">
        <div class="sidebar-header">
            <a href="{{ url('admin/index') }}" class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="sidebar-logo-text">
                    <h3>MyShop</h3>
                    <span>Admin Panel</span>
                </div>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Main</div>
                <a href="#general" class="sidebar-link active" data-section="general">
                    <i class="fa-solid fa-gear"></i>
                    General
                </a>
                <a href="#appearance" class="sidebar-link" data-section="appearance">
                    <i class="fa-solid fa-palette"></i>
                    Appearance
                </a>
                <a href="#security" class="sidebar-link" data-section="security">
                    <i class="fa-solid fa-shield-halved"></i>
                    Security
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Management</div>
                <a href="#payment" class="sidebar-link" data-section="payment">
                    <i class="fa-solid fa-credit-card"></i>
                    Payment
                </a>
                <a href="#email" class="sidebar-link" data-section="email">
                    <i class="fa-solid fa-envelope"></i>
                    Email
                </a>
                <a href="#advanced" class="sidebar-link" data-section="advanced">
                    <i class="fa-solid fa-sliders"></i>
                    Advanced
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">System</div>
                <a href="#danger" class="sidebar-link" data-section="danger">
                    <i class="fa-solid fa-triangle-exclamation" style="color: var(--danger);"></i>
                    Danger Zone
                    <span class="badge">!</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="settings-main">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fa-solid fa-gear"></i> Settings</h1>
            <p>Manage your store settings and configuration</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-xmark"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- General Settings -->
        <section class="settings-section" id="section-general">
            <div class="section-header">
                <i class="fa-solid fa-gear"></i>
                <div>
                    <h2>General Settings</h2>
                    <p>Basic store information and configuration</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Site Name <span class="required">*</span></label>
                            <input type="text" class="form-input" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'My Shop') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Site Email <span class="required">*</span></label>
                            <input type="email" class="form-input" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? 'info@myshop.com') }}" required>
                        </div>
                    </div>
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-input" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}" placeholder="+20 1xx xxx xxxx">
                        </div>
                        <div class="form-group">
                            <label>Currency</label>
                            <select class="form-input" name="currency">
                                <option value="EGP" {{ ($settings['currency'] ?? '') === 'EGP' ? 'selected' : '' }}>EGP - Egyptian Pound</option>
                                <option value="USD" {{ ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                <option value="SAR" {{ ($settings['currency'] ?? '') === 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label>Shipping Cost (EGP)</label>
                            <input type="number" class="form-input" name="shipping_cost" value="{{ old('shipping_cost', $settings['shipping_cost'] ?? 50) }}">
                        </div>
                        <div class="form-group">
                            <label>Tax Rate (%)</label>
                            <input type="number" class="form-input" name="tax_rate" value="{{ old('tax_rate', $settings['tax_rate'] ?? 0) }}">
                        </div>
                    </div>
                    <div class="form-grid full" style="margin-top: 20px;">
                        <div class="form-group">
                            <label>Store Address</label>
                            <textarea class="form-input" name="site_address">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Appearance -->
        <section class="settings-section" id="section-appearance">
            <div class="section-header">
                <i class="fa-solid fa-palette"></i>
                <div>
                    <h2>Appearance</h2>
                    <p>Customize your store look and feel</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Primary Color</label>
                            <input type="color" class="form-input" name="primary_color" value="{{ $settings['primary_color'] ?? '#4f46e5' }}">
                        </div>
                        <div class="form-group">
                            <label>Logo Upload</label>
                            <input type="file" class="form-input" name="logo" accept="image/*">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Appearance
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Security -->
        <section class="settings-section" id="section-security">
            <div class="section-header">
                <i class="fa-solid fa-shield-halved"></i>
                <div>
                    <h2>Security Settings</h2>
                    <p>Protect your store and admin accounts</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="toggle-list">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Two-Factor Authentication</h4>
                                <p>Require 2FA for all admin accounts</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="two_factor_enabled" {{ ($settings['two_factor_enabled'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Login Attempt Limiting</h4>
                                <p>Block users after 5 failed login attempts</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="login_attempt_limit" {{ ($settings['login_attempt_limit'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Session Timeout</h4>
                                <p>Auto logout after 30 minutes of inactivity</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="session_timeout" {{ ($settings['session_timeout'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Strong Password Enforcement</h4>
                                <p>Require minimum 8 characters with numbers and symbols</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="strong_password" {{ ($settings['strong_password'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Security
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Payment -->
        <section class="settings-section" id="section-payment">
            <div class="section-header">
                <i class="fa-solid fa-credit-card"></i>
                <div>
                    <h2>Payment Settings</h2>
                    <p>Configure payment methods for your store</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="toggle-list">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Cash on Delivery (COD)</h4>
                                <p>Enable COD payment method</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="cod_enabled" {{ ($settings['cod_enabled'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Credit Card (Stripe)</h4>
                                <p>Enable Stripe card payments</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="card_enabled" {{ ($settings['card_enabled'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Vodafone Cash</h4>
                                <p>Enable Vodafone Cash for Egypt</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="vodafone_cash_enabled" {{ ($settings['vodafone_cash_enabled'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>PayPal</h4>
                                <p>Enable PayPal payments</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="paypal_enabled" {{ ($settings['paypal_enabled'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Payment
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Email -->
        <section class="settings-section" id="section-email">
            <div class="section-header">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h2>Email Settings</h2>
                    <p>Configure email notifications</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="toggle-list">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Order Confirmation Email</h4>
                                <p>Send email when order is placed</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="order_confirmation_email" {{ ($settings['order_confirmation_email'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Order Status Updates</h4>
                                <p>Notify customers on status changes</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="order_status_email" {{ ($settings['order_status_email'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Welcome Email</h4>
                                <p>Send welcome email to new customers</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="welcome_email" {{ ($settings['welcome_email'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Password Reset Email</h4>
                                <p>Allow password reset functionality</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="password_reset_email" {{ ($settings['password_reset_email'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-grid" style="margin-top: 24px;">
                        <div class="form-group">
                            <label>Email From Name</label>
                            <input type="text" class="form-input" name="email_from_name" value="{{ $settings['email_from_name'] ?? 'My Shop' }}">
                        </div>
                        <div class="form-group">
                            <label>Email From Address</label>
                            <input type="email" class="form-input" name="email_from_address" value="{{ $settings['email_from_address'] ?? 'noreply@myshop.com' }}">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Email Settings
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Advanced -->
        <section class="settings-section" id="section-advanced">
            <div class="section-header">
                <i class="fa-solid fa-sliders"></i>
                <div>
                    <h2>Advanced Settings</h2>
                    <p>Additional configuration options</p>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="toggle-list">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>User Registration</h4>
                                <p>Allow new customers to register</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="user_registration" {{ ($settings['user_registration'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Product Reviews</h4>
                                <p>Allow customers to leave reviews</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="reviews_enabled" {{ ($settings['reviews_enabled'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Video Section</h4>
                                <p>Enable video showcase section</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="video_section" {{ ($settings['video_section'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Multi-language Support</h4>
                                <p>Arabic & English language support</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="multi_language" {{ ($settings['multi_language'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Advanced
                        </button>
                    </div>
                </form>
                
                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border);">
                    <h4 style="font-size: 0.95rem; font-weight: 600; color: var(--dark); margin-bottom: 16px;">
                        <i class="fa-solid fa-bolt" style="color: var(--warning); margin-left: 8px;"></i>
                        Quick Actions
                    </h4>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <form method="POST" action="{{ route('admin.settings.clear-cache') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-broom"></i>
                                Clear Cache
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.settings.optimize') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline">
                                <i class="fa-solid fa-rocket"></i>
                                Optimize
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Danger Zone -->
        <section class="settings-section danger-zone" id="section-danger">
            <div class="section-header">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    <h2>Danger Zone</h2>
                    <p>Irreversible actions - proceed with caution</p>
                </div>
            </div>
            <div class="section-body">
                <div class="alert alert-error" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <strong>Warning:</strong> These actions are irreversible. Make sure you have a backup before proceeding.
                </div>
                
                <div class="danger-card">
                    <h4><i class="fa-solid fa-box-open"></i> Reset Products</h4>
                    <p>Delete all product data and start fresh. This will remove all products permanently.</p>
                    <form method="POST" action="{{ route('admin.settings.reset-products') }}" onsubmit="return confirm('Are you sure you want to reset all products? This cannot be undone!')">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash-can-arrow-up"></i>
                            Reset Products
                        </button>
                    </form>
                </div>
                
                <div class="danger-card">
                    <h4><i class="fa-solid fa-file-excel"></i> Clear Orders</h4>
                    <p>Delete all order history. Customers will lose their order records.</p>
                    <form method="POST" action="{{ route('admin.settings.clear-orders') }}" onsubmit="return confirm('Are you sure you want to clear all orders? This cannot be undone!')">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                            Clear Orders
                        </button>
                    </form>
                </div>
                
                <div class="danger-card">
                    <h4><i class="fa-solid fa-database"></i> Reset Everything</h4>
                    <p>Delete all data: products, orders, reviews, and more.</p>
                    <form method="POST" action="{{ route('admin.settings.reset-all') }}" onsubmit="return confirm('⚠️ DANGER! This will delete ALL data. Are you absolutely sure? This cannot be undone!')">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);">
                            <i class="fa-solid fa-fire"></i>
                            Reset Everything
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const sidebar = document.getElementById('settingsSidebar');
const overlay = document.getElementById('sidebarOverlay');

function openSidebar() {
    if (sidebar) sidebar.classList.add('open');
    if (overlay) overlay.classList.add('active');
    if (mobileMenuBtn) mobileMenuBtn.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    if (sidebar) sidebar.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    if (mobileMenuBtn) mobileMenuBtn.classList.remove('active');
    document.body.style.overflow = '';
}

if (mobileMenuBtn && sidebar && overlay) {
    mobileMenuBtn.addEventListener('click', openSidebar);
    overlay.addEventListener('click', closeSidebar);
}

// Sidebar Navigation
document.querySelectorAll('.sidebar-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Update active state
        document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        
        // Close sidebar on mobile
        if (window.innerWidth <= 1920) {
            closeSidebar();
        }
        
        // Scroll to section
        const sectionId = this.dataset.section;
        const section = document.getElementById('section-' + sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        
        // Update URL
        window.history.pushState(null, '', '#' + sectionId);
    });
});

// Handle hash on load
if (window.location.hash) {
    const sectionId = window.location.hash.substring(1);
    const link = document.querySelector(`.sidebar-link[data-section="${sectionId}"]`);
    if (link) {
        link.click();
    }
}
</script>

@endsection
