<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContributionHistory extends Model
{
    use HasFactory;

    protected $table = 'contributions_history';
    protected $fillable = ['contribution_id', 'amount', 'date'];

    public function contribution(): BelongsTo
    {
        return $this->belongsTo(Contribution::class);
    }

    public function contributor(): Contributor
    {
        return $this->contribution->contributor;
    }
}
