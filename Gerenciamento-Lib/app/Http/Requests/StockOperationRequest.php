<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && ($this->user()->isAdmin() || $this->user()->isEmployee());
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.min' => 'A quantidade deve ser maior que zero.',
        ];
    }
}
