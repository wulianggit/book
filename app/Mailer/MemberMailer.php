<?php

namespace App\Mailer;


class MemberMailer extends Mailer
{
    /**
     * @param $user
     *
     * @author wuliang
     */
    public function welcome ($user)
    {
        $subject = '注册确认';
        $view = 'register_new';
        $data = ['%id%' => [$user->id],'%token%' => [$user->token]];

        $this->sendTo($user, $subject, $view, $data);
    }
}
