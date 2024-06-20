<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampaignProsesNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

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
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'campaign' => $this->campaign,
            'total' => $this->total,
            'ke' => $this->ke
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
