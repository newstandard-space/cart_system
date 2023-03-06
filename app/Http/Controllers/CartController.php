<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function addCart(Request $request)
    {
        $request->validate([
            'item_id' => ['required', 'numeric', 'digits_between:1,20'],
            'color' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255' ],
        ]);

        // すでにカートに商品があるか
        $cart = Cart::where('user_id', Auth::id())->where('item_id', $request->item_id)->where('color', $request->color)->where('size', $request->size)->first();

        if ($cart != null) {
            // 数量足す
            $cart->amount = $cart->amount + 1;
            $cart->update();
        } else {
            // 商品投入
            $product = Product::where('item_id', $request->item_id)->where('color', $request->color)->where('size', $request->size)->first();

            Cart::create([
                'user_id' => Auth::id(),
                'item_id' => $request->item_id,
                'product_id' => $product['id'],
                'color' => $request->color,
                'size' => $request->size,
                'amount' => 1
            ]);
        }

        return ;
    }

    public function getCartInfo()
    {
        $cart = DB::select("SELECT items.id, items.name, items.description, items.price, carts.color, carts.size, carts.amount, carts.product_id, images.path FROM `carts` JOIN users ON carts.user_id = users.id JOIN items ON carts.item_id = items.id JOIN (SELECT item_id, color, GROUP_CONCAT(path) as path FROM item_images GROUP BY item_id, color) AS images ON carts.item_id = images.item_id AND carts.color = images.color WHERE users.id = ? ORDER BY items.id", [Auth::id()]);

        return ['cart' => $cart];
    }

    public function deleteCartItem(Request $request)
    {
        Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();

        return redirect()->route('cart');
    }

    public function countCartItem()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        $counter = 0;
        $cart->each(function($obj) use(&$counter) {
            $counter += $obj['amount'];
        });
        return ['count' => $counter];
    }
}
