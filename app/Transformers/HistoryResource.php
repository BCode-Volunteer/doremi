<?php

namespace App\Transformers;

use App\Models\ContributionHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    public function __construct(ContributionHistory $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'historico' => [
                'valor' => $this->amount,
                'data' => $this->date,
            ],
            'contribuicao' => ContributionResource::make($this->contribution),
        ];
    }
}
