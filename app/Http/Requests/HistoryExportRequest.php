<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryExportRequest extends FormRequest
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
        return [
            'f' => 'required|in:pdf,excel' //format to export
        ];
    }

    public function messages(): array
    {
        return [
            'f.required' => 'O campo f(format) é obrigatório.',
            'f.in' => 'O campo f(format) deve ser pdf ou excel.'
        ];
    }
}
