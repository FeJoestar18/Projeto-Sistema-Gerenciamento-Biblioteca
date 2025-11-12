<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar departamentos
        $departments = [
            ['name' => 'Administração', 'description' => 'Departamento administrativo'],
            ['name' => 'Biblioteca', 'description' => 'Departamento de biblioteca'],
            ['name' => 'Atendimento', 'description' => 'Departamento de atendimento ao público'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Criar usuário admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@sistema.com',
            'password' => Hash::make('admin123'),
            'cpf' => '12345678901',
            'role' => 'admin',
            'is_blocked' => false,
        ]);

        // Criar usuário funcionário
        User::create([
            'name' => 'Funcionário Teste',
            'email' => 'funcionario@sistema.com',
            'password' => Hash::make('func123'),
            'cpf' => '98765432100',
            'role' => 'funcionario',
            'is_blocked' => false,
        ]);

        // Criar usuário comum
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'usuario@sistema.com',
            'password' => Hash::make('user123'),
            'cpf' => '11122233344',
            'role' => 'usuario',
            'is_blocked' => false,
        ]);
    }
}

