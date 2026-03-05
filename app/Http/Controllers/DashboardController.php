<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User; // لموظفين أو المدراء
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // عدد المنتجات
        $productsCount = Product::count();

        // إجمالي الأسعار
        $totalValue = Product::sum('price');

        // أحدث المنتجات (آخر 300 منتج)
        $latestProducts = Product::orderBy('created_at', 'desc')->take(300)->get();

        // عدد الموظفين
        $employeesCount = User::count(); // لو الموظفين مخزنين في جدول users

        // قائمة الموظفين (أسمائهم، إيميل، أدوارهم، ساعات العمل)
        $employees = User::with('roles')->get(); // تأكد إن عندك علاقة roles لو في system صلاحيات

        // الإشعارات الجديدة للـ Admin
        $notifications = $admin->unreadNotifications->filter(function($notification){
            return $notification->type == 'App\Notifications\OrderExpired'
                || $notification->type == 'App\Notifications\OrderCreated';
        })->sortByDesc('created_at');

        // إرجاع البيانات للـ View
        return view('admin.index', compact(
            'productsCount',
            'totalValue',
            'latestProducts',
            'notifications',
            'employeesCount',
            'employees'
        ));
    }
}