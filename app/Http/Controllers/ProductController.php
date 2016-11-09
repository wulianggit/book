<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
    public function index ($cid)
    {
        $products = Product::where('cate_id', $cid)->get();
        return view('product.list')->with(compact('products'));
    }
}
