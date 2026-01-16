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

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('show.auth.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        return redirect()->route('show.products.index')->with('success', 'تم إتمام الطلب بنجاح ✅');
    }
}