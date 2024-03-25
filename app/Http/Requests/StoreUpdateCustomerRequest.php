<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:15',
        ];
    }

    public function messages()
    {
        return [

            'name' => [
                'required' => 'O nome é obrigatório.',
                'string' => 'O campo nome não pode ter mais de 255 caracteres.',
            ],
            'cpf_cnpj' =>  [
                'required' => 'O CPF ou CNPJ é obrigatório.',
                'string' => 'O CPF ou CNPJ deve ser uma string.',
            ]
        ];
    }
}
