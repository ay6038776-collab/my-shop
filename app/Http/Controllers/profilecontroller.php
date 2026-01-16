<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // ✅ عرض صفحة البروفايل الخاصة بالعميل
    public function index()
    {
        $customer = Auth::guard('customer')->user(); // استخدم جارد العميل

        // لو مش داخل كـ عميل يرجعه لصفحة لوجن العميل
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'سجل دخولك أولاً 🧾');
        }

        return view('show.auth.profile', compact('customer'));
    }

    // ✅ تحديث بيانات العميل
  public function update(Request $request)
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'سجل دخولك أولًا 🧾');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email,' . $customer->id,
    ]);

    $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->save(); // ✅ هتشتغل دلوقتي من غير تحذير

    return back()->with('success', 'تم تحديث بياناتك بنجاح ✅');
}
}