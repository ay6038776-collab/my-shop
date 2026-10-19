<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Notifications\NewCustomer;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        // لو مسجل دخول بالفعل، روحه لل products
        if (Auth::guard('customer')->check()) {
            return redirect('/products');
        }
        return view('show.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/products')
                ->with('success', 'تم تسجيل الدخول بنجاح ✅');
        }

        return back()->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة.')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login')
            ->with('success', 'تم تسجيل الخروج بنجاح ✅');
    }

    public function showRegisterForm()
    {
        return view('show.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // إشعار الأدمن المسجل دخوله بعميل جديد
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->notify(new NewCustomer($customer));
        }

        Auth::guard('customer')->login($customer);

        return redirect('/products')
            ->with('success', 'تم إنشاء الحساب وتسجيل الدخول ✅');
    }
}