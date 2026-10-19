@extends('layouts.app')
@section('title', 'Employees - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - MyShop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
:root {
    --primary: #4f46e5;
    --primary-dark: #3730a3;
    --success: #10b981;
    --success-dark: #059669;
    --warning: #f59e0b;
    --warning-dark: #d97706;
    --danger: #ef4444;
    --danger-dark: #dc2626;
    --info: #3b82f6;
    --dark: #1e293b;
    --darker: #0f172a;
    --gray: #64748b;
    --gray-light: #94a3b8;
    --light-gray: #e2e8f0;
    --bg: #f1f5f9;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg);
    color: var(--dark);
    min-height: 100vh;
}

/* Topbar */
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
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.brand h2 {
    font-size: 1.2rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary), #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.topbar-actions {
    display: flex;
    gap: 12px;
    align-items: center;
}

/* Buttons */
.btn {
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
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
    background: linear-gradient(135deg, var(--success), var(--success-dark));
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger), var(--danger-dark));
    color: white;
}

.btn-sm {
    padding: 7px 14px;
    font-size: 0.8rem;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--light-gray);
    color: var(--dark);
}

.btn-outline:hover {
    background: var(--bg);
}

.back-btn {
    padding: 8px 18px;
    border-radius: 10px;
    background: var(--bg);
    border: 1px solid var(--light-gray);
    color: var(--dark);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateX(-3px);
}

/* Admin Profile */
.admin-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.admin-profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.admin-profile span {
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--dark);
}

/* Main Content */
.main {
    padding: 25px 30px;
    max-width: 1400px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-header h1 {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--darker);
}

.page-header p {
    color: var(--gray);
    font-size: 0.9rem;
    margin-top: 4px;
}

/* Alerts */
.alert {
    padding: 14px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #065f46;
}

.alert-danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #991b1b;
}

/* Role Cards */
.roles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.role-card {
    background: var(--white);
    border-radius: 16px;
    padding: 22px;
    border: 1px solid var(--light-gray);
    transition: all 0.3s ease;
}

.role-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.role-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.role-card-header i {
    font-size: 1.5rem;
}

.role-card-header strong {
    font-size: 1.1rem;
}

.role-owner .role-card-header i,
.role-owner .role-card-header strong {
    color: #6366f1;
}

.role-supervisor .role-card-header i,
.role-supervisor .role-card-header strong {
    color: #0891b2;
}

.role-employee .role-card-header i,
.role-employee .role-card-header strong {
    color: #78716c;
}

.role-card p {
    font-size: 0.82rem;
    color: var(--gray);
    margin-bottom: 12px;
}

.role-permissions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.role-permissions span {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.72rem;
    font-weight: 600;
}

.role-owner .role-permissions span {
    background: #f5f3ff;
    color: #6366f1;
}

.role-supervisor .role-permissions span {
    background: #f0fdfa;
    color: #0891b2;
}

.role-employee .role-permissions span {
    background: #fafaf9;
    color: #78716c;
}

/* Panel */
.panel {
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    overflow: hidden;
    border: 1px solid var(--light-gray);
}

.panel-head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
}

.panel-head h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--darker);
}

.panel-head h3 i {
    color: var(--primary);
    margin-right: 10px;
}

/* Table */
.table-wrap {
    width: 100%;
    border-collapse: collapse;
}

.table-wrap thead th {
    padding: 14px 20px;
    text-align: left;
    font-size: 0.75rem;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 600;
    background: var(--bg);
}

.table-wrap tbody td {
    padding: 16px 20px;
    font-size: 0.9rem;
    border-top: 1px solid var(--light-gray);
    vertical-align: middle;
}

.table-wrap tbody tr {
    transition: all 0.2s ease;
}

.table-wrap tbody tr:hover {
    background: #f8fafc;
}

/* Employee Row */
.emp-row {
    display: flex;
    align-items: center;
    gap: 14px;
}

.emp-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    object-fit: cover;
    border: 2px solid var(--light-gray);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.emp-name {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--darker);
}

.emp-email {
    font-size: 0.8rem;
    color: var(--gray);
}

/* Role Badge */
.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 25px;
    font-size: 0.78rem;
    font-weight: 600;
    gap: 6px;
}

.role-badge i {
    font-size: 0.7rem;
}

.role-owner {
    background: #f5f3ff;
    color: #6366f1;
}

.role-supervisor {
    background: #f0fdfa;
    color: #0891b2;
}

.role-employee {
    background: #fafaf9;
    color: #78716c;
}

.role-default {
    background: #f1f5f9;
    color: #64748b;
}

/* Status */
.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.status-active {
    background: #10b981;
}

.status-inactive {
    background: #94a3b8;
}

/* Action Buttons */
.action-btns {
    display: flex;
    gap: 8px;
}

.icon-btn-sm {
    padding: 8px 12px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.icon-btn-sm.edit {
    background: #e0e7ff;
    color: #4338ca;
}

.icon-btn-sm.edit:hover {
    background: #4338ca;
    color: white;
    transform: translateY(-2px);
}

.icon-btn-sm.delete {
    background: #fee2e2;
    color: #dc2626;
}

.icon-btn-sm.delete:hover {
    background: #dc2626;
    color: white;
    transform: translateY(-2px);
}

.icon-btn-sm.toggle {
    background: #dbeafe;
    color: #1e40af;
}

.icon-btn-sm.toggle:hover {
    background: #1e40af;
    color: white;
    transform: translateY(-2px);
}

/* Modal */
.add-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.7);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.modal-content {
    background: var(--white);
    border-radius: 20px;
    width: 520px;
    max-width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-head {
    padding: 20px 24px;
    border-bottom: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-head h3 {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--darker);
}

.modal-head h3 i {
    color: var(--primary);
    margin-right: 10px;
}

.modal-close {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: none;
    background: var(--bg);
    cursor: pointer;
    font-size: 1.2rem;
    color: var(--gray);
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: var(--danger);
    color: white;
}

.modal-body {
    padding: 24px;
}

/* Form */
.form-group {
    margin-bottom: 18px;
}

.form-label {
    display: block;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--light-gray);
    border-radius: 10px;
    font-size: 0.92rem;
    font-family: 'Poppins';
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    justify-content: flex-end;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 50px 20px;
}

.empty-state i {
    font-size: 4rem;
    color: var(--light-gray);
    margin-bottom: 15px;
}

.empty-state p {
    color: var(--gray);
    font-size: 0.95rem;
}

/* Responsive */
@media (max-width: 900px) {
    .table-wrap .hide-col {
        display: none;
    }
    
    .topbar {
        padding: 12px 15px;
        flex-direction: column;
        gap: 12px;
    }
    
    .main {
        padding: 15px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .roles-grid {
        grid-template-columns: 1fr;
    }
}
</style>

@section('content')
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="MyShop">
        <h2>MyShop Admin</h2>
    </div>
    <div class="topbar-actions">
        <a href="{{ url('admin/index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left me-2"></i> Dashboard
        </a>
        <div class="admin-profile">
        @php
$user = Auth::guard('admin')->user();

$adminImage = $user && $user->avatar
    ? asset('img/' . $user->avatar)
    : asset('img/33.jpg');
@endphp
           <img src="{{ $adminImage }}" alt="Admin">
<span>{{ $user?->name ?? 'Admin' }}</span>
        </div>
    </div>
</div>

<div class="main">
    <div class="page-header">
        <div>
            <h1><i class="fa-solid fa-users me-2" style="color: var(--primary);"></i> Employees & Roles</h1>
            <p>Manage your team members and their access permissions</p>
        </div>
        <button class="btn btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i> Add Employee
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Role Permissions Info -->
    <div class="roles-grid">
        <div class="role-card role-owner">
            <div class="role-card-header">
                <i class="fa-solid fa-crown"></i>
                <strong>Owner</strong>
            </div>
            <p>Full access - All permissions + User management</p>
            <div class="role-permissions">
                <span><i class="fa-solid fa-check me-1"></i> All</span>
            </div>
        </div>
        <div class="role-card role-supervisor">
            <div class="role-card-header">
                <i class="fa-solid fa-user-shield"></i>
                <strong>Supervisor</strong>
            </div>
            <p>Moderate access - Products, Orders, Reports</p>
            <div class="role-permissions">
                <span>Products</span>
                <span>Orders</span>
                <span>Reports</span>
            </div>
        </div>
        <div class="role-card role-employee">
            <div class="role-card-header">
                <i class="fa-solid fa-user"></i>
                <strong>Employee</strong>
            </div>
            <p>Limited access - View & Update Orders</p>
            <div class="role-permissions">
                <span>View</span>
                <span>Update</span>
            </div>
        </div>
    </div>

    <!-- Employees Table -->
    <div class="panel">
        <div class="panel-head">
            <h3><i class="fa-solid fa-users"></i> Team Members ({{ $employees->count() }})</h3>
            <span style="font-size: 0.85rem; color: var(--gray);">{{ $employees->filter(fn($e) => $e->is_active)->count() }} Active</span>
        </div>
        
        @if($employees->count() > 0)
            <table class="table-wrap">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th class="hide-col">Role</th>
                        <th class="hide-col">Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                        <tr>
                            <td>
                                <div class="emp-row">
                                  @php
$empAvatar = $emp->avatar
    ? asset('img/' . $emp->avatar)
    : asset('img/33.jpg');
@endphp
                                    <img src="{{ $empAvatar }}" alt="{{ $emp->name }}" class="emp-avatar">
                                    <div>
                                        <div class="emp-name">{{ $emp->name }}</div>
                                        <div class="emp-email">{{ $emp->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="hide-col">
                                @php
                                    $roleName = strtolower($emp->roleName ?? 'employee');
                                @endphp
                                <span class="role-badge role-{{ $roleName }}">
                                    <i class="fa-solid fa-{{ $emp->isOwner() ? 'crown' : ($emp->isSupervisor() ? 'user-shield' : 'user') }}"></i>
                                    {{ ucfirst($emp->roleName ?? 'Employee') }}
                                </span>
                            </td>
                            <td class="hide-col">{{ $emp->phone ?? 'N/A' }}</td>
                            <td>
                                <span style="display:flex; align-items:center; gap:8px;">
                                    <span class="status-dot status-{{ $emp->is_active ? 'active' : 'inactive' }}"></span>
                                    {{ $emp->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.employees.edit', $emp->id) }}" class="icon-btn-sm edit" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @if(!$emp->isOwner())
                                        <form method="POST" action="{{ route('admin.employees.toggle', $emp->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="icon-btn-sm toggle" title="{{ $emp->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fa-solid fa-{{ $emp->is_active ? 'ban' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.employees.destroy', $emp->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn-sm delete" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-users-slash"></i>
                <p>No employees found. Add your first team member!</p>
            </div>
        @endif
    </div>
</div>

<!-- Add Employee Modal -->
<div id="addModal" class="add-modal">
    <div class="modal-content">
        <div class="modal-head">
            <h3><i class="fa-solid fa-user-plus"></i> Add New Employee</h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-user me-2"></i>Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter employee name" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-lock me-2"></i>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password (min 6 chars)" minlength="6" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-phone me-2"></i>Phone (optional)</label>
                    <input type="text" class="form-control" name="phone" placeholder="+20 1xx xxx xxxx">
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-id-badge me-2"></i>Role</label>
                    <select class="form-control" name="role_id" required>
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }} - {{ $role->description ?? 'No description' }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-image me-2"></i>Avatar (optional)</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*">
                    <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">
                        <i class="fa-solid fa-xmark me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>Add Employee
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('addModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('addModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('addModal');
    if (e.target === modal) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

@endsection
