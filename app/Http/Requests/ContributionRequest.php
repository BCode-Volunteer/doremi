<?php

namespace App\Http\Requests;

use App\Enums\ContributionStatusEnum;
use App\Enums\ContributionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $requiredRule = !$this->isMethod('put') ? 'required' : 'sometimes';

        return [
            'contributor_id' => [$requiredRule, 'integer', 'exists:contributors,id'],
            'type' => [$requiredRule, new Enum(ContributionTypeEnum::class)],
            'value' => ['sometimes', 'numeric'],
            'start_date' => [$requiredRule, 'date'],
            'end_date' => ['sometimes', 'date'],
            'status' => [$requiredRule, new Enum(ContributionStatusEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'contributor_id.required' => 'O campo ID do contribuinte é obrigatório.',
            'contributor_id.integer' => 'O campo ID do contribuinte deve ser um número inteiro.',
            'contributor_id.exists' => 'O ID do contribuinte fornecido não existe.',
            'type.required' => 'O campo tipo é obrigatório.',
            'type.enum' => 'O campo tipo deve ser um valor válido.',
            'value.numeric' => 'O campo valor deve ser um número.',
            'start_date.required' => 'O campo data de início é obrigatório.',
            'start_date.date' => 'O campo data de início deve ser uma data válida.',
            'end_date.date' => 'O campo data de término deve ser uma data válida.',
            'status.required' => 'O campo status é obrigatório.',
            'status.enum' => 'O campo status deve ser um valor válido.',
        ];
    }
}
