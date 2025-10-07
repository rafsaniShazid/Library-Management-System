@extends('layouts.app')
@section('title','My Borrows')
@section('content')
<h1>My Borrows</h1>

<table>
  <thead>
    <tr><th>Book</th><th>Borrowed</th><th>Returned</th><th>Status</th><th>Action</th></tr>
  </thead>
  <tbody>
  @forelse($borrows as $b)
    <tr>
      <td>{{ $b->book->title ?? 'Unknown' }}</td>
      <td>{{ $b->borrow_date }}</td>
      <td>{{ $b->return_date ?? '-' }}</td>
      <td>{{ ucfirst($b->status) }}</td>
      <td>
        @if($b->status === 'borrowed')
          <form class="inline" action="{{ route('borrows.return', $b->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Return</button>
          </form>
        @endif
      </td>
    </tr>
  @empty
    <tr><td colspan="5">No borrows yet.</td></tr>
  @endforelse
  </tbody>
</table>

<div style="margin-top:12px;">{{ $borrows->links() }}</div>
@endsection
