<?php

namespace App\Services;

use App\Models\Contribution;
use Illuminate\Database\Eloquent\Collection;

interface IContributionService
{
    public function listContributions(): Collection;
    public function createContribution(object $data): Contribution;
}
