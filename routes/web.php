<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

Route::get('/', function () {
    return view('welcome');
});


Route::group([],function(){
    Route::resource('books',BookController::class);
    Route::get('/my-borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrows.store');
    Route::post('/return/{borrow}', [BorrowController::class, 'destroy'])->name('borrows.destroy');
});