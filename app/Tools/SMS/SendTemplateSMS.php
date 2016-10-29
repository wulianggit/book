<?php
namespace App\Tools\SMS;
use App\Tools\SMS\RestSmsSDK;
class SendTemplateSMS
{
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    private  $accountSid = '8a216da85805311d01580faf76ab0603';

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    private $accountToken = 'e006f983af6548ee817b4a0dbb49ccc0';

    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    private $appId = '8a216da85805311d01580faf76fa0607';

    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    private $serverIP = 'sandboxapp.cloopen.com';


    //请求端口，生产环境和沙盒环境一致
    private $serverPort = '8883';

    //REST版本号，在官网文档REST介绍中获得。
    private $softVersion = '2013-12-26';


    /**
     * 发送模板短信
     *
     * @param $to      手机号码集合,用英文逗号分开
     * @param $datas   内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
     * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
     * @return mixed
     */
    public function sendTemplateSMS($to, $datas, $tempId)
    {
        $m3_result = [];
        $rest = new RestSmsSDK($this->serverIP, $this->serverPort, $this->softVersion);
        $rest->setAccount($this->accountSid, $this->accountToken);
        $rest->setAppId($this->appId);

        // 发送模板短信
        // echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to, $datas, $tempId);
        if ($result == NULL) {
            $m3_result['status']  = 3;
            $m3_result['message'] = 'result error!';
        }
        if ($result->statusCode != 0) {
            $m3_result['status']  = $result->statusCode;
            $m3_result['message'] = $result->statusMsg;
        } else {
            $m3_result['status']  = 0;
            $m3_result['message'] = '发送成功';
        }

        return $m3_result;
    }

     // sendTemplateSMS("",array('',''),"");//手机号码，替换内容数组，模板ID
}
