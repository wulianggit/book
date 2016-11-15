<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;
use Captcha;
use Session;
use Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $returnUrl = $request->get('return_url');
        $returnUrl = urldecode($returnUrl);
        return view ('login')->with(compact('returnUrl'));
    }

    /**
     * 用户登录
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @author wuliang
     */
    public function login (Request $request)
    {
        // 数据验证
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
            'captcha'  => 'required|captcha',
        ],[
            'required' => ':attribute 不能为空',
            'captcha'  => ':attribute 错误',
        ], [
            'username' => '用户名',
            'password' => '密码',
            'captcha'  => '验证码'
        ]);

        // 查询用户
        $username = $request->input('username', '');
        if (strpos($username, '@') !== false) {
            $member = Member::where(['email' => $username, 'active' => 1])->first();
        } else {
            $member = Member::where(['mobile' => $username, 'active' => 1])->first();
        }

        if (!$member) {
            return response()->json([
                'status' => 1,
                'message' => '不存在该用户',
            ]);
        }

        // 验证密码是否正确
        $password = $request->input('password');
        if (!Hash::check($password, $member->password)) {
            return response()->json([
                'status' => 1,
                'message' => '密码错误',
            ]);
        }
        
        // 通过验证,将用户信息存入SESSION
        $request->session()->put('member',['id'=>$member->id,'nickname'=>$member->nickname]);
        return response()->json([
            'status' => 0,
            'message' => '登录成功',
        ]);
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

    /**
     * 通过邮箱注册的用户进行验证
     * @param \App\Http\Requests\ValidateEmailRequest $request
     *
     * @return string
     * @author wuliang
     */
    public function validatEmail (Requests\ValidateEmailRequest $request)
    {
        $id    = $request->input('id');
        $token = $request->input('token');

        $member = Member::find($id);

        if (!$member) {
            return '验证异常';
        }

        if ($member->token != $token) {
            return '验证异常';
        } else {
            if (time() > strtotime($member->deadline)) {
                return '该链接已失效';
            }
        }

        $member->active = 1;
        $member->save();

        return redirect('/member');
    }
}
