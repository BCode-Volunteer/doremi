<?php

namespace App\Services;

use App\Exceptions\ContributionException;
use App\Models\Contribution;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContributionService implements IContributionService
{
    public function listContributions(): Collection
    {
        return Contribution::all();
    }

    public function createContribution(object $data): Contribution
    {
        $this->canCreateContribution($data);
        try {
            DB::beginTransaction();

            $contribution = Contribution::create([
                'contributor_id' => $data->contributor_id,
                'type' => $data->type,
                'value' => $data->value ?? null,
                'start_date' => $data->start_date,
                'end_date' => $data->end_date,
                'status' => $data->status,
            ]);

            DB::commit();

            return $contribution;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ContributionException('Erro interno ao cadastrar contribuição! Tente novamente mais tarde.');
        }
    }

    private function canCreateContribution(object $data): void
    {
        if (isset($data->end_date) && $data->start_date > $data->end_date) {
            throw new ContributionException(
                'A data de início da contribuição deve ser anterior à data de término!',
                Response::HTTP_CONFLICT
            );
        }
    }
}
