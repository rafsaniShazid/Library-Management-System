<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::query()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.form',['book' => new Book()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
{
    Book::create($request->validated());
    return redirect()->route('books.index')->with('status','Book created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('borrows.user')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book=Book::findOrFail($id);
        return view('books.form', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
{
    $book = Book::findOrFail($id);
    $book->update($request->validated());
    return redirect()->route('books.index')->with('status','Book updated successfully!');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
        $book= Book::findOrFail($id);
        $hasActive= Borrow::where('book_id',$book->id)->where('status','borrowed')->exists();
        if($hasActive){
            return back()->withErrors(['book'=>'Cannot delete book with active borrow records.']);
        }
        $book->delete();
        return redirect()->route('books.index')->with('status','Book deleted successfully!');
    }
}
