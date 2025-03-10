<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Http\Requests\HistoryExportRequest;
use App\Models\Traits\ResponseTrait;
use App\Services\IContributionHistoryService;
use App\Services\IContributionService;
use App\Transformers\ContributionResource;
use App\Transformers\HistoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContributionController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected IContributionService $contributionService,
        protected IContributionHistoryService $historyService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $contributions = $this->contributionService->listContributions();

        return $this->success(
            ContributionResource::collection($contributions),
            message: 'Contribuições listadas com sucesso.'
        );
    }

    public function indexHistory(Request $request): JsonResponse
    {
        $historyContributions = $this->historyService->listContributionHistory();

        return $this->success(
            HistoryResource::collection($historyContributions),
            'Histórico de contribuições retornado com sucesso.'
        );
    }

    public function store(ContributionRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $contribution = $this->contributionService->createContribution($data);

        return $this->success(
            ContributionResource::make($contribution),
            'Contribuição cadastrada com sucesso.',
            Response::HTTP_CREATED
        );
    }

    public function exportHistory(HistoryExportRequest $request)
    {
        $format = $request->validated()['f'];
        
        return $this->historyService->exportContributionHistory($format);
    }
}
