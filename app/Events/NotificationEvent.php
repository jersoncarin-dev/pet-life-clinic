<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public $users;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$users)
    {
        $this->message = $message;
        $this->users = $users;
    }

    public function broadcastOn()
    {
        return array_map(function($id) {
            return 'user_id_'.$id;
        },$this->users);
    }

    public function broadcastAs()
    {
        return 'notification';
    }
}
