<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cookie;

class CartController extends Controller
{
    /**
     * 查看购物车
     * @return mixed
     * @author wuliang
     */
    public function index ()
    {
        $cartItems = array();
        $strBkCart = Cookie::get('bk_cart');
        $arrBkCart = $strBkCart != null ? explode(',', $strBkCart) : array();
        //dd($strBkCart);
        foreach ($arrBkCart as $key => $val)
        {
            $arrTemp = explode(':', $val);
            $cartItems[$key]['id'] = $key;
            $cartItems[$key]['productId'] = $arrTemp[0];
            $cartItems[$key]['count'] = $arrTemp[1];
            $cartItems[$key]['product'] = Product::find($arrTemp[0]);
        }
        return view('cart.list')->with(compact('cartItems'));
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
        $productId = $request->input('productId');
        // 读取COOKIE中存储的购物车信息
        // 1:2,3:2 书籍id:数量
        $strBkCart = $request->cookie('bk_cart');
        $arrBkCart = $strBkCart != null ? explode(',', $strBkCart) : array();
        $count = 1;
        foreach ($arrBkCart as $key => $val)
        {
            $arrTemp = explode(':', $val);
            if ($productId == $arrTemp[0]) {
                $count = (int)$arrTemp[1] + 1;
                $arrBkCart[$key] = $productId .':'. $count;
                break;
            }
        }
        if ($count == 1) {
            array_push($arrBkCart, $productId .':'. $count);
        }

        return response()->json([
            'status'  => 0,
            'message' => '添加成功!',
        ])->withCookie('bk_cart', implode(',', $arrBkCart));
    }
}
