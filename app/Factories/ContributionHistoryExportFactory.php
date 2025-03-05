<?php

namespace App\Factories;

use App\Exceptions\ContributionHistoryException;
use App\Services\ContributionHistoryService;
use App\Strategies\ContributionHistory\AbstractExportStrategy;
use App\Strategies\ContributionHistory\PdfExportStrategy;

class ContributionHistoryExportFactory
{
    public static function create(string $format): AbstractExportStrategy
    {
        //TODO: Adicioanr strategy EXCEL
        $strategies = [
            'pdf' => PdfExportStrategy::class,
        ];

        if (isset($strategies[$format])) {
            return new ($strategies[$format])(historyService: new ContributionHistoryService(), format: $format);
        }

        throw new ContributionHistoryException(
            "Erro interno ao gerar instância da strategy de geração do histórico para o formato: {$format}"
        );
    }
}
