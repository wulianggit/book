<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SMSRequest extends Request
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
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function messages()
    {
        return [
            'required' => ':attribute 不能为空!',
        ];
    }

    /**
     * @return array
     * @author wuliang
     */
    public function attributes()
    {
        return [
            'phone' => '手机号码'
        ];
    }
}
