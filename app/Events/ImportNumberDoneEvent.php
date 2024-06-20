<?php

namespace App\Events;

use App\Models\Campaign;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportNumberDoneEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $userId;
    public Campaign $campaign;


    /**
     * Create a new event instance.
     */
    public function __construct( int $userId, Campaign $campaign)
    {
        $this->userId = $userId;
        $this->campaign = $campaign;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, PrivateChannel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('importNumberDoneEvent'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ImportNumberDoneEvent';
    }
}
