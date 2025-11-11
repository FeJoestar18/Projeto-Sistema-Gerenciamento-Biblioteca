<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'cnpj',
        'rg',
        'role',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_blocked' => 'boolean',
        ];
    }

    // Métodos para criptografar/descriptografar CPF
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getCpfAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    // Métodos para criptografar/descriptografar CNPJ
    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getCnpjAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    // Métodos para criptografar/descriptografar RG
    public function setRgAttribute($value)
    {
        $this->attributes['rg'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getRgAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is employee
     */
    public function isEmployee(): bool
    {
        return $this->role === 'funcionario';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'usuario';
    }

    /**
     * Get the employee profile
     */
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Get the books created by the user
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'created_by');
    }

    /**
     * Get the audit logs for the user
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
