<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

        // الإشعارات الجديدة للـ Admin
     $notifications = $admin->unreadNotifications->filter(function($notification){
    return $notification->type == 'App\Notifications\OrderExpired'
        || $notification->type == 'App\Notifications\OrderCreated';
})->sortByDesc('created_at');
        // إرجاع البيانات للـ View
        return view('admin.index', compact('productsCount', 'totalValue', 'latestProducts', 'notifications'));
    }
}