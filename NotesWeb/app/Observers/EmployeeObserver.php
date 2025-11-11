<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\AuditLog;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => Employee::class,
            'model_id' => $employee->id,
            'description' => "Funcionário '{$employee->name}' foi criado",
            'new_values' => $employee->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => Employee::class,
            'model_id' => $employee->id,
            'description' => "Funcionário '{$employee->name}' foi atualizado",
            'old_values' => $employee->getOriginal(),
            'new_values' => $employee->getChanges(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => Employee::class,
            'model_id' => $employee->id,
            'description' => "Funcionário '{$employee->name}' foi excluído",
            'old_values' => $employee->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }
}
