<?php

namespace App\Observers;

use App\Models\User;
use App\Models\AuditLog;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Usuário '{$user->name}' foi criado",
            'new_values' => $user->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Usuário '{$user->name}' foi atualizado",
            'old_values' => $user->getOriginal(),
            'new_values' => $user->getChanges(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Usuário '{$user->name}' foi excluído",
            'old_values' => $user->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }
}
