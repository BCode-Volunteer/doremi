<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\IContributionService;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function __construct(protected IContributionService $contributionService) {}

    public function index()
    {
        $contributions = $this->contributionService->listContributions();
        return $contributions;
    }
}
