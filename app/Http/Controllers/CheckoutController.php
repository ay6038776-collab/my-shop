<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
{
    $customerId = Auth::guard('customer')->id();

    $cartItems = Cart::where('customer_id', $customerId)
        ->with('product')
        ->get();

    $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

    $shipping = 50; // قيمة الشحن (غيرها زي ما تحب)

    $total = $subtotal + $shipping;

    return view('show.auth.checkout', compact(
        'cartItems',
        'subtotal',
        'shipping',
        'total'
    ));
}
    public function store(Request $request)
    {
        return redirect()->route('show.products.index')->with('success', 'تم إتمام الطلب بنجاح ✅');
    }
}