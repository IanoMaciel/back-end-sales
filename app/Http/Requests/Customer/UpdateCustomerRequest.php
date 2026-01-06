<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'full_name' => 'sometimes|string|min:3|max:120',
            'cpf'       => 'sometimes|cpf|formato_cpf'
        ];
    }

    public function messages(): array {
        return [
            'full_name.string'   => 'O campo nome completo deve ser do tipo texto.',
            'full_name.min'      => 'O campo nome completo deve conter no mínimo :min caracteres.',
            'full_name.max'      => 'O campo nome completo deve ter no máximo :max caracteres.',

            'cpf.cpf'            => 'O CPF informado não é válido.',
            'cpf.formato_cpf'    => 'O CPF deve estar no seguinte formato: xxx.xxx.xxx-xx',
        ];
    }
}
