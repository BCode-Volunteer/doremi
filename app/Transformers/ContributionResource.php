<?php

namespace App\Transformers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionResource extends JsonResource
{
    public function __construct(Contribution $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'tipo' => $this->type,
            'valor' => $this->value,
            'data_inicio' => $this->start_date,
            'data_fim' => $this->end_date,
            'status' => $this->status,
            'contribuidor' => [
                'nome' => $this->contributor->name,
                'email' => $this->contributor->email,
                'telefone' => $this->contributor->phone,
            ],
        ];
    }
}
