<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Por favor, informe o seu endereço de e-mail.',
            'email.email' => 'Insira um endereço de e-mail válido (exemplo: usuario@dominio.com).',
            'email.exists' => 'O e-mail informado não está cadastrado em nosso sistema.',
            'password.required' => 'Por favor, informe a sua senha.',
            'password.string' => 'A senha deve ser um texto válido.',
        ];
    }
}
