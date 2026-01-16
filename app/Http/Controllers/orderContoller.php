<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // عرض تفاصيل الطلب
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('show.orders.show', compact('order'));
    }

    // باقي الفانكشنات (مثلاً index, store) تضيفها بعدين حسب احتياجك

       // عرض جميع الطلبات
    public function index()
    {
        $orders = Order::with('items.product')->get();
        return view('show.orders.index', compact('orders'));
    }

    // إنشاء طلب جديد
    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return redirect()->route('orders.show', $order->id);
    }

    
}