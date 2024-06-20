<?php

namespace App\Http\Controllers;

use App\Http\Resources\BroadcastResource;
use App\Jobs\DownloadReportForAdminJob;
use App\Jobs\GenerateReportJob;
use App\Models\Broadcast;
use App\Models\Campaign;
use App\Models\CampaignReport;
use App\Rules\NumericArrayValues;
use App\Services\GenerateCampaignReportService;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('has-permission', [['manage_campaigns', 'manage_self_campaigns']]);

        if (Gate::denies('has-permission', 'manage_campaigns')) {
            request()->merge(['user' => auth()->user()->id]);
        }

        if (!request()->has('status')) {
            request()->merge(['status' => 'onprocess']);
        }

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Broadcast List',
            'campaigns' => Campaign::with(['user', 'campaign_reports'])
                ->whereHas('user')->latest()->filter(request([
                'search',
                'status',
                'user'
            ]))->paginate($perPage)->withQueryString(),
        ];

        return view('pages.campaign.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('has-permission', 'manage_self_campaigns');

        $data = [
            'title' => 'Create Campaign',
            'template_numbers' => "template_numbers.csv",
        ];

        return view('pages.campaign.create', $data);
    }

    /**
     *  Create campaign akan insert ke 3 tabel jadi harus pake db transaction
     *  1. pertama insert ke table campaign
     *  2. kedua insert file dari excel ke table broadcast cek nomor jika valid statusnya deliverd jika tidak status nya rejected, no tlpn tidk boleh lebih dari jumlah credit yg dimiliki
     *  3. ketiga isnert ke table campaign report hitung total contact yg di submit, total contact dengan status delivered dan rejected
     */

    public function store(Request $request)
    {
//        $data = $request->validated();
//        $user = Auth::user();
//        $phoneNumberReq = $request->file('phone_number');
//        $name = $phoneNumberReq->hashName();
//        $filePath = $phoneNumberReq->storeAs('public', 'telepon-' . $name);
//        unset($data['phone_number']);
//        ImportNumberJob::dispatch($user, $data, $filePath)->delay(now()->addSeconds(2));
//        return redirect()->route('campaign.index')->with('success',
//            'Campaign has been added into Queue for processing, we will notify you when it is done');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $canManageCampaigns = Gate::allows('has-permission', 'manage_campaigns');
        $canManageSelfCampaigns = Gate::allows('has-permission', 'manage_self_campaigns');

        if (!$canManageCampaigns && !$canManageSelfCampaigns || !$canManageCampaigns && $campaign->user_id != auth()->user()->id) {
            abort('404');
        }

        $data = [
            'title' => $campaign->title,
            'report' => $campaign->campaign_reports,
            'campaign' => $campaign,
            'file' => Storage::exists(storage_path()),
        ];

        return view('pages.campaign.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('has-permission', 'manage_campaigns');

        $data = [
            'title' => 'Update Report',
            'campaign' => $campaign,
            'campaign_report' => $campaign->campaign_reports()->first()
        ];

        return view('pages.campaign.edit', $data);
    }

    /**
     *  disini update ke tiga table
     *  1. update status campign di tabel campaign
     *  2. cari nomor undelivered terus update statusnya di table broadcast
     *  3. update ke table campaign report total delivered dan undeleverednya
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('has-permission', 'manage_campaigns');

        $data = $request->validate([
            'undelivered' => ['nullable', new NumericArrayValues()],
            'status' => 'required|in:onprocess,delivered',
        ]);
        if ($data['status'] == 'delivered') {
            Broadcast::where('campaign_id', $campaign->id)
                ->update([
                    'status' => 'delivered',
                ]);

            if (!is_null($data['undelivered'])) {
                $numbersArray = explode("\n", $data['undelivered']);
                $numbersArray = array_filter(array_map('trim', $numbersArray));

                Broadcast::whereIn('phone_number', $numbersArray)
                    ->where('campaign_id', $campaign->id)
                    ->update([
                        'status' => 'undelivered',
                    ]);

                CampaignReport::where('campaign_id', $campaign->id)
                    ->update([
                        'undelivered' => count($numbersArray),
                        'delivered' => $campaign->campaign_reports->delivered - count($numbersArray),
                    ]);
            }
            $campaign->update([
                'status' => $data['status'],
            ]);
            GenerateReportJob::dispatch($campaign);
            return redirect()->route('campaign.index')->with('success', 'Campaign report has been updated');
        }
        return redirect()->route('campaign.index')->with('success', 'No Campaign report processed');
    }

    /**
     * Download the specified resource in storage.
     */
    public function download(Campaign $campaign)
    {
        $this->authorize('has-permission', 'manage_campaigns');
        $countBroadcast = Broadcast::where('campaign_id', $campaign->id)->whereIn(
            'status',
            ['delivered', 'onprocess']
        )->count();
        if ($countBroadcast < 1000) {
            $broadcasts = $campaign->broadcasts->whereIn('status', ['delivered', 'onprocess']);
            $broadcasts = BroadcastResource::collection($broadcasts)->toArray(request());
            $fileName = new GenerateCampaignReportService($campaign, $broadcasts);
            return $this->download_csv($fileName->handle());
        }
        DownloadReportForAdminJob::dispatch(Auth::user(), $campaign);
        return redirect()->route('campaign.index')->with(
            'success',
            'The number of data is too large, we will send the report to your email'
        );
    }

    function download_csv(string $path, string $path1 = "")
    {
        $pathFile = $path;
        $nameFile = $path;

        if (!empty($path1)) {
            $pathFile = "$path/$path1";
            $nameFile = $path1;
        }
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $nameFile . '"',
        ];
        return response()->download(storage_path("app/public/" . $pathFile), $nameFile, $headers);
    }

    function download_report(string $id)
    {
        $canManageCampaigns = Gate::allows('has-permission', 'manage_campaigns');
        $canManageSelfCampaigns = Gate::allows('has-permission', 'manage_self_campaigns');
        $campaign = Campaign::find($id);
        if (!$canManageCampaigns && !$canManageSelfCampaigns || !$canManageCampaigns && $campaign->user_id != auth()->user()->id) {
            abort('404');
        }
        $name = config('custom.prefix_name_report') . $campaign->id . "_" . str_replace(' ', '_',
                trim(strtolower($campaign->title))) . '.csv';
        $path = "app/public/report/" . $name;
        $isExists = File::exists(storage_path($path));
        if (!$isExists) {
            GenerateReportJob::dispatch($campaign);
            return redirect()->route('campaign.show', ['campaign' => $campaign->id])->with('success',
                'Campaign report will email to you');
        } else {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $name . '"',
            ];
            return response()->download(storage_path($path), $name, $headers);
        }
    }

    function download_numbers(string $id)
    {
        $canManageCampaigns = Gate::allows('has-permission', 'manage_campaigns');
        $canManageSelfCampaigns = Gate::allows('has-permission', 'manage_self_campaigns');
        $campaign = Campaign::find($id);
        if (!$canManageCampaigns && !$canManageSelfCampaigns || !$canManageCampaigns && $campaign->user_id != auth()->user()->id) {
            abort('404');
        }
        $name = config('custom.prefix_name_report') . $campaign->id . "_" . str_replace(' ', '_',
                trim(strtolower($campaign->title))) . '.csv';
        $path = "app/public/for_processes/" . $name;
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $name . '"',
        ];
        return response()->download(storage_path($path), $name, $headers);
    }


}
