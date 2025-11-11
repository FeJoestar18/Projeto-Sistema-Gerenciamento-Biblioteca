<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'address',
        'cpf',
        'rg',
        'email',
        'department_id',
        'user_id',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    // Métodos para criptografar/descriptografar CPF
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getCpfAttribute($value)
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
     * Get the department that owns the employee
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user associated with the employee
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
