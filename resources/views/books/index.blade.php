@extends('layouts.app')
@section('title','Books')
@section('content')
<h1>Books</h1>

<p><a class="btn" href="{{ route('books.create') }}">Add Book</a></p>

<table>
  <thead>
    <tr>
      <th>Title</th><th>Author</th><th>Category</th>
      <th>Total</th><th>Available</th><th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse($books as $book)
      <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->category }}</td>
        <td>{{ $book->total_copies }}</td>
        <td>{{ $book->available_copies }}</td>
        <td>
          <a class="btn" href="{{ route('books.edit', $book) }}">Edit</a>
          <form class="inline" action="{{ route('books.destroy', $book) }}" method="POST">
            @csrf @method('DELETE')
            <button class="btn" type="submit" onclick="return confirm('Delete this book?')">Delete</button>
          </form>
          <form class="inline" action="{{ route('borrows.store', $book) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Borrow</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">No books yet.</td></tr>
    @endforelse
  </tbody>
</table>

<div style="margin-top:12px;">{{ $books->links() }}</div>
@endsection
