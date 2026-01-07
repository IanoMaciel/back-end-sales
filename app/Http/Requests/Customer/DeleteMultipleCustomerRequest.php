<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMultipleCustomerRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'id'   => 'required|array|min:1',
            'id.*' => 'required|integer|exists:customers,id',
        ];
    }

    public function messages(): array {
        return [
            'id.required'   => 'O campo ID é obrigatório.',
            'id.array'      => 'O campo ID deve ser um array.',
            'id.min'        => 'Informe pelo menos um ID para exclusão.',
            'id.*.required' => 'Cada ID é obrigatório.',
            'id.*.integer'  => 'O campo ID deve ser um número inteiro.',
            'id.*.exists'   => 'O ID selecionado não existe na base de dados.',
        ];
    }
}
