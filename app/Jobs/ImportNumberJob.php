<?php

namespace App\Jobs;

use App\Events\ImportNumberDoneEvent;
use App\Events\ProsesImportNumberEvent;
use App\Models\Broadcast;
use App\Models\Campaign;
use App\Models\CampaignReport;
use App\Models\Credit;
use App\Models\CreditsHistory;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SubmittedCampaignProsesAdminNotification;
use App\Notifications\SubmittedCampaignProsesClientNotification;
use avadim\FastExcelReader\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ImportNumberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $clientUser;
    private array $request;
    private ?string $filePath;
    private int $numbersRejectedCount;
    private int $numbersCount;

    /**
     * Create a new job instance.
     */
    public function __construct(
        User $clientUser,
        array $data,
        string $filePath,
        int $numbersCount
    ) {
        $this->clientUser = $clientUser;
        $this->request = $data;
        $this->filePath = $filePath;
        $this->numbersRejectedCount = 0;
        $this->numbersCount = $numbersCount;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info($this->job->getRawBody());
        DB::transaction(function () {
            $campaign = Campaign::create([
                'title' => $this->request['title'],
                'message' => $this->request['message'],
                'schedule' => $this->request['schedule'],
                'user_id' => $this->clientUser->id,
            ]);
            event(new ProsesImportNumberEvent(
                $this->clientUser->id,
                $campaign->makeHidden(['message', 'created_at', 'updated_at', 'schedule']),
                $this->numbersCount,
                0));
            if (empty($this->filePath)) {
                $numbersArray = [];
                $numbersArraySource = explode("\n", $this->request['text_area_phone_number']);
                $numbersArraySource = array_filter(array_map('trim', $numbersArraySource));
                foreach ($numbersArraySource as $value) {
                    $numbersArray[] = [$value];
                }
            } else {
                $filePath = storage_path('app/' . $this->filePath);
                $extension = pathinfo($filePath)['extension'];
                if ($extension == 'xlsx') {
                    $excel = Excel::open($filePath);
                    $numbersArray = $excel->readRows(false, Excel::KEYS_ZERO_BASED);
                } else {
                    $numbersArray = array_map('str_getcsv', file($filePath));
                }
            }
            $this->numbersCount = count($numbersArray);
            log::info('Total numbers: ' . $this->numbersCount);
            $ke = 0;
            $chunks = array_chunk($numbersArray, 1000); // Adjust the chunk size as needed
            foreach ($chunks as $chunk) {
                foreach ($chunk as $row) {
                    $ke++;
                    if ("Tidak Diketahui" != $this->checkProvider($row[0])) {
                        Broadcast::create([
                            'campaign_id' => $campaign->id,
                            'phone_number' => $row[0],
                            'provider' => $this->checkProvider($row[0]),
                        ]);
                    } else {
                        Log::info('Nomor ' . $row[0] . ' tidak diketahui');
                        $this->numbersRejectedCount++;
                    }
                }
                event(new ProsesImportNumberEvent(
                    $this->clientUser->id,
                    $campaign->makeHidden(['message', 'created_at', 'updated_at', 'schedule']),
                    $this->numbersCount,
                    $ke));
            }
            $creditsUsed = $this->numbersCount;
            $messageDelivered = $this->numbersCount - $this->numbersRejectedCount;
            Credit::where(
                'user_id',
                $this->clientUser->id
            )->update(['balance' => $this->clientUser->credit->balance - $messageDelivered]);
            CreditsHistory::create([
                'credit_id' => $this->clientUser->credit->id,
                'initial_balance' => $this->clientUser->credit->balance,
                'user_id' => $this->clientUser->id,
                'type' => 'debit',
                'debit' => $messageDelivered,
                'ending_balance' => $this->clientUser->credit->balance - $messageDelivered,
                'description' => 'Sent ' . $this->numbersCount . ' numbers, ' . $this->numbersRejectedCount . ' numbers rejected',
            ]);
            CampaignReport::create([
                'campaign_id' => $campaign->id,
                'submitted' => $creditsUsed,
                'delivered' => $messageDelivered,
                'undelivered' => 0,
                'rejected' => $this->numbersRejectedCount,
            ]);

            // send notification to admin only
            $adminRole = Role::where('name', 'admin')->first();
            $userAdmins = User::whereHas('role', function ($query) use ($adminRole) {
                $query->where('id', $adminRole->id);
            })->get();
            Notification::send($campaign->user, new SubmittedCampaignProsesClientNotification($campaign));
            Notification::send($userAdmins, new SubmittedCampaignProsesAdminNotification($campaign));
            if ($this->numbersRejectedCount != $this->numbersCount) {
                /// send event to client that this job is done
                event(new ImportNumberDoneEvent(
                        $this->clientUser->id,
                        $campaign->makeHidden(['message', 'created_at', 'updated_at', 'schedule', 'broadcasts']),
                    )
                );
                DownloadReportForAdminJob::dispatch($userAdmins[0], $campaign);
            }
        });
        // remove the file after success
        Storage::delete('app/' . $this->filePath);
        Storage::delete($this->filePath);
        Log::info("Finish ProcessImportNumber Job: " . $this->job->getJobId());
    }

    function checkProvider(string $number): string
    {
        $kodeProvider = substr($number, 0, 5);
        return match ($kodeProvider) {
            '62852', '62853', '62851' => 'Kartu AS',
            '62811', '62822' => 'Kartu Halo',
            '62812', '62813', '62821' => 'Kartu Simpati',
            '62823' => 'Kartu Loop',
            '62814' => 'Kartu Indosat M2 Broadband',
            '62815', '62816' => 'Kartu Matrix atau Mentari',
            '62855' => 'Kartu Matrix',
            '62856', '62857' => 'Kartu IM3',
            '62858' => 'Kartu Mentari',
            '62896', '62895', '62897', '62898', '62899' => 'Kartu 3',
            '62817', '62818', '62819', '62859', '62877', '62878' => 'Kartu XL',
            '62832', '62833', '62838' => 'Kartu Axis',
            '62881', '62882', '62883', '62884', '62885', '62886', '62887', '62888', '62889' => 'Kartu Smartfren',
            default => 'Tidak Diketahui',
        };
    }
}
