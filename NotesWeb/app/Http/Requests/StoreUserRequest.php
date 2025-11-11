<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'cpf' => ['nullable', 'string', 'size:11', 'unique:users,cpf'],
            'cnpj' => ['nullable', 'string', 'size:14', 'unique:users,cnpj'],
            'rg' => ['nullable', 'string', 'max:20', 'unique:users,rg'],
            'role' => ['nullable', Rule::in(['admin', 'funcionario', 'usuario'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'rg.unique' => 'Este RG já está cadastrado.',
        ];
    }
}
