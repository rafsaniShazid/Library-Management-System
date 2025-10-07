<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
 
    public function index(){
        // Get only the authenticated user's borrows
        $borrows = Borrow::where('user_id', auth()->id())
            ->with('book')
            ->latest('borrow_date')
            ->paginate(10);
        
        return view('borrows.index', compact('borrows'));
    }
  

    public function store(string $bookId){
        // Get authenticated user ID
        $userId = auth()->id();
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

        return back()->with('status','Book borrowed successfully!');
    }

    public function return(string $borrowId)
    {
        $borrow = Borrow::with('book')->findOrFail($borrowId);

        // Check if the borrow belongs to the authenticated user
        if ($borrow->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action. You can only return your own borrowed books.');
        }

        if ($borrow->status === 'returned') {
            return back()->withErrors(['return' => 'This book has already been returned.']);
        }

        $borrow->update([
            'status'      => 'returned',
            'return_date' => now(),
        ]);

        $borrow->book->increment('available_copies');

        return back()->with('status', 'Book returned successfully!');
    }
   /* public function destroy(string $borrowId){
        return back();
        */
}
