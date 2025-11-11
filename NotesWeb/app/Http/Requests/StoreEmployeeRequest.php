<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:18', 'max:100'],
            'address' => ['required', 'string'],
            'cpf' => ['required', 'string', 'size:11', 'unique:employees,cpf'],
            'rg' => ['required', 'string', 'max:20', 'unique:employees,rg'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'age.required' => 'A idade é obrigatória.',
            'age.min' => 'O funcionário deve ter no mínimo 18 anos.',
            'address.required' => 'O endereço é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'rg.required' => 'O RG é obrigatório.',
            'rg.unique' => 'Este RG já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'department_id.required' => 'O departamento é obrigatório.',
            'department_id.exists' => 'Departamento inválido.',
        ];
    }
}
