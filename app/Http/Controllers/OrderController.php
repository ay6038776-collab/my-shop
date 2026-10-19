<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    // عرض الطلبات للأدمن
    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // عرض الطلبات الخاصة بالعميل
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

    // تحميل الفاتورة PDF
    public function downloadInvoice($id)
    {
        $order = Order::with(['customer', 'items.product'])
            ->where('customer_id', Auth::guard('customer')->id())
            ->findOrFail($id);

        return $this->invoiceService->generateInvoice($order);
    }

    // حفظ الطلب من صفحة الـ Checkout
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
            return back()->with('error', 'السلة فارغة، أضف منتجات أولاً.');
        }

        // إنشاء الطلب الرئيسي
        $order = Order::create([
            'customer_id'  => $customerId,
            'order_number' => uniqid('ORD-'),
            'status'       => 'pending',
            'total_price'  => 0,
            'payment_method' => $request->payment_method,
        ]);

        $total = 0;

        // إنشاء عناصر الطلب مع حفظ اللون
        foreach ($cartItems as $item) {
            if ($item->product) {
                $linePrice = $item->product->price * $item->quantity;
                $total += $linePrice;

                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item->product->id,
                    'quantity'    => $item->quantity,
                    'price'       => $item->product->price,
                    'color'       => $item->color,
                ]);
            }
        }

        // تحديث إجمالي الطلب + الشحن
        $order->update([
            'total_price' => $total + 50,
        ]);

        // إشعار للأدمن بطلب جديد
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->notify(new \App\Notifications\OrderPlaced($order));
        }

        // مسح السلة بعد إنشاء الطلب
        Cart::where('customer_id', $customerId)->delete();

        return redirect()->route('customer.orders')
            ->with('success', 'تم تأكيد الطلب بنجاح!');
    }

   public function approve($id)
{
    $order = Order::with('items.product')->findOrFail($id);

    DB::transaction(function () use ($order) {

        $order->refresh();

        if ($order->status !== 'pending') {
            abort(403, 'الطلب تم التعامل معه من قبل');
        }

        foreach ($order->items as $item) {

            if (!$item->product) {
                throw new \Exception('المنتج غير موجود');
            }

            if ($item->product->stock < $item->quantity) {
                throw new \Exception(
                    'الكمية غير متوفرة للمنتج: ' . $item->product->name
                );
            }
        }

        foreach ($order->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }

        $order->update([
            'status' => 'approved',
            'timer_active' => 0,
            'expires_at' => null
        ]);
    });

        // إشعار بالقبول
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->notify(new \App\Notifications\OrderApproved($order));
        }

        return back()->with('success', 'تم اعتماد الطلب بنجاح');
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

        // إشعار بالرفض
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->notify(new \App\Notifications\OrderRejected($order));
        }

        return back()->with('info', 'تم رفض الطلب');
    }
}
