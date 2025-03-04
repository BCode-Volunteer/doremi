<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Models\Traits\ResponseTrait;
use App\Services\IContributionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContributionController extends Controller
{
    use ResponseTrait;

    public function __construct(protected IContributionService $contributionService) {}

    public function index(Request $request): JsonResponse
    {
        $contributions = $this->contributionService->listContributions();

        return $this->success($contributions, message: 'Contribuições listadas com sucesso!');
    }

    /*

    CASO O STATUS FOR IGUAL A PAGO(O VALOR SE TORNA UM CAMPO OBRIGATORIO)
        -> após o cadastro da contribuição deve ser criado um registro na tabela history_contributions, informando a data de pagamento e o valor

    */
    public function store(ContributionRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $contribution = $this->contributionService->createContribution($data);

        return $this->success($contribution, 'Contribuição cadastrada com sucesso!', Response::HTTP_CREATED);
    }
}
