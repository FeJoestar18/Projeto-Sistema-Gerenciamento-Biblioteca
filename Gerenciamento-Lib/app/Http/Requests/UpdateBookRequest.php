<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && ($this->user()->isAdmin() || $this->user()->isEmployee());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $bookId = $this->route('book');

        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'author' => ['sometimes', 'string', 'max:255'],
            'isbn' => ['sometimes', 'string', 'max:13', Rule::unique('books')->ignore($bookId)],
            'category' => ['sometimes', 'string', 'max:100'],
            'quantity' => ['sometimes', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'isbn.unique' => 'Este ISBN já está cadastrado.',
            'quantity.min' => 'A quantidade não pode ser negativa.',
            'price.min' => 'O preço não pode ser negativo.',
        ];
    }
}
