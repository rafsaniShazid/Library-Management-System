@extends('layouts.app')
@section('title', $book->exists ? 'Edit Book' : 'Add Book')
@section('content')
<h1>{{ $book->exists ? 'Edit Book' : 'Add Book' }}</h1>

<form method="POST" action="{{ $book->exists ? route('books.update',$book) : route('books.store') }}">
  @csrf
  @if($book->exists) @method('PUT') @endif

  <div style="margin-bottom:8px;">
    <label>Title<br>
      <input name="title" type="text" value="{{ old('title',$book->title) }}" required>
    </label>
  </div>
  <div style="margin-bottom:8px;">
    <label>Author<br>
      <input name="author" type="text" value="{{ old('author',$book->author) }}" required>
    </label>
  </div>
  <div style="margin-bottom:8px;">
    <label>Category<br>
      <input name="category" type="text" value="{{ old('category',$book->category) }}">
    </label>
  </div>
  <div style="margin-bottom:8px;">
    <label>Total copies<br>
      <input name="total_copies" type="number" min="0" value="{{ old('total_copies',$book->total_copies) }}" required>
    </label>
  </div>
  <div style="margin-bottom:12px;">
    <label>Available copies<br>
      <input name="available_copies" type="number" min="0" value="{{ old('available_copies',$book->available_copies) }}">
    </label>
  </div>

  <button class="btn" type="submit">{{ $book->exists ? 'Update' : 'Create' }}</button>
  <a class="btn" href="{{ route('books.index') }}">Cancel</a>
</form>
@endsection
