<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShowController extends Controller
{
    // الصفحة الرئيسية
    public function home()
    {
        $products = Product::where('created_at','>=', now()->subDays(8) )
        ->latest()
        ->take(8)
          ->get();
    
        return view('show.home', compact('products'));
    }

    // صفحة كل المنتجات
       // كل المنتجات
  public function products(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
    }

    $products = $query->paginate(12);

    return view('show.products.index', compact('products'));
}


public function ajaxSearch(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
    }

    $products = $query->take(12)->get(); // نجيب 12 منتج فقط للعرض السريع

    $html = view('show.products.partials.products', compact('products'))->render();

    return response()->json(['html' => $html]);
}

public function index(Request $request){
 

$products = product::padinate(9);
if ($request->ajax()){
    return view('products.list' , compact('products'))->render();
}
   return view ('products.index ',compact('products'));
}

    // تفاصيل منتج
    public function details($id)
    {
        $product = Product::findOrFail($id);
        return view('show.products.details', compact('product'));
}


    // صفحة الفيديوهات (ممكن تعدلها حسب الموديل بتاعك)
    public function videos()
    {
        return view('show.videos.index');
    }

    // صفحة من نحن
    public function about()
    {
        return view('show.aboutus');
    }

    
   
}