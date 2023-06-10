<?php

namespace App\Events;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private NotificationResource $notificationResource;

    /**
     * Create a new event instance.
     */
    public function __construct(Notification $notification)
    {
        $this->notificationResource = new NotificationResource($notification);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('user-notifications.'.$this->notificationResource->user_id),
        ];
    }
}
