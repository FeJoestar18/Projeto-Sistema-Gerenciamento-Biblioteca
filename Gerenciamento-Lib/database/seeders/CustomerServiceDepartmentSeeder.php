<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class CustomerServiceDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate(
            ['name' => 'Atendimento'],
            [
                'description' => 'Departamento responsável pelo atendimento ao cliente e suporte técnico.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $departments = [
            ['name' => 'Biblioteca', 'description' => 'Departamento de gestão da biblioteca e acervo.'],
            ['name' => 'TI', 'description' => 'Departamento de Tecnologia da Informação.'],
            ['name' => 'Recursos Humanos', 'description' => 'Departamento de gestão de pessoas e recursos humanos.'],
            ['name' => 'Financeiro', 'description' => 'Departamento financeiro e contábil.'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(
                ['name' => $dept['name']],
                [
                    'description' => $dept['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
