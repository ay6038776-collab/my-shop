<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // عرض كل العملاء
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    // عرض صفحة إضافة عميل جديد
    public function create()
    {
        return view('customer.create');
    }

    // حفظ العميل الجديد في الداتابيز
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6'
        ]);

        Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer added successfully!');
    }

    // عرض صفحة تعديل بيانات عميل
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    // تحديث بيانات العميل
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully!');
    }

    // حذف العميل
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully!');
    }
}