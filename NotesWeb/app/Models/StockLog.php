<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'type',
        'quantity',
        'previous_quantity',
        'new_quantity',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'previous_quantity' => 'integer',
        'new_quantity' => 'integer',
    ];

    /**
     * Get the book that owns the stock log
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user that owns the stock log
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
