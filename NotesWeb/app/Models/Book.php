<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category',
        'quantity',
        'description',
        'price',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Get the user who created the book
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the stock logs for the book
     */
    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }

    /**
     * Check if book is in stock
     */
    public function inStock(): bool
    {
        return $this->quantity > 0;
    }

    /**
     * Add stock
     */
    public function addStock(int $quantity, User $user, ?string $notes = null): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        $previousQuantity = $this->quantity;
        $this->quantity += $quantity;
        $this->save();

        StockLog::create([
            'book_id' => $this->id,
            'user_id' => $user->id,
            'type' => 'add',
            'quantity' => $quantity,
            'previous_quantity' => $previousQuantity,
            'new_quantity' => $this->quantity,
            'notes' => $notes,
        ]);

        return true;
    }

    /**
     * Remove stock
     */
    public function removeStock(int $quantity, User $user, ?string $notes = null): bool
    {
        if ($quantity <= 0 || $this->quantity < $quantity) {
            return false;
        }

        $previousQuantity = $this->quantity;
        $this->quantity -= $quantity;
        $this->save();

        StockLog::create([
            'book_id' => $this->id,
            'user_id' => $user->id,
            'type' => 'remove',
            'quantity' => $quantity,
            'previous_quantity' => $previousQuantity,
            'new_quantity' => $this->quantity,
            'notes' => $notes,
        ]);

        return true;
    }
}
