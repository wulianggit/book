<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;
use Captcha;
use Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('register');
    }

    /**
     * 通过手机号注册为新用户
     *
     * @param  \App\Http\Requests\RegisterPhoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storePhone(Requests\RegisterPhoneRequest $request)
    {
        $data   = $request->all();
        $mobile = $data['phone'];
        // 获取缓存中的验证码
        $verify = Cache::get($mobile);
        
        if ($verify !== $data['phone_code']) {
            return response()->json(['status' => 1, 'message' => '验证码错误!']);
        }

        // 注册用户
        $result = Member::registerPhone($data);

        if (!$result) {
            return response()->json(['status' => 1, 'message' => '注册失败!']);
        }

        return response()->json(['status' => 1, 'message' => '注册成功!']);
    }

    /**
     * 通过邮箱注册为新用户
     *
     * @param  \App\Http\Requests\RegisterEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(Requests\RegisterEmailRequest $request)
    {
        $data = $request->all();
        // 注册用户
        $result = Member::registerEmail($data);

        if (!$result) {
            return response()->json(['status' => 1, 'message' => '注册失败!']);
        }

        return response()->json(['status' => 1, 'message' => '注册成功!']);
    }

}
