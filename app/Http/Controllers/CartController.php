<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function index($locale)
    {
        $user = Auth::user() ?? User::find(1);
        $cartItems = Cart::where('user_id', $user->id)->get();
        $this->itemPrice($cartItems);
        $totalPrice = $this->totalPrice($cartItems);

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    private function itemPrice($carts)
    {
        foreach ($carts as $item) {
            $item->price = number_format($item->quantity * $item->product->price, 2, '.', ',');
        }
    }

    private function totalPrice($carts)
    {
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->quantity * $item->product->price;
        }

        return number_format($total, 2, '.', ',');
    }

    public function add(Request $request, $locale, Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:100']);
        $quantity = $request->input('quantity');

        $user = Auth::user() ?? User::find(1);

        $cartItem = Cart::firstOrCreate([
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        if ($cartItem->wasRecentlyCreated) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        } else {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        }

        return back()->with('success', __('Product added to cart'));
    }

    public function update(Request $request, $locale, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', __('Cart updated successfully'));
    }

    public function remove($locale, Cart $cart)
    {
        if (!$cart) {
            return back()->with('error', __('Cart item not found'));
        }

        $cart->delete();

        $user = Auth::user() ?? User::find(1);
        $cartCount = Cart::where('user_id', $user->id)->count();

        if ($cartCount === 0) {
            return Redirect::route('products.index')->with('success', __('Cart is empty'));
        }

        return back()->with('success', __('Product removed from cart'));
    }
}
