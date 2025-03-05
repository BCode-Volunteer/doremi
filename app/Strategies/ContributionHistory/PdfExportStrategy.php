<?php

namespace App\Strategies\ContributionHistory;

use App\Exceptions\ContributionHistoryException;
use Illuminate\Http\Response;

class PdfExportStrategy extends AbstractExportStrategy
{
    protected function generate()
    {
        dump('ESTOU NA STRATEGY DO PDF');
    }

    protected function canExport(): void
    {
        parent::canExport();
        
        if ($this->format !== 'pdf') {
            throw new ContributionHistoryException('O formato deve ser pdf!', Response::HTTP_BAD_REQUEST);
        }
    }
}
