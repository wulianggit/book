<?php

namespace App\Mailer;


use Mail;

class Mailer
{
    protected $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';
    /**
     * @param       $user
     * @param       $subject
     * @param       $view
     * @param array $data
     *
     * @author wuliang
     */
    protected function sendTo($user, $subject, $view, $data = [])
    {
        $vars = json_encode(['to' => [$user->email], 'sub' => $data]);
        $param = [
            'apiUser'            => env('SENDCLOUD_API_USER'),
            'apiKey'             => env('SENDCLOUD_API_KEY'),
            'from'               => config('mail')['from']['address'],
            'fromName'           => config('mail')['from']['name'],
            'xsmtpapi'           => $vars,
            'subject'            => $subject,
            'templateInvokeName' => $view,
            'respEmailId'        => 'true'
        ];
        $sendData = http_build_query($param);
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $sendData
            ]];
        $context = stream_context_create($options);

        return file_get_contents($this->url, FILE_TEXT, $context);
    }
}
