<?php

namespace App\Listeners;

use App\Events\MemberRegistered;
use App\Mailer\MemberMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    public $mailer;
    /**
     * Create the event listener.
     *
     * @param  MemberMailer $mailer
     */
    public function __construct(MemberMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  MemberRegistered  $event
     * @return void
     */
    public function handle(MemberRegistered $event)
    {
        $this->mailer->welcome($event->member);
    }
}
