<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campaign extends Model
{

    protected $fillable = [
        'title',
        'message',
        'schedule',
        'user_id',
        'status'
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')->orWherehas('user',
                function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });

        $query->when($filters['user'] ?? false, function ($query, $user) {
            return $query->where('user_id', $user);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function campaign_reports(): HasOne
    {
        return $this->hasOne(CampaignReport::class, 'campaign_id', 'id');
    }

    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'campaign_id', 'id');
    }
}
