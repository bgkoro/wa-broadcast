<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditsHistory extends Model
{
    protected $fillable = [
        'credit_id',
        'description',
        'initial_balance',
        'debit',
        'credit',
        'ending_balance',
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['periode'] ?? false, function ($query, $periode) {
            $startDate = date('Y-m-d', strtotime($periode['start'] . ' - 1 days'));
            $endDate = date('Y-m-d', strtotime($periode['end'] . ' + 1 days'));
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        });
    }

    public function credit(): BelongsTo
    {
        return $this->belongsTo(Credit::class, 'credit_id', 'id');
    }
}
