<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Models\CampaignReport;
use App\Models\Credit;
use App\Services\GenerateAggregateChartService;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DashboardRequest $request)
    {
        $aggregateChart = new GenerateAggregateChartService($request);
        $data = [
            'title' => 'Dashboard',
            'credit' => Credit::where('user_id', auth()->user()->id)->first(),
            'campaign' => $aggregateChart->getTotalCampaign(),
            'smsSubmitted' => $aggregateChart->getTotalSubmitted(),
            'smsDelivered' => $aggregateChart->getTotalDelivered(),
            'smsUndelivered' => $aggregateChart->getTotalUndelivered(),
            'smsRejected' => $aggregateChart->getTotalRejected(),
            'request' => $aggregateChart->dashboardRequest->all(),
            'chart' => $aggregateChart->apexChart(),
        ];
        return view('pages.dashboard.index', $data);
    }
}
