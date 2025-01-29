<?php

namespace App\Services;

use App\Models\Contribution;
use Illuminate\Database\Eloquent\Collection;

class ContributionService implements IContributionService
{
    public function listContributions(): Collection
    {
        return Contribution::all();
    }
}
