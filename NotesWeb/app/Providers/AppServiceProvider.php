<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Employee;
use App\Models\Book;
use App\Observers\UserObserver;
use App\Observers\EmployeeObserver;
use App\Observers\BookObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar observers para auditoria
        User::observe(UserObserver::class);
        Employee::observe(EmployeeObserver::class);
        Book::observe(BookObserver::class);
    }
}

