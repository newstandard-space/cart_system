<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\User;
use App\Models\UserAddress;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = DB::select("SELECT items.id, items.name, items.description, items.price, carts.color, carts.size, carts.amount, carts.product_id, images.path FROM `carts` JOIN users ON carts.user_id = users.id JOIN items ON carts.item_id = items.id JOIN (SELECT item_id, color, GROUP_CONCAT(path) as path FROM item_images GROUP BY item_id, color) AS images ON carts.item_id = images.item_id AND carts.color = images.color WHERE users.id = ? ORDER BY items.id", [Auth::id()]);

        if (empty($cart)) {
            return redirect('/');
        }
        $subtotal = 0;
        foreach($cart as $cart_item) {
            $subtotal += $cart_item->price * $cart_item->amount;
        }

        $user_address = UserAddress::where('user_id', Auth::id())->first();

        $user = Auth::user();

        return view('checkout.index', compact('user', 'subtotal', 'cart', 'user_address'));
    }

    public function create(Request $request)
    {
        dd($request);
    }
}
