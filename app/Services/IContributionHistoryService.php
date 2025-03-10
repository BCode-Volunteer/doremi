<?php

namespace App\Services;

use App\Models\Contribution;
use App\Models\ContributionHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

interface IContributionHistoryService
{
    public function listContributionHistory(): Collection;

    public function createContributionHistory(
        Contribution $contribution,
        float $amount,
        string $date
    ): ContributionHistory;

    public function exportContributionHistory(string $format): Response;
}
