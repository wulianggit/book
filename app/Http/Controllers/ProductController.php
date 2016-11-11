<?php

namespace App\Http\Controllers;

use App\Models\PdtContent;
use App\Models\PdtImage;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        $product    = Product::find($id);
        $pdtContent = PdtContent::where('product_id',$id)->first();
        $pdtImages  = PdtImage::where('product_id', $id)->orderBy('sort', 'DESC')->get();
        
        return view('product.detail')->with(compact('product','pdtContent','pdtImages'));
    }
}
