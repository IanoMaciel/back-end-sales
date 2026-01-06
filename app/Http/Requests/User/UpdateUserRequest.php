<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'user_type_id' => 'sometimes|integer|exists:user_types,id',
            'first_name'   => 'sometimes|string|min:3|max:60',
            'last_name'    => 'sometimes|string|min:3|max:60',
            'email'        => 'sometimes|email',
            'password'     => 'sometimes|string|confirmed|min:8',
            'status'       => 'sometimes|in:Ativo,Inativo',
        ];
    }

    public function messages(): array {
        return [
            // user_type_id
            'user_type_id.integer' => 'O tipo de usuário deve ser um número inteiro.',
            'user_type_id.exists'  => 'O tipo de usuário informado não existe.',

            // first_name
            'first_name.string'   => 'O nome deve ser um texto válido.',
            'first_name.min'      => 'O nome deve conter no mínimo :min caracteres.',
            'first_name.max'      => 'O nome deve conter no máximo :max caracteres.',

            // last_name
            'last_name.string'   => 'O sobrenome deve ser um texto válido.',
            'last_name.min'      => 'O sobrenome deve conter no mínimo :min caracteres.',
            'last_name.max'      => 'O sobrenome deve conter no máximo :max caracteres.',

            // email
            'email.email'        => 'Informe um endereço de e-mail válido.',

            // password
            'password.string'    => 'A senha deve ser um texto válido.',
            'password.min'       => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',

            // status
            'status.in'          => 'O campo status aceita somente as apções: Ativo ou Inativo '
        ];
    }
}
