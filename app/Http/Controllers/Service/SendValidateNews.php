<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SMSRequest;
use App\Http\Controllers\Controller;
use App\Tools\SMS\SendTemplateSMS;
use Cache;

class SendValidateNews extends Controller
{
    /**
     * 发送短信验证码
     * @param \App\Http\Requests\SMSRequest $request
     *
     * @return mixed
     * @author wuliang
     */
    public function sendSMS (SMSRequest $request)
    {
        $obj   = new SendTemplateSMS;
        $code  = $this->generateVerifyCode();
        $phone = $request->input('phone', '');
        $res   = $obj->sendTemplateSMS($phone, array($code, 60), 1);
        if ($res['status'] == 0) {
            Cache::put($phone, $code, 60);
        }
        return response()->json($res);
    }

    /**
     * 生成短信凭证码
     * @return string
     * @author wuliang
     */
    private function generateVerifyCode ()
    {
        $code    = '';
        $charset = '1234567890';
        $_len    = strlen($charset) - 1;
        $codeLen = config('globals.verifyCode.len');
        for ($i = 0; $i < $codeLen; ++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        return $code;
    }
}
