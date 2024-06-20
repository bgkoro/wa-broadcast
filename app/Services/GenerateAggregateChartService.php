<?php

namespace App\Services;

use Akaunting\Apexcharts\Chart;
use App\Http\Requests\DashboardRequest;
use App\Models\CampaignReport;
use DateTime;
use Illuminate\Support\Facades\Gate;

class GenerateAggregateChartService
{
    public DashboardRequest $dashboardRequest;
    private CampaignReport $campaignReport;
    private int $totalCampaign;
    private array $period;

    /**
     * Create a new controller instance.
     *
     * @param DashboardRequest $request
     */
    public function __construct(DashboardRequest $request)
    {
        $request->validated();

        // Check if the user has the permission to manage self campaigns, if true, then add the user id to the request.
        if (Gate::allows('has-permission', 'manage_self_campaigns')) {
            $request->merge(['user' => auth()->user()->id]);
        }

        // Set the default value for the request. If the request has a start or end date, then set the periode to the request.
        $request->merge([
            'status' => 'delivered',
            'periode' => ['start' => date('Y-m-d', strtotime('-7 days')), 'end' => date('Y-m-d')]
        ]);

        // If the request has a start or end date, then set the period to the request.
        if ($request->has('start') || $request->has('end')) {
            if ($request['start'] >= date('Y-m-d', strtotime('-3 month')) && $request['end'] <= date('Y-m-d')) {
                $request['periode'] = ['start' => $request['start'], 'end' => $request['end']];
            }
        }
        $this->period = [$request['periode']['start'], $request['periode']['end']];
        $this->campaignReport = CampaignReport::getNumbersCampaignReport([
            'user' => $request['user'],
            'periode' => $request['periode'],
            'status' => $request['status']
        ]);
        $this->totalCampaign = CampaignReport::getTotalCampaignReport([
            'user' => $request['user'],
            'periode' => $request['periode']
        ]);
        $this->dashboardRequest = $request;
    }

    /**
     *
     * This method generates a Apex-chart.
     *
     * @return Chart The name of the generated CSV file.
     */
    public function apexChart(): Chart
    {
        $start_date = new Datetime($this->period[0]);
        $end_date = new DateTime($this->period[1]);
        $date_array = array();
        $date_array[] = $start_date->format("Y-M-d");
        $current_date = clone $start_date;
        while ($current_date->format("Y-m-d") < $end_date->format("Y-m-d")) {
            $current_date->modify("+1 day");
            $date_array[] = $current_date->format("Y-M-d");
        }
        return (new Chart)
            ->setType('bar')
            ->setSubtitle('')
            ->setZoom((['enabled' => false]))
            ->setFontFamily('Inter, sans-serif')
            ->setToolbar((['show' => true]))
            ->setWidth('100%')
            ->setXaxisLabels(([
                'rotate' => 45,
                'show' => true,
                'style' => [
                    'fontFamily' => 'Inter, sans-serif',
                    'cssClass' => "text-xs font-normal fill-dark-500 dark:fill-dark-500"
                ],
            ]))
            ->setBar([
                'horizontal' => false,
                'columnWidth' => "65%",
                'borderRadiusApplication' => "end",
                'borderRadius' => 8,
            ])
            ->setTooltipShared(true)
            ->setTooltipIntersect(false)
            ->setTooltipStyle(['fontFamily' => 'Inter, sans-serif'])
            ->setStatesHover(['filter' => (['type' => 'darken', 'value' => 1])])
            ->setStrokeShow(true)
            ->setStrokeWidth(0)
            ->setStrokeColors(['transparent'])
            ->setLegendShow(true)
            ->setLegendLabels([
                'useSeriesColors' => false,
                'colors' => '#728192',
            ])
            ->setXaxisType('category')
            ->setXaxisFloating(false)
            ->setXaxisAxisBorder(['show' => false])
            ->setXaxisAxisTicks(['show' => true])
            ->setYaxisShow(false)
            ->setFillOpacity(1)
            ->setGridPadding((['left' => 2, 'right' => 2, 'top' => -14]))
            ->setGridShow(false)
            ->setGridStrokeDashArray(4)
            ->setColors(['#7c3aed', '#16a34a', '#d99e06', '#dc2626'])
            ->setLabels($date_array)
            ->setDataset('Total SMS', 'bar',
                CampaignReport::getArrayTotalFieldByDate('submitted', $this->dashboardRequest))
            ->setDataset('Total Delivery', 'bar',
                CampaignReport::getArrayTotalFieldByDate('delivered', $this->dashboardRequest))
            ->setDataset('Undelivered', 'bar',
                CampaignReport::getArrayTotalFieldByDate('undelivered', $this->dashboardRequest))
            ->setDataset('Rejected', 'bar',
                CampaignReport::getArrayTotalFieldByDate('rejected', $this->dashboardRequest));
    }

    public function getTotalCampaign(): string
    {
        return $this->totalCampaign ?? 0;
    }

    public function getTotalSubmitted(): string
    {
        return $this->campaignReport->total_submitted ?? 0;
    }

    public function getTotalDelivered(): string
    {
        return $this->campaignReport->total_delivered ?? 0;
    }

    public function getTotalUndelivered(): string
    {
        return $this->campaignReport->total_undelivered ?? 0;
    }

    public function getTotalRejected(): string
    {
        return $this->campaignReport->total_rejected ?? 0;
    }
}
