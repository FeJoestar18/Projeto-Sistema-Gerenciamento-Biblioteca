<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas públicas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// RN-010: Rotas de recuperação de senha
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('guest');

// RN-014: Rotas públicas para visualização de livros (catálogo público)
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Rotas protegidas (requer autenticação)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // RN-004: Rotas de livros (admin e funcionários podem criar/editar)
    // IMPORTANTE: create antes de {book} para evitar conflito de rotas
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // RN-005: Rotas de gerenciamento de estoque (funcionários)
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock/{book}/add', [StockController::class, 'add'])->name('stock.add');
    Route::post('/stock/{book}/remove', [StockController::class, 'remove'])->name('stock.remove');
    Route::get('/stock/{book}/history', [StockController::class, 'history'])->name('stock.history');

    // RN-015: Rotas de exportação
    Route::get('/export/books', [ExportController::class, 'books'])->name('export.books');
    Route::get('/export/users', [ExportController::class, 'users'])->name('export.users');

    // RN-003: Rotas de funcionários (apenas admin)
    Route::resource('employees', EmployeeController::class);

    // RN-006: Rotas de departamentos (apenas admin)
    Route::resource('departments', DepartmentController::class);

    // Rotas do sistema de contato
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'create'])->name('create');
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::get('/my-messages', [ContactController::class, 'myMessages'])->name('my-messages');
        Route::get('/message/{contactMessage}', [ContactController::class, 'show'])->name('show');

        // Rotas para gerenciamento
        Route::get('/manage', [ContactController::class, 'manage'])->name('manage');
        Route::get('/manage/{contactMessage}', [ContactController::class, 'edit'])->name('edit');
        Route::put('/manage/{contactMessage}', [ContactController::class, 'update'])->name('update');
        Route::post('/assign/{contactMessage}', [ContactController::class, 'assign'])->name('assign');
    });
});

// RN-014: Rota pública de visualização de livro individual (DEVE vir por último para não conflitar)
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
