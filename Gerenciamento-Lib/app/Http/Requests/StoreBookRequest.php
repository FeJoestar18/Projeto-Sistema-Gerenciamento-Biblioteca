<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && ($this->user()->isAdmin() || $this->user()->isEmployee());
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:13', 'unique:books,isbn'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'author.required' => 'O autor é obrigatório.',
            'isbn.required' => 'O ISBN é obrigatório.',
            'isbn.unique' => 'Este ISBN já está cadastrado.',
            'category.required' => 'A categoria é obrigatória.',
            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.min' => 'A quantidade não pode ser negativa.',
            'price.min' => 'O preço não pode ser negativo.',
        ];
    }
}
