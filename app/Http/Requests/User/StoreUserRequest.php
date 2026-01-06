<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'user_type_id' => 'required|integer|exists:user_types,id',
            'first_name'   => 'required|string|min:3|max:60',
            'last_name'    => 'required|string|min:3|max:60',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|confirmed|min:8',
        ];
    }

    public function messages(): array {
        return [
            // user_type_id
            'user_type_id.required' => 'O tipo de usuário é um campo obrigatório.',
            'user_type_id.integer' => 'O tipo de usuário deve ser um número inteiro.',
            'user_type_id.exists'  => 'O tipo de usuário informado não existe.',

            // first_name
            'first_name.required' => 'O nome é obrigatório.',
            'first_name.string'   => 'O nome deve ser um texto válido.',
            'first_name.min'      => 'O nome deve conter no mínimo :min caracteres.',
            'first_name.max'      => 'O nome deve conter no máximo :max caracteres.',

            // last_name
            'last_name.required' => 'O sobrenome é obrigatório.',
            'last_name.string'   => 'O sobrenome deve ser um texto válido.',
            'last_name.min'      => 'O sobrenome deve conter no mínimo :min caracteres.',
            'last_name.max'      => 'O sobrenome deve conter no máximo :max caracteres.',

            // email
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'Informe um endereço de e-mail válido.',
            'email.unique'   => 'O e-mail informado já está em uso.',

            // password
            'password.required'  => 'A senha é obrigatória.',
            'password.string'    => 'A senha deve ser um texto válido.',
            'password.min'       => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ];
    }
}
