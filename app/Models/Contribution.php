<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions';
    protected $fillable = ['contributor_id', 'type', 'value', 'start_date', 'end_date', 'status'];

    public function contributor(): BelongsTo
    {
        return $this->belongsTo(Contributor::class);
    }

    public function contributions_history(): HasMany
    {
        return $this->hasMany(ContributionHistory::class);
    }
}
