<?php

namespace App\Services;

use App\Events\ProsesGenerateNumberAdminEvent;
use App\Models\Campaign;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class GenerateCampaignReportService
{

    private Campaign $campaign;
    private array $broadcasts;
    private string $rootFolder;

    public function __construct(
        Campaign $campaign,
        array $broadcasts,
        string $rootFolder = null
    ) {
        $this->campaign = $campaign;
        $this->broadcasts = $broadcasts;
        $this->rootFolder = "app/public/";
        if (!is_null($rootFolder)) {
            $this->rootFolder = $this->rootFolder . $rootFolder . "/";
            if (!File::isDirectory(storage_path($this->rootFolder))) {
                File::makeDirectory(storage_path($this->rootFolder), 0777, true, true);
            }
        }
    }

    /**
     * Handle the report generation.
     *
     * This method generates a CSV file with the campaign report.
     *
     * @return string The name of the generated CSV file.
     */
    public function handle(): string
    {
        Log::info('Generating report for campaign ' . $this->campaign->id . ' started');
        $total = count($this->broadcasts);
        event(new ProsesGenerateNumberAdminEvent(
            $this->campaign->user_id,
            $this->campaign->id,
            $total,
            0));
        foreach ($this->broadcasts as &$row) {
            $row['message'] = $this->campaign->message; // Change 'value' to the value you want to add
        }
        unset($row); // Unset the reference variable to prevent unwanted changes
        $name = config('custom.prefix_name_report') . $this->campaign->id . "_" . str_replace(' ', '_',
                trim(strtolower($this->campaign->title))) . '.csv';
        $csvFile = fopen(storage_path($this->rootFolder . $name), 'w');
        fputcsv($csvFile, array_keys($this->broadcasts[0]));
        $chunks = array_chunk($this->broadcasts, 1000); // Adjust the chunk size as needed
        $ke = 0;
        event(new ProsesGenerateNumberAdminEvent(
            $this->campaign->user_id,
            $this->campaign->id,
            $total,
            $ke));
        foreach ($chunks as $chunk) {
            foreach ($chunk as $row) {
                fputcsv($csvFile, $row);
                $ke++;
            }
            event(new ProsesGenerateNumberAdminEvent(
                $this->campaign->user_id,
                $this->campaign->id,
                $total,
                $ke));
        }
        fclose($csvFile);
        return $name;
    }

}
