<?php

namespace App\Http\Requests\Product\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'category' => 'required|string|unique:product_categories, category'
        ];
    }

    public function messages(): array {
        return [
            'category.required' => 'O campo category é obrigatório.',
            'category.string'   => 'O campo category deve ser do tipo texto.',
            'category.unique'   => 'O campo informado já está em uso.'
        ];
    }
}
