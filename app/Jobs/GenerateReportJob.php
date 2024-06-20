<?php

namespace App\Jobs;

use App\Http\Resources\BroadcastResource;
use App\Models\Campaign;
use App\Notifications\GeneratedCampaignProsesClientNotification;
use App\Services\GenerateCampaignReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Campaign $campaign;

    public function __construct( Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Generate report for campaign ' . $this->campaign->id . ' started');
        Log::info($this->job->getRawBody());
        $broadcasts = $this->campaign->broadcasts;
        $broadcasts = BroadcastResource::collection($broadcasts)->toArray(request());
        $reportCsvPath = (new GenerateCampaignReportService($this->campaign->makeHidden([
            'schedule',
            'broadcasts',
            'message',
            'created_at',
            'updated_at'
        ]), $broadcasts, "report"))->handle();
        $reportCsvPath = config('app.url') . "/download_csv/report/$reportCsvPath";
        Notification::send($this->campaign->user, new GeneratedCampaignProsesClientNotification($this->campaign, $reportCsvPath));
        Log::info('Generate report for campaign ' . $this->campaign->id . ' finished');
    }
}
