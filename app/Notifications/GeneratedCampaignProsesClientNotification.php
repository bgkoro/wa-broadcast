<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneratedCampaignProsesClientNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Campaign $campaign;
    private string $reportCsvPath;

    /**
     * Create a new notification instance.
     */
    public function __construct($campaign, $reportCsvPath)
    {
        $this->campaign = $campaign;
        $this->reportCsvPath = $reportCsvPath;
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
            ->subject('Champaign of ' . $this->campaign->title)
            ->line("Your campaign: [" . $this->campaign->title . '] is processed . Click the button below to download the report.')
            ->action('Download Report', $this->reportCsvPath)
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
