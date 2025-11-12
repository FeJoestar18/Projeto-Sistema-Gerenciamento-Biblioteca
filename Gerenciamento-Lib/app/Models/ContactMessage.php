<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'status',
        'user_id',
        'assigned_to',
        'responded_at',
        'response'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /**
     * Get the user who created the message
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user assigned to respond to this message
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Check if message is open
     */
    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    /**
     * Check if message is in progress
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Check if message is closed
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor(): string
    {
        return match ($this->status) {
            'open' => 'warning',
            'in_progress' => 'info',
            'closed' => 'success',
            default => 'secondary'
        };
    }

    /**
     * Get status display name
     */
    public function getStatusDisplayName(): string
    {
        return match ($this->status) {
            'open' => 'Aberto',
            'in_progress' => 'Em Andamento',
            'closed' => 'Fechado',
            default => 'Desconhecido'
        };
    }
}