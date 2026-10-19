<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShowController extends Controller
{
    // الصفحة الرئيسية
    public function home()
    {
        // للشريط: كل المنتجات بدون فلتر
        $allProducts = Product::latest()->get();

        // للصفحة الرئيسية: آخر 8 أيام بس
        $products = Product::where('created_at', '>=', now()->subDays(8))
            ->latest()
            ->take(8)
            ->get();

        return view('show.home', compact('products', 'allProducts'));
    }

    // صفحة كل المنتجات
    public function products(Request $request)
    {
        $query = Product::query();

        // البحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // فلتر السعر - من
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // فلتر السعر - إلى
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // ترتيب
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);

        return view('show.products.index', compact('products'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = Product::query();

        // البحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // فلتر السعر - من
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // فلتر السعر - إلى
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // ترتيب
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->take(12)->get();

        $html = view('show.products.partials.products', compact('products'))->render();

        return response()->json(['html' => $html]);
    }

    public function index(Request $request)
    {
        $products = Product::paginate(9);
        if ($request->ajax()) {
            return view('products.list', compact('products'))->render();
        }
        return view('products.index', compact('products'));
    }

    // تفاصيل منتج
    public function details($id)
    {
        $product = Product::findOrFail($id);
        return view('show.products.details', compact('product'));
    }

    // صفحة الفيديوهات
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