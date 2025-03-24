<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function favorites() {
        $favorites = Auth::user()->favorites;
        return view('profile.favorites', ['products' => $favorites]);
    }

    public function toggleFavorite(Product $product) {
        $user = Auth::user();
        $user->favorites()->toggle($product->id);

        return back();
    }
}