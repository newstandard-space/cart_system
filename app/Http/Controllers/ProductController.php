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
        $products = DB::table('products')
        ->select(DB::raw('color, group_concat(size order by size) as sizes'))
        ->where('item_id', '=', $id)->groupBy('color')
        ->get();

        $item = Item::find($id);
        
        $item_images = DB::table('item_images')
        ->select(DB::raw('color, group_concat(path) as pathes'))
        ->where('item_id', '=', $id)->groupBy('color', 'item_id')
        ->get();

        return view('product/detail', compact('item', 'products', 'item_images'));
    }
}
