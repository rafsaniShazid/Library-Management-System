<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public Dashboard - Anyone can view
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Authentication required routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Book routes - Browse and view books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    
    // Admin only routes - Create, edit, delete books (MUST be before /books/{book})
    Route::middleware('admin')->group(function () {
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });
    
    // Dynamic route - MUST be after specific routes like /books/create
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    
    // Borrow routes - Only authenticated users can borrow/return
    Route::get('/my-borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrows.store');
    Route::post('/return/{borrow}', [BorrowController::class, 'return'])->name('borrows.return');
    Route::delete('/borrow/{borrow}', [BorrowController::class, 'destroy'])->name('borrows.destroy');
});

require __DIR__.'/auth.php';
