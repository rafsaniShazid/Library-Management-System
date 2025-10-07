<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Books - Library Management System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background: white;
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-success {
            background: #48bb78;
            color: white;
        }

        .btn-success:hover {
            background: #38a169;
        }

        /* Search Bar */
        .search-bar {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-input {
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #48bb78;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #f56565;
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .book-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border-color: #667eea;
        }

        .book-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 15px;
        }

        .book-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            min-height: 50px;
        }

        .book-author {
            font-size: 14px;
            color: #718096;
            margin-bottom: 12px;
        }

        .book-category {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .book-copies {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background: #f7fafc;
            border-radius: 8px;
        }

        .copy-info {
            text-align: center;
        }

        .copy-label {
            font-size: 11px;
            color: #718096;
            margin-bottom: 4px;
        }

        .copy-value {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
        }

        .copy-value.available {
            color: #48bb78;
        }

        .copy-value.unavailable {
            color: #f56565;
        }

        .book-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
            flex: 1;
        }

        /* Pagination */
        .pagination-wrapper {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .empty-state {
            background: white;
            border-radius: 15px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #718096;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .search-input {
                width: 100%;
            }

            .header-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <div>
                    <h1>📚 Browse Books</h1>
                    <p style="color: #718096; font-size: 14px; margin-top: 5px;">
                        Explore our collection of {{ $books->total() }} books
                    </p>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">← Dashboard</a>
                    <a href="{{ route('borrows.index') }}" class="btn btn-primary">My Borrows</a>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="🔍 Search books by title, author, or category..." id="searchInput">
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('status'))
            <div class="alert alert-success">
                <span style="font-size: 20px;">✅</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <span style="font-size: 20px;">⚠️</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        <div class="book-icon">📕</div>
                        <h3 class="book-title">{{ $book->title }}</h3>
                        <p class="book-author">by {{ $book->author }}</p>
                        <span class="book-category">{{ $book->category }}</span>
                        
                        <div class="book-copies">
                            <div class="copy-info">
                                <div class="copy-label">Total Copies</div>
                                <div class="copy-value">{{ $book->total_copies }}</div>
                            </div>
                            <div class="copy-info">
                                <div class="copy-label">Available</div>
                                <div class="copy-value {{ $book->available_copies > 0 ? 'available' : 'unavailable' }}">
                                    {{ $book->available_copies }}
                                </div>
                            </div>
                        </div>

                        <div class="book-actions">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline btn-small">
                                📖 Details
                            </a>
                            @if($book->available_copies > 0)
                                <form action="{{ route('borrows.store', $book->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-small" style="width: 100%;">
                                        📤 Borrow
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-small" style="background: #e2e8f0; color: #a0aec0; cursor: not-allowed; flex: 1;" disabled>
                                    ❌ Unavailable
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $books->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📚</div>
                <h3>No Books Found</h3>
                <p>There are no books in the library at the moment.</p>
            </div>
        @endif
    </div>

    <script>
        // Simple client-side search
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const bookCards = document.querySelectorAll('.book-card');
            
            bookCards.forEach(card => {
                const title = card.querySelector('.book-title').textContent.toLowerCase();
                const author = card.querySelector('.book-author').textContent.toLowerCase();
                const category = card.querySelector('.book-category').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || author.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
