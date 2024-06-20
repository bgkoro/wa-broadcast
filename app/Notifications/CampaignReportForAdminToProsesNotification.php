<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampaignReportForAdminToProsesNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $reportCsvPath;
    private Campaign $campaign;

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
            ->subject('Download Report Campaign: ' . $this->campaign->title)
            ->line("Here is the report for the campaign: " . $this->campaign->user->name . "' " . $this->campaign->title . ' is ready for download. Click the button below to download the report.')
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
