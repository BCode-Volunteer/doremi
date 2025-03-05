<?php

namespace App\Services;

use App\Exceptions\ContributionException;
use App\Factories\ContributionHistoryExportFactory;
use App\Models\Contribution;
use App\Models\ContributionHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContributionHistoryService implements IContributionHistoryService
{
    public function __construct() {}

    public function listContributionHistory(): Collection
    {
        return ContributionHistory::all();
    }

    public function createContributionHistory(
        Contribution $contribution,
        float $amount,
        string $date = null
    ): ContributionHistory {
        try {
            DB::beginTransaction();

            if (is_null($date)) {
                $date = Carbon::now();
            }

            $history = ContributionHistory::create([
                'contribution_id' => $contribution->id,
                'amount' => $amount,
                'date' => $date,
            ]);

            DB::commit();

            return $history;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ContributionException(
                'Erro interno ao cadastrar histórico de contribuição! Tente novamente mais tarde.'
            );
        }
    }

    public function exportContributionHistory(string $format): Response
    {
        
        $exportStrategy = ContributionHistoryExportFactory::create($format);

        return $exportStrategy->export();
    }
}
