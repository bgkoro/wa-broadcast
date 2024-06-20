<?php

namespace App\Events;

use App\Models\Campaign;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProsesImportNumberEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $userId;
    public Campaign $campaign;
    public int $total;
    public int $ke;


    /**
     * Create a new event instance.
     */
    public function __construct( int $userId, Campaign $campaign, int $total, int $ke)
    {
        $this->userId = $userId;
        $this->campaign = $campaign;
        $this->total = $total;
        $this->ke = $ke;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, PrivateChannel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('importNumberEvent'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ImportNumberEvent';
    }
}
