<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($locale)
    {
        $products = Product::paginate(10);
        $cart = $this->coutnItemsCart();
        return view('products.index', compact('products', 'cart'));
    }

    private function coutnItemsCart()
    {
        $user = Auth::user() ?? User::find(1);
        return Cart::where('user_id', $user->id)->count();
    }
}
