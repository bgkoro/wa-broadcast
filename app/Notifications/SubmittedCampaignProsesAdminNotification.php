<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmittedCampaignProsesAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Campaign $campaign;

    /**
     * Create a new notification instance.
     */
    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello! ' . $notifiable->name)
            ->subject('New Champaign: ' . $this->campaign->title)
            ->line("Here is the new campaign: [" . $this->campaign->user->name . "'s " . $this->campaign->title . '] is ready to proses. Click the button below to check.')
            ->action('Open Campaign', url('/campaign'))
            ->line('Thank you for using our application!');
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
