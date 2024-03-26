<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePaymentRequest extends FormRequest
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
            'customer' => 'required',
            'billing_type' => 'required',
            'value' => 'required|numeric',
            'due_date' =>  'required|date',
        ];
    }

    public function messages()
    {
        return [
            'customer.required' => 'Você deve cadastrar o cliente antes.',
            'billing_type.required' => 'Escolha uma forma de pagamento.',
            'value.required' => 'Qual o valor da cobrança',
            'value.numeric' => 'O valor da cobrança deve ser numérico',
            'due_date.required' => 'Preencha a data do vencimento',
            'due_date.date' => 'Digite uma data válida!',
        ];
    }
}
