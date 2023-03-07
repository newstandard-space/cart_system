<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPurchaserAddress;
use App\Models\OrderShippingAddress;
use App\Models\ItemStock;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = DB::select("SELECT items.id, items.name, items.description, items.price, carts.color, carts.size, carts.amount, carts.product_id, images.path FROM `carts` JOIN users ON carts.user_id = users.id JOIN items ON carts.item_id = items.id JOIN (SELECT item_id, color, GROUP_CONCAT(path) as path FROM item_images GROUP BY item_id, color) AS images ON carts.item_id = images.item_id AND carts.color = images.color WHERE users.id = ? ORDER BY items.id", [Auth::id()]);

        if (empty($cart)) {
            return redirect('/');
        }
        $subtotal = 0;
        foreach ($cart as $cart_item) {
            $subtotal += ($cart_item->price * $cart_item->amount) * 1.1;
        }

        $user_address = UserAddress::where('user_id', Auth::id())->first();

        $user = Auth::user();

        return view('checkout.index', compact('user', 'subtotal', 'cart', 'user_address'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'shipping_address_type' => ['required', 'string', 'regex:/^[12]/'],
            'payment_method_type' => ['required', 'string', 'regex:/^[12]/'],
            'delivery_date' => ['string'],
        ]);

        $orderer_address = UserAddress::where('user_id', Auth::id())->first();

        $cart = DB::select("SELECT items.id, items.name, items.description, items.price, carts.item_id, carts.color, carts.size, carts.amount, carts.product_id, images.path FROM `carts` JOIN users ON carts.user_id = users.id JOIN items ON carts.item_id = items.id JOIN (SELECT item_id, color, GROUP_CONCAT(path) as path FROM item_images GROUP BY item_id, color) AS images ON carts.item_id = images.item_id AND carts.color = images.color WHERE users.id = ? ORDER BY items.id", [Auth::id()]);

        $user = Auth::user();

        $total_price = 0;
        foreach ($cart as $cart_item) {
            $total_price += ($cart_item->price * $cart_item->amount) * 1.1;
        }

        $order = Order::create([
            'order_custom_id' => $this->makeRandomStr(),
            'user_id' => Auth::id(),
            'payment_method_id' => $request->payment_method_type,
            'total_price' => $total_price,
            'shipping_fee' => 0,
            'handling_fee' => 0,
        ]);

        foreach ($cart as $cart_item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'item_id' => $cart_item->item_id,
                'product_id' => $cart_item->product_id,
                'original_quantity' => $cart_item->amount,
                'quantity' => $cart_item->amount,
                'total_price' => ($cart_item->price * $cart_item->amount) * 1.1,
                'price_per_item' => $cart_item->price,
                'consumption_tax_per_item' => $cart_item->price * 1.1,
            ]);

            $item_stock = ItemStock::where('product_id', $cart_item->product_id)->first();
            $item_stock->quantity = $item_stock->quantity - $cart_item->amount;
            $item_stock->update();
        }

        OrderPurchaserAddress::create([
            'order_id' => $order->id,
            'name' => $user->name,
            'name_kana' => $user->name_kana,
            'postal_code' => $orderer_address->postal_code,
            'address_1' => $orderer_address->address_1,
            'address_2' => $orderer_address->address_2,
            'phone_number' => $user->phone_number,
            'email_address' => $user->email,
        ]);

        OrderShippingAddress::create([
            'order_id' => $order->id,
            'name' => $user->name,
            'name_kana' => $user->name_kana,
            'postal_code' => $orderer_address->postal_code,
            'address_1' => $orderer_address->address_1,
            'address_2' => $orderer_address->address_2,
            'phone_number' => $user->phone_number,
            'email_address' => $user->email,
        ]);

        Cart::where('user_id', Auth::id())->delete();

        $request->session()->put('cart', $cart);
        $request->session()->put('order_custom_id', $order['order_custom_id']);

        return redirect()->route('checkout.complete');

    }

    public function complete(Request $request)
    {
        $cart = $request->session()->get('cart');
        $order_custom_id = $request->session()->get('order_custom_id');

        $request->session()->forget('cart');
        $request->session()->forget('order_custom_id');

        return view('checkout.complete', compact('cart', 'order_custom_id'));
    }

    private function makeRandomStr()
    {
        $str = 'abcdefghkmnprtuvwxy023456789';
        $rand_str = substr(str_shuffle($str), 0, 8);
        return $rand_str;
    }
}
