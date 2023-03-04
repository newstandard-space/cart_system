<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Item;
use App\Models\Product;
use App\Models\ItemImage;


class ProductController extends Controller
{
    public function index()
    {
        $item_list = Item::get();

        return view('product/index', compact('item_list'));
    }

    public function detail($id)
    {
        return view('product/detail', compact('id'));
    }

    public function getProductDetailInfo($id)
    {
        $item = Item::find($id);

        $color_sizes = DB::table('products')
        ->select(DB::raw('color, group_concat(size order by size) as sizes'))
        ->where('item_id', '=', $id)->groupBy('color')
        ->get()->mapWithKeys(function ($obj) {
            return [$obj->color => (object)(explode(',', $obj->sizes))];
        });

        $color_images = DB::table('item_images')
        ->select(DB::raw('color, group_concat(path) as pathes'))
        ->where('item_id', '=', $id)->groupBy('color', 'item_id')
        ->get()->mapWithKeys(function ($obj) {
            return [$obj->color => (object)(explode(',', $obj->pathes))];
        });

        return ['item' => $item, 'color_sizes' => $color_sizes, 'color_images'=> $color_images];
    }

    public function addCart(Request $request)
    {
        $id = $request->id;
        $color = $request->color;
        $size = $request->size;

        $cart = [
            'id' => $id,
            'color' => $color,
            'size' => $size
        ];

        $request->session()->put('cart', $cart);

        return ;

    }
}
