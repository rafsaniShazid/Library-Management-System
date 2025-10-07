<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Library')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body { font-family: system-ui, sans-serif; margin:0; }
    header, footer { background:#f5f5f5; padding:12px 16px; }
    main { max-width: 980px; margin: 0 auto; padding: 16px; }
    nav a { margin-right: 12px; }
    table { width:100%; border-collapse: collapse; }
    th, td { padding:8px; border-bottom:1px solid #e5e7eb; text-align:left; }
    form.inline { display:inline; margin:0; }
    .btn { padding:6px 10px; border:1px solid #ddd; border-radius:6px; background:#fafafa; cursor:pointer; }
    .btn:focus { outline: 2px solid #000; }
  </style>
</head>
<body>
  <header>
    <strong>Library</strong>
    <nav style="display:inline-block; margin-left:16px;">
      <a href="{{ route('books.index') }}">Books</a>
      <a href="{{ route('borrows.index') }}">My Borrows</a>
      <a href="{{ route('books.create') }}">Add Book</a>
    </nav>
  </header>
  <main>
    <x-flash />
    <x-errors />
    @yield('content')
  </main>
  <footer><small>&copy; {{ date('Y') }} Library</small></footer>
</body>
</html>
