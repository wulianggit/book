<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterEmailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|unique:members',
            'password' => 'required|confirmed',
            'captcha'  => 'required|captcha'
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空',
            'email'     => ':attribute 格式错误',
            'unique'    => ':attribute 不能重复',
            'confirmed' => '两次输入密码不一致',
            'captcha'   => ':attribute 错误'
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function attributes()
    {
        return [
            'email'   => '邮箱',
            'captcha' => '验证码'
        ];
    }
}
