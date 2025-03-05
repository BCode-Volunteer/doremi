<?php

namespace App\Strategies\ContributionHistory;

use App\Exceptions\ContributionHistoryException;
use App\Services\IContributionHistoryService;
use Illuminate\Http\Response;

abstract class AbstractExportStrategy
{
    public function __construct(protected IContributionHistoryService $historyService, protected string $format) {}

    public function export()
    {
        $this->canExport();
        
        $this->generate();
    }

    abstract protected function generate();

    protected function canExport(): void
    {
        if (!in_array($this->format, ['pdf', 'excel'])) {
            throw new ContributionHistoryException('Informe um formato válido!', Response::HTTP_BAD_REQUEST);
        }
    }
}
