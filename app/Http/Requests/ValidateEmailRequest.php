<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ValidateEmailRequest extends Request
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
            'id'    => 'required|numeric',
            'token' => 'required'
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function messages()
    {
        return [
            'required' => ':attribute 不能为空',
            'numeric'  => ':attribute 必须是数字'
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function attributes()
    {
        return [
            'id'   => '用户ID',
            'token'=> '验证token'
        ];
    }
}
