<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\AuditLog;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => Book::class,
            'model_id' => $book->id,
            'description' => "Livro '{$book->title}' foi criado",
            'new_values' => $book->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => Book::class,
            'model_id' => $book->id,
            'description' => "Livro '{$book->title}' foi atualizado",
            'old_values' => $book->getOriginal(),
            'new_values' => $book->getChanges(),
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => Book::class,
            'model_id' => $book->id,
            'description' => "Livro '{$book->title}' foi excluído",
            'old_values' => $book->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }
}
