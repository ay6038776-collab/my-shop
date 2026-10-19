<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ];

        // Validation for avatar upload
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($rules);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($customer->avatar && Storage::exists('avatars/' . $customer->avatar)) {
                Storage::delete('avatars/' . $customer->avatar);
            }

            // Store new avatar
            $avatarName = $customer->id . '_avatar_' . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName, 'public');
            $customer->avatar = $avatarName;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        return back()->with('success', 'تم تحديث بياناتك بنجاح ✅');
    }
}