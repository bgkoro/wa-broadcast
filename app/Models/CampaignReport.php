<?php

namespace App\Models;

use App\Http\Requests\DashboardRequest;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class CampaignReport extends Model
{

    protected $fillable = [
        'campaign_id',
        'submitted',
        'delivered',
        'undelivered',
        'rejected'
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['periode'] ?? false, function ($query, $period) {
            $startDate = date('Y-m-d', strtotime($period['start']));
            $endDate = date('Y-m-d', strtotime($period['end'] . ' + 1 days'));
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->whereHas('campaign', function ($query) use ($status) {
                $query->where('status', $status);
            });
        });

        $query->when($filters['user'] ?? false, function ($query, $user) {
            return $query->whereHas('campaign', function ($query) use ($user) {
                $query->where('user_id', $user);
            });
        });
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public static function getArrayTotalFieldByDate(string $field, DashboardRequest $requests): array
    {
        $start_date = new DateTime($requests['periode']['start']);
        $end_date = new  DateTime($requests['periode']['end']);
        $date_array = array();
        $date_array[] = $start_date->format("Y-m-d");
        $current_date = clone $start_date;
        while ($current_date->format("Y-m-d") < $end_date->format("Y-m-d")) {
            $current_date->modify("+1 day");
            $date_array[] = $current_date->format("Y-m-d");
        }
        $result = self::select(
            DB::raw("DATE(created_at) AS submission_date"),
            DB::raw("SUM($field) AS total"))
            ->filter([
                'periode' => $requests['periode'],
                'user' => $requests['user']
            ])
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get();

        foreach ($date_array as $date) {
            $found = false;
            foreach ($result as $item) {
                if ($item->submission_date == $date) {
                    $total_submitted_array[] = $item->total;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $total_submitted_array[] = 0;
            }
        }
        return $total_submitted_array;
    }

    public static function getNumbersCampaignReport(array $requests): CampaignReport
    {
        return self::filter($requests)
            ->selectRaw('sum(submitted) as total_submitted, sum(delivered) as total_delivered, sum(undelivered) as total_undelivered, sum(rejected) as total_rejected')->first();
    }

    public static function getTotalCampaignReport(array $requests): int
    {
        return self::filter($requests)->count() ?? 0;
    }
}
