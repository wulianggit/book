<?php

namespace App\Http\Controllers;

use App\Models\Categry;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Categry::where('parent_id',0)->orderBy('sort','DESC')->get();
        return view('category.list')->with(compact('categorys'));
    }

    /**
     * 通过父级ID获取子级分类
     * @param $pid
     *
     * @return mixed
     * @author wuliang
     */
    public function getCategoryByPid ($pid)
    {
        $categorys = Categry::where('parent_id',$pid)->orderBy('sort','desc')->get();
        if ($categorys) {
            $result['status']  = 0;
            $result['message'] = '返回成功';
            $result['data']    = $categorys;
        } else {
            $result['status']  = 1;
            $result['message'] = '返回失败';
            $result['data']    = [];
        }

        return response()->json($result);
    }
}
