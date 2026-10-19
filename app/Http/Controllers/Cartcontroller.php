<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // عرض السلة
    public function index()
    {
        $customerId = Auth::guard('customer')->id();
        if (!$customerId) {
            return redirect()->route('customer.login')
                             ->with('error', 'يرجى تسجيل الدخول أولاً 🧾');
        }

        $cartItems = Cart::where('customer_id', $customerId)
                         ->with('product')
                         ->get();

        foreach ($cartItems as $item) {
            $colorMap = [
                'أسود'  => 'black',
                'black' => 'black',
                'أبيض'  => 'white',
                'white' => 'white',
                'أحمر'  => 'red',
                'red'   => 'red',
                'أزرق'  => 'blue',
                'blue'  => 'blue',
                'أخضر'  => 'green',
                'green' => 'green',
                'أصفر'  => 'yellow',
                'yellow'=> 'yellow',
                'برتقالي'=> 'orange',
                'orange'=> 'orange',
                'بنفسجي'=> 'purple',
                'purple'=> 'purple',
                'وردي'  => 'pink',      
                'زهري' => 'pink',
                'رمادي' => 'gray',
                'gray'  => 'gray',
                'بني'  => 'brown',
                'brown' => 'brown',
                'كحلي' => 'navy',
                'navy'  => 'navy',
                'تركواز'=> 'turquoise',
                'turquoise'=> 'turquoise',
                'لافندر'=> 'lavender',
                'lavender'=> 'lavender',
                'زيتي' => 'olive',
                'olive' => 'olive',
                'فضي'  => 'silver',
                'silver'=> 'silver',
                'ذهبي' => 'gold',
                'gold'  => 'gold',
                'بيج'  => 'beige',
                'beige' => 'beige',
                'عنابي'=> 'maroon',
                'maroon'=> 'maroon',
                'كريمي'=> 'cream',
                'cream' => '#FFFDD0',
                'فيروزي'=> 'turquoise',
                'turquoise'=> 'turquoise',
                'نيلي' => 'indigo',
                'indigo'=> 'indigo',
                'كهرماني'=> 'amber',
                'amber' => '#FFBF00',
                
            ];
            $item->css_color = $colorMap[trim(strtolower($item->color ?? ''))] ?? 'transparent';
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);

        return view('show.auth.cart', compact('cartItems', 'subtotal'));
    }

    // إضافة منتج للسلة مع اللون
    public function add(Request $request, $id)
    {
        Log::info('Cart Add Request', [
            'product_id' => $id,
            'all_input' => $request->all(),
            'content_type' => $request->header('Content-Type'),
        ]);

        $customerId = Auth::guard('customer')->id();
        
        Log::info('Customer ID', ['customer_id' => $customerId]);
        
        if (!$customerId) {
            return response()->json([
                'error'=>'login_required',
                'message'=>'يرجى تسجيل الدخول أولاً'
            ], 401);
        }

        $product = Product::findOrFail($id);
        $finalPrice = $product->discounted_price;

        // Color from request
        $color = $request->input('color');
        
        Log::info('Color received', ['color' => $color]);
        
        if (empty($color)) {
            $color = 'N/A';
        }

        // Check if item already exists
        $cartItem = Cart::where('customer_id', $customerId)
                        ->where('product_id', $id)
                        ->where('color', $color)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            Log::info('Updated existing cart item', ['cart_item_id' => $cartItem->id, 'new_quantity' => $cartItem->quantity]);
        } else {
            Cart::create([
                'customer_id' => $customerId,
                'product_id'  => $id,
                'price'      => $finalPrice,
                'quantity'   => 1,
                'color'      => $color
            ]);
            Log::info('Created new cart item', ['product_id' => $id, 'color' => $color]);
        }

        $cartCount = Cart::where('customer_id', $customerId)->sum('quantity');

        return response()->json([
            'status'=>'success',
            'message'=>'✅ تم إضافة المنتج للسلة',
            'cart_count'=>$cartCount
        ]);
    }

    // تحديث الكمية
    public function update(Request $request, $id)
    {
        $customerId = Auth::guard('customer')->id();
        if (!$customerId) {
            return response()->json(['error'=>'login_required'], 401);
        }

        $cartItem = Cart::where('customer_id', $customerId)
                        ->where('id', $id)
                        ->firstOrFail();

        $quantity = (int) $request->quantity;
        if ($quantity <= 0) {
            $cartItem->delete();
        } else {
            $cartItem->update(['quantity'=>$quantity]);
        }

        $cartItems = Cart::where('customer_id', $customerId)->with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);

        return response()->json([
            'status'=>'success',
            'quantity'=>$quantity,
            'total_price'=>$cartItem->product->discounted_price * $quantity,
            'subtotal'=>$subtotal
        ]);
    }

    // حذف عنصر واحد
    public function remove($id)
    {
        $customerId = Auth::guard('customer')->id();
        if (!$customerId) {
            return response()->json(['error'=>'login_required'], 401);
        }

        Cart::where('customer_id', $customerId)
            ->where('id', $id)
            ->delete();

        $cartItems = Cart::where('customer_id', $customerId)->with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);

        return response()->json(['status'=>'success', 'subtotal'=>$subtotal]);
    }

    // مسح كل السلة أو العناصر المحددة
    public function clear(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        if (!$customerId) {
            return response()->json(['error'=>'login_required'], 401);
        }

        if ($request->has('item_ids')) {
            Cart::where('customer_id', $customerId)
                ->whereIn('id', $request->item_ids)
                ->delete();
        } else {
            Cart::where('customer_id', $customerId)->delete();
        }

        $cartItems = Cart::where('customer_id', $customerId)->with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->discounted_price * $item->quantity);

        return response()->json(['status'=>'success','subtotal'=>$subtotal]);
    }
}
