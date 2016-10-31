<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Member;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MemberRegistered extends Event
{
    use SerializesModels;

    public $member;
    /**
     * Create a new event instance.
     *
     * @param  Member $member
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
