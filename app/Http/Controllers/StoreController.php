<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('store.index', [
            'products' => $products
        ]);
    }

    public function show(Product $product) {
        $related = Product::where('id', "!=", $product->id)->inRandomOrder()->take(4)->get();
        return view('store.show', [
            'product' => $product,
            'related' => $related
        ]);
    }
}
