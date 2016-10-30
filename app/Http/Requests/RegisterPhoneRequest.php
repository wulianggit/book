<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterPhoneRequest extends Request
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
            'phone' => 'required',
            'password' => 'required|confirmed',
            'phone_code' => 'required|digits:6'
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空!',
            'confirmed' => '两次输入的密码不一致',
            'digits'    => ':attribute 必须是:digits位数字',
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function attributes()
    {
        return [
            'phone'      => '手机号码',
            'phone_code' => '手机验证码',
            'password'   => '密码',
        ];
    }
}
