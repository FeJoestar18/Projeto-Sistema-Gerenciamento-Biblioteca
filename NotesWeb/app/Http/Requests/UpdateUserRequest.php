<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'cpf' => ['nullable', 'string', 'size:11', Rule::unique('users')->ignore($userId)],
            'cnpj' => ['nullable', 'string', 'size:14', Rule::unique('users')->ignore($userId)],
            'rg' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($userId)],
            'role' => ['nullable', Rule::in(['admin', 'funcionario', 'usuario'])],
            'is_blocked' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Este e-mail já está em uso.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'rg.unique' => 'Este RG já está cadastrado.',
        ];
    }
}
