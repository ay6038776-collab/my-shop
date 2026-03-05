@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-0" style="color: #2d3748;">Employees Directory</h2>
            <p class="text-muted small">Manage your team and operations</p>
        </div>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i> Add Employee
        </a>
    </div>

    @if($employees->isEmpty())
        <div class="text-center py-5 border rounded bg-light">
            <p class="text-muted">No employees found.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #edf2f7;">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small text-muted">Employee</th>
                            <th class="py-3 text-uppercase small text-muted">Daily Hours</th>
                            <th class="py-3 text-uppercase small text-muted">Roles</th>
                            <th class="px-4 py-3 text-end text-uppercase small text-muted">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width: 38px; height: 38px; font-size: 14px;">
                                        {{ substr($employee->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #2d3748;">{{ $employee->name }}</div>
                                        <div class="text-muted small">{{ $employee->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 fw-normal">
                                    <i class="far fa-clock me-1 text-primary"></i> {{ $employee->daily_hours }} hrs
                                </span>
                            </td>
                            <td>
                                @foreach($employee->roles as $role)
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light border" title="Edit"><i class="fas fa-edit text-primary"></i></button>
                                    <button class="btn btn-sm btn-light border" title="Delete"><i class="fas fa-trash text-danger"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<style>
    body { background-color: #f7fafc; }
    .table-hover tbody tr:hover { background-color: #fbfcfe !important; }
    .bg-info-subtle { background-color: #e0f7fa !important; }
    .text-info { color: #00bcd4 !important; }
</style>
@endsection