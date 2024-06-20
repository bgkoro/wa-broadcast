<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Credit extends Model
{

    protected $fillable = [
        'user_id',
        'balance'
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->Wherehas(
                'user',
                function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            );
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function creditsHistory(): HasMany
    {
        return $this->hasMany(CreditsHistory::class, 'credit_id', 'id');
    }
}
