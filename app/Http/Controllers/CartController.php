<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
    /**
     * 查看购物车
     * @return mixed
     * @author wuliang
     */
    public function index ()
    {
        return view('cart.list');
    }

    /**
     * 添加购物车
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @author wuliang
     */
    public function store (Request $request)
    {
        $result = array();
        return response()->json($result);
    }
}
