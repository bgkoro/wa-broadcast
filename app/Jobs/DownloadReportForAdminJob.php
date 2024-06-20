<?php

namespace App\Jobs;

use App\Events\GenerateNumberAdminDoneEvent;
use App\Http\Resources\BroadcastResource;
use App\Models\Campaign;
use App\Models\User;
use App\Notifications\CampaignReportForAdminToProsesNotification;
use App\Services\GenerateCampaignReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class DownloadReportForAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Campaign $campaign;
    private User $user;

    public function __construct(User $user, Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Download report for campaign ' . $this->campaign->id . ' started');
        Log::info($this->job->getRawBody());
        $broadcasts = $this->campaign->broadcasts->whereIn('status', ['delivered', 'onprocess']);
        $broadcasts = BroadcastResource::collection($broadcasts)->toArray(request());
        $reportCsvPath = (new GenerateCampaignReportService($this->campaign, $broadcasts, "for_processes"))->handle();
        $reportCsvPath = config('app.url') . "/download_csv/for_processes/$reportCsvPath";

        event(new GenerateNumberAdminDoneEvent(
            $this->user->id,
            $this->campaign->makeHidden(['message', 'created_at', 'updated_at', 'broadcasts', 'user', 'schedule'])));
        Notification::send($this->user,
            new CampaignReportForAdminToProsesNotification($this->campaign, $reportCsvPath));
        Log::info('Download report for campaign ' . $this->campaign->id . ' finished');
    }
}
