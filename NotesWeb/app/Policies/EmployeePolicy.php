<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    /**
     * Determine if the user can view any employees.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEmployee();
    }

    /**
     * Determine if the user can view the employee.
     */
    public function view(User $user, Employee $employee): bool
    {
        return $user->isAdmin() || $user->isEmployee();
    }

    /**
     * Determine if the user can create employees.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can update the employee.
     */
    public function update(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the employee.
     */
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }
}
