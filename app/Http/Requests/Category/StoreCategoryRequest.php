<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'category' => 'required|string|unique:categories,category',
            'subcategories' => 'nullable|array',
            'subcategories.*.subcategory' => 'required|string'
        ];
    }

    public function messages(): array {
        return [
            'category.required' => 'A categoria é obrigatória.',
            'category.string'   => 'A categoria deve ser um texto válido.',

            'subcategories.array' => 'As subcategorias devem ser enviadas em formato de array.',

            'subcategories.*.subcategory.required' => 'Cada item deve conter o nome da subcategoria.',
            'subcategories.*.subcategory.string'   => 'O nome da subcategoria deve ser um texto.',
        ];
    }

}
