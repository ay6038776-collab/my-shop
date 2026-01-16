<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BulkController extends Controller
{
    // عرض الصفحة الرئيسية للـ bulk
    public function index()
    {
        // هنعرض المنتجات مع checkboxes للحذف الجماعي
        $products = Product::all();
        return view('bulk', compact('products'));
    }

    // تنفيذ الحذف الجماعي
    public function destroy(Request $request)
    {
        $ids = $request->input('ids'); // ids اللي جايه من checkboxes

        if ($ids) {
            Product::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'تم حذف المنتجات المحددة ✅');
        }

        return redirect()->back()->with('error', 'من فضلك اختر منتجات للحذف ❌');
    }
}