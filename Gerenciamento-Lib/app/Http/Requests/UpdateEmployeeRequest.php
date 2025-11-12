<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'age' => ['sometimes', 'integer', 'min:18', 'max:100'],
            'address' => ['sometimes', 'string'],
            'cpf' => ['sometimes', 'string', 'size:11', Rule::unique('employees')->ignore($employeeId)],
            'rg' => ['sometimes', 'string', 'max:20', Rule::unique('employees')->ignore($employeeId)],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('employees')->ignore($employeeId)],
            'department_id' => ['sometimes', 'exists:departments,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'age.min' => 'O funcionário deve ter no mínimo 18 anos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'rg.unique' => 'Este RG já está cadastrado.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'department_id.exists' => 'Departamento inválido.',
        ];
    }
}
