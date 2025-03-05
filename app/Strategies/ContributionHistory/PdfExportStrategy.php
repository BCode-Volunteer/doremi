<?php

namespace App\Strategies\ContributionHistory;

use App\Exceptions\ContributionHistoryException;
use App\Transformers\HistoryResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfExportStrategy extends AbstractExportStrategy
{
    protected function generate(): Response
    {
        try {
            $history = $this->historyService->listContributionHistory();

            $data = json_decode(HistoryResource::collection($history)->toJson());

            $pdf = Pdf::loadView('history.view', compact(['data']));
            return $pdf
                ->setPaper('a4', 'landscape')
                ->setOptions(['dpi' => 150])
                ->stream('historico_contribuicoes' . '.pdf');
        } catch (\Exception $e) {
            throw new ContributionHistoryException('Erro interno ao gerar PDF do histórico de contribuições!');
        }
    }

    protected function canExport(): void
    {
        parent::canExport();

        if ($this->format !== 'pdf') {
            throw new ContributionHistoryException('O formato deve ser pdf!', Response::HTTP_BAD_REQUEST);
        }
    }
}
