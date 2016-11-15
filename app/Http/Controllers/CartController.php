<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cookie;
use Mockery\ReceivedMethodCalls;

class CartController extends Controller
{
    /**
     * 查看购物车
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @author wuliang
     */
    public function index (Request $request)
    {
        $cartItems = array();
        $strBkCart = $request->cookie('bk_cart');
        $arrBkCart = $strBkCart != null ? explode(',', $strBkCart) : array();
        $member    = $request->session()->get('member', '');
        
        // 如果用户登录,则同步用户购物车信息
        if ($member)
        {
            $cartItems = $this->syncCart($member['id'], $arrBkCart);
            return response()->view('cart.list', compact('cartItems'))->withCookie('bk_cart', null);
        }

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
     * 同步用户购物车信息
     * @param $memberId
     * @param $arrBkCart
     *
     * @return array
     * @author wuliang
     */
    private function syncCart ($memberId, $arrBkCart)
    {
        $cartItems = CartItem::where('member_id', $memberId)->get();
        $arrCartItem = array();

        foreach ($arrBkCart as $bkCartItem)
        {
            $item  = explode(':', $bkCartItem);
            $pid   = $item[0];
            $count = $item[1];

            $exists = false;
            foreach ($cartItems as $cartItem)
            {
                if ($cartItem->product_id == $pid) {
                    if ($cartItem->count < $count) {
                        $cartItem->count = $count;
                        $cartItem->save();
                    }
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $cartItme = [
                    'member_id'  => $memberId,
                    'product_id' => $pid,
                    'count'      => $count
                ];
                CartItem::create($cartItme);
                $cartItme['product'] = Product::find($pid);
                array_push($arrCartItem, $cartItme);
            }
        }

        $cartItems = $cartItems->toArray();

        foreach ($cartItems as $cartItme)
        {
            $cartItme['product'] = Product::find($cartItme['product_id'])->toArray();
            array_push($arrCartItem, $cartItme);
        }

        foreach ($arrCartItem as $key => $val)
        {
            $arrCartItem[$key]['id'] = $key;
            $arrCartItem[$key]['productId'] = $val['product_id'];
            $arrCartItem[$key]['count'] = $val['count'];
            $arrCartItem[$key]['product'] = $val['product'];
        }
        return $arrCartItem;
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
        $member    = $request->session()->get('member', '');

        // 若用户已登录,则将购物信息存储数据库
        if ($member) {
            $arrBkCart = CartItem::where('member_id', $member['id'])->get();

            $exists = false;
            foreach ($arrBkCart as $item)
            {
                // 购买产品已存在用户购物车中,则跟新数量
                if ($item->product_id == $productId) {
                    $item->count ++;
                    $item->save();
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {// 不在用户的购物车中,则添加
                $cartItme = [
                    'member_id'  => $member['id'],
                    'product_id' => $productId,
                    'count'      => 1
                ];
                CartItem::create($cartItme);
            }

            return response()->json([
                'status'  => 0,
                'message' => '添加成功!',
            ]);
        }

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

    /**
     * 删除购物车
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @author wuliang
     */
    public function destory (Request $request)
    {
        $productIds = $request->input('productIds', '');
        $arrProduct = explode(',', $productIds);
        $member     = $request->session()->get('member');

        if ($member) {
            CartItem::whereIn('product_id', $arrProduct)->delete();
            return response()->json([
                'status'  => 0,
                'message' => '删除成功'
            ]);
        }

        $strBkCart = $request->cookie('bk_cart');
        $arrBkCart = $strBkCart ? explode(',', $strBkCart) : array();
        foreach ($arrBkCart as $key => $bkCart)
        {
            $tempBkCart = explode(':', $bkCart);
            $productId  = $tempBkCart[0];
            if (in_array($productId, $arrProduct)) {
                array_splice($arrBkCart, $key, 1);
                continue;
            }
        }

        return response()->json([
            'status'  => 0,
            'message' => '删除成功'
        ])->withCookie('bk_cart', implode(',', $arrBkCart));
    }
}
