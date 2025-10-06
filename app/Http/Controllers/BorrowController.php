<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
    /*
    public function index(){
      return view('borrow.index');
    }
    */

    public function store(string $bookId){
        
    $userId = auth()->id() ?? 1; // TEMP until auth is ready
    $book = Book::findOrFail($bookId);

    if ($book->available_copies < 1) {
        return back()->withErrors(['borrow' => 'No copies available.']);
    }

    Borrow::create([
        'user_id'     => $userId,
        'book_id'     => $book->id,
        'borrow_date' => now(),
        'status'      => 'borrowed',
    ]);

    $book->decrement('available_copies');

    return back()->with('status','Borrowed!');
}

public function return(string $borrowId)
{
    $borrow = Borrow::with('book')->findOrFail($borrowId);

    if ($borrow->status === 'returned') {
        return back()->withErrors(['return' => 'Already returned.']);
    }

    $borrow->update([
        'status'      => 'returned',
        'return_date' => now(),
    ]);

    $borrow->book->increment('available_copies');

    return back()->with('status','Returned!');
}
   /* public function destroy(string $borrowId){
        return back();
        */
}
