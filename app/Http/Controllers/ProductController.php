<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // عرض المنتجات
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // صفحة الإضافة
    public function create()
    {
        return view('admin.add-product');
    }

    // حفظ منتج جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'price'                => 'required|numeric|min:0',
            'description'          => 'nullable|string',
            'stock'                => 'required|integer|min:0',
            'sku'                  => 'required|string|max:100',
            'img'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage'  => 'nullable|numeric|min:0|max:100',
        ]);

        // رفع الصورة
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $data['img'] = $imageName;
        }

        // قيمة افتراضية
        $data['is_new'] = 1;
        $data['discount_percentage'] = $request->input('discount_percentage', 0);

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', '✅ Product added successfully');
    }

    // صفحة التعديل
    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    // تحديث المنتج
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'price'                => 'required|numeric|min:0',
            'description'          => 'nullable|string',
            'stock'                => 'required|integer|min:0',
            'sku'                  => 'required|string|max:100|unique:products,sku,' . $product->id,
            'img'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage'  => 'nullable|numeric|min:0|max:100',
        ]);

        // رفع صورة جديدة لو موجودة
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $data['img'] = $imageName;
        }

        $data['discount_percentage'] = $request->input('discount_percentage', 0);

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', '✅ Product updated successfully');
    }

    // حذف منتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->orderItems()->exists()) {
            return back()->withErrors('❌ لا يمكن حذف المنتج لأنه مرتبط بطلبات');
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', '🗑 Product deleted successfully');
    }

    // حذف جماعي
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);

        $products = Product::whereIn('id', $request->ids)->get();

        foreach ($products as $product) {
            if ($product->orderItems()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => '❌ يوجد منتجات مرتبطة بطلبات'
                ]);
            }
        }

        Product::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => '✅ Products deleted successfully'
        ]);
    }
}