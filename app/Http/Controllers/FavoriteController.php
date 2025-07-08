<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class FavoriteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $favorites = Product::join('favorites', 'products.id', '=', 'favorites.product_id')
            ->where('favorites.user_id', $userId)
            ->select('products.*')
            ->get();

        return view('user.favorites', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'Bạn cần đăng nhập để yêu thích sản phẩm'], 401);
        }

        $productId = $request->input('product_id');

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Removed from favorites']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            return response()->json(['message' => 'Added to favorites']);
        }
    }

}
