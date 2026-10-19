<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('roles')->get();
        $roles = Role::all();
        return view('admin.employees.index', compact('employees', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.employees.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'password', 'phone']);
        $data['password'] = Hash::make($request->password);

       // Handle avatar upload
if ($request->hasFile('avatar')) {
    $file = $request->file('avatar');
    $fileName = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('img'), $fileName);

    $data['avatar'] = $fileName;
}

        $employee = Employee::create($data);

        // Assign role
        $employee->roles()->attach($request->role_id);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = Role::all();
        return view('admin.employees.edit', compact('employee', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // DEBUG: Check if file is received
        \Log::info('UPDATE REQUEST', [
            'has_file' => $request->hasFile('avatar'),
            'all_files' => $request->allFiles(),
            'input' => $request->all(),
        ]);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'boolean',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'is_active']);

        // Update password if provided
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle avatar upload
       if ($request->hasFile('avatar')) {

    if ($employee->avatar && file_exists(public_path('img/' . $employee->avatar))) {
        unlink(public_path('img/' . $employee->avatar));
    }

    $file = $request->file('avatar');
    $fileName = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('img'), $fileName);

    $data['avatar'] = $fileName;
}

        $employee->update($data);

        // Update role
        $employee->roles()->sync([$request->role_id]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Prevent deleting owner
        if ($employee->isOwner()) {
            return redirect()->route('admin.employees.index')
                ->with('error', 'Cannot delete the owner account!');
        }

        // Delete avatar
       if ($employee->avatar && file_exists(public_path('img/' . $employee->avatar))) {
    unlink(public_path('img/' . $employee->avatar));
}
        $employee->roles()->detach();
        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $employee = Employee::findOrFail($id);

        // Prevent deactivating owner
        if ($employee->isOwner()) {
            return redirect()->route('admin.employees.index')
                ->with('error', 'Cannot deactivate owner account!');
        }

        $employee->update(['is_active' => !$employee->is_active]);

        $status = $employee->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.employees.index')
            ->with('success', "Employee $status successfully!");
    }
}
