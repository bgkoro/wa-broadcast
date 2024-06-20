<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Broadcast extends Model
{
    protected $fillable = [
        'campaign_id',
        'phone_number',
        'provider',
        'status'
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('phone_number', 'like', '%' . $search . '%')->orWhere('status', 'like', '%' . $search . '%');
        });
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }
}
