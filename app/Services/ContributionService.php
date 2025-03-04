<?php

namespace App\Services;

use App\Enums\ContributionStatusEnum;
use App\Exceptions\ContributionException;
use App\Models\Contribution;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContributionService implements IContributionService
{
    public function __construct(protected IContributionHistoryService $historyService) {}

    public function listContributions(): Collection
    {
        return Contribution::all();
    }

    public function createContribution(object $data): Contribution
    {
        $this->canCreateContribution($data);
        try {
            DB::beginTransaction();

            $contribution = new Contribution();
            $contribution->contributor_id = $data->contributor_id;
            $contribution->type = $data->type;
            $contribution->value = $data->value ?? null;
            $contribution->status = $data->status;

            if ($data->status === ContributionStatusEnum::PAID->value && isset($data->payment_date)) {
                $contribution->start_date = $data->payment_date;
                $contribution->save();

                $this->historyService->createContributionHistory($contribution, $data->value, $data->payment_date);
            }

            $contribution->start_date = $data->start_date;
            $contribution->end_date = $data->end_date;

            $contribution->save();

            DB::commit();

            return $contribution;
        } catch (ContributionException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ContributionException('Erro interno ao cadastrar contribuição! Tente novamente mais tarde.');
        }
    }

    private function canCreateContribution(object $data): void
    {
        if (
            isset($data->status) &&
            $data->status === ContributionStatusEnum::PAID->value &&
            !isset($data->payment_date)
        ) {
            throw new ContributionException('Por favor, informe a data do pagamento!', Response::HTTP_BAD_REQUEST);
        }

        if (isset($data->payment_date) && !isset($data->value)) {
            throw new ContributionException('Por favor, informe a valor do pagamento!', Response::HTTP_BAD_REQUEST);
        }

        if (isset($data->end_date) && isset($data->start_date) && $data->start_date > $data->end_date) {
            throw new ContributionException(
                'A data de início da contribuição deve ser anterior à data de término!',
                Response::HTTP_CONFLICT
            );
        }
    }
}
