<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\PdtContent;
use App\Models\PdtImage;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cookie;

class ProductController extends Controller
{
    /**
     * 书籍列表
     * @param $cid [书籍分类id]
     *
     * @return mixed
     * @author wuliang
     */
    public function index ($cid)
    {
        $products = Product::where('cate_id', $cid)->get();
        return view('product.list')->with(compact('products'));
    }

    /**
     * 书籍详情
     * @param $id [书籍id]
     *
     * @return mixed
     * @author wuliang
     */
    public function show ($id)
    {
        $count      = 0;
        $product    = Product::find($id);
        $pdtContent = PdtContent::where('product_id',$id)->first();
        $pdtImages  = PdtImage::where('product_id', $id)->orderBy('sort', 'DESC')->get();
        $member     = session('member');
        
        if ($member) {
            $cartItem = CartItem::where(['member_id'=>$member['id'], 'product_id'=>$id])->first();
            $count    = $cartItem ? $cartItem->count : 0;
        } else {
            $strBkCart  = Cookie::get('bk_cart');
            $arrBkCart  = $strBkCart != null ? explode(',', $strBkCart) : array();
            if (!empty($arrBkCart)) {
                foreach ($arrBkCart as $key => $val)
                {
                    $arrTemp = explode(':', $val);
                    if ($id == $arrTemp[0]) {
                        $count = $arrTemp[1];
                        break;
                    }
                }
            }
        }
        return view('product.detail')->with(compact('product','pdtContent','pdtImages','count'));
    }
}
