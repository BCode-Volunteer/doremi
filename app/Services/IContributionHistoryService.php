<?php

namespace App\Services;

use App\Models\Contribution;
use App\Models\ContributionHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface IContributionHistoryService
{
    public function listContributionHistory(): Collection;

    public function createContributionHistory(
        Contribution $contribution,
        float $amount,
        string $date
    ): ContributionHistory;
}
