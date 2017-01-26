<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SomeEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $user_id;
    public $chat_room_id;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$chat_room_id,$message)
    {
        $this->user_id = $user_id;
        $this->chat_room_id = $chat_room_id;
        $this->message = $message;
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->chat_room_id];
    }

    public function broadcastWith()
{
    return ['user_id' => $this->user_id,'message' => $this->message];
}
}
