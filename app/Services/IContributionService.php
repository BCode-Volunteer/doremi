<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface IContributionService
{
    public function listContributions(): Collection;
}
