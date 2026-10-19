<?php

namespace App\Http\Controllers;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->guard('customer')->id(),
                'product_id' => $id
            ],
            [
                'rating' => $request->rating
            ]
        );

        // Get updated average
        $product = Product::findOrFail($id);
        $average = $product->averageRating();

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة تقييمك ⭐',
            'average' => $average
        ]);
    }
}
