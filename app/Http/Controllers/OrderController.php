<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // 🔹 عرض الطلبات للأدمن
    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 🔹 عرض الطلبات الخاصة بالعميل (بنفس نظام الكارت)
    public function myOrders()
    {
        $customerId = Auth::guard('customer')->id();

        if (!$customerId) {
            return redirect()->route('customer.login')
                ->with('error', 'يرجى تسجيل الدخول أولاً');
        }

        $orders = Order::with(['items.product'])
            ->where('customer_id', $customerId)
            ->latest()
            ->get();

        return view('show.orders.index', compact('orders'));
    }

    // 🔹 حفظ الطلب من صفحة الـ Checkout (بنفس نظام الكارت)
    public function store(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        if (!$customerId) {
            return redirect()->route('customer.login')
                ->with('error', 'يرجى تسجيل الدخول لإتمام الطلب');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::where('customer_id', $customerId)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', '🛒 السلة فارغة، أضف منتجات أولاً.');
        }

        // 🟩 إنشاء الطلب الرئيسي
        $order = Order::create([
            'customer_id'  => $customerId,
            'order_number' => uniqid('ORD-'),
            'status'       => 'pending',
            'total_price'  => 0,
        ]);

        $total = 0;

        // 🟩 إنشاء عناصر الطلب مع حفظ اللون
        foreach ($cartItems as $item) {
            if ($item->product) {
                $linePrice = $item->product->price * $item->quantity;
                $total += $linePrice;

                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item->product->id,
                    'quantity'    => $item->quantity,
                    'price'       => $item->product->price,
                    'color'       => $item->color, // اللون هنا
                ]);
            }
        }

        // 🟢 تحديث إجمالي الطلب
        $order->update([
            'total_price' => $total,
        ]);

        // 🗑 مسح السلة بعد إنشاء الطلب
        Cart::where('customer_id', $customerId)->delete();

        return redirect()->route('customer.orders')
            ->with('success', '✅ تم تأكيد الطلب بنجاح!');
    }

    public function approve($id)
    {
        DB::transaction(function () use ($id) {

            $order = Order::with('items.product')
                ->lockForUpdate()
                ->findOrFail($id);

            // منع التكرار
            if ($order->status !== 'pending') {
                abort(403, '❌ الطلب تم التعامل معه من قبل');
            }

            // التحقق من المخزون
            foreach ($order->items as $item) {
                if (!$item->product) {
                    throw new \Exception('❌ المنتج غير موجود');
                }

                if ($item->product->stock < $item->quantity) {
                    throw new \Exception(
                        '❌ الكمية غير متوفرة للمنتج: ' . $item->product->name
                    );
                }
            }

            // خصم المخزون
            foreach ($order->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            // تحديث حالة الطلب + إيقاف العداد
            $order->update([
                'status' => 'approved',
                'timer_active' => 0,
                'expires_at' => null
            ]);
        });

        return back()->with('success', '✅ تم اعتماد الطلب وخصم المخزون وإيقاف العداد بنجاح');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'pending') {
            abort(403);
        }

        $order->update([
            'status' => 'rejected',
            'timer_active' => 0,
            'expires_at' => null
        ]);

        return back()->with('info', '❌ تم رفض الطلب وإيقاف العداد');
    }
}