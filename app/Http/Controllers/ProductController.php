<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Item;

class ProductController extends Controller
{
    public function index()
    {
        $item_list = Item::get();

        return view('product/index', compact('item_list'));
    }

    public function detail($id)
    {
        $item = Item::where('id', $id)->first();

        return view('product/detail', compact('item'));
    }
}