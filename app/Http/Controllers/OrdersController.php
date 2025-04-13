<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function checkout()
    {
        return view('orders.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'voornaam' => 'required|string',
            'achternaam' => 'required|string',
            'straat' => 'required|string',
            'huisnummer' => 'required|string',
            'postcode' => 'required|string',
            'woonplaats' => 'required|string',
        ]);

        $user = Auth::user();

        $order = $user->orders()->create([
            'voornaam' => $request->input('voornaam'),
            'achternaam' => $request->input('achternaam'),
            'straat' => $request->input('straat'),
            'huisnummer' => $request->input('huisnummer'),
            'postcode' => $request->input('postcode'),
            'woonplaats' => $request->input('woonplaats'),
        ]);

        $cartProducts = $user->cart;


        foreach ($cartProducts as $product) {
            $order->products()->attach($product->id, [
                'quantity' => $product->pivot->quantity,
                'size' => $product->pivot->size,
            ]);

            $user->cart()->detach($product->id);
        }


        return redirect()->route('orders.show', $order);
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('products')->get();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        if (Gate::denies('view-order', $order)) {
            abort(403, 'Unauthorized action.');
        }

        $products = $order->products;

        return view('orders.show', [
            'order' => $order,
            'products' => $products
        ]);
    }
}
