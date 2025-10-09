<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Borrows - Library Management System</title>
    
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

        .btn-small {
            padding: 6px 14px;
            font-size: 13px;
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

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #718096;
        }

        /* Tabs */
        .tabs {
            background: white;
            border-radius: 15px;
            padding: 20px 30px 0;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .tab-buttons {
            display: flex;
            gap: 10px;
            border-bottom: 2px solid #f7fafc;
        }

        .tab-button {
            padding: 12px 24px;
            border: none;
            background: transparent;
            color: #718096;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-button:hover {
            color: #667eea;
        }

        /* Borrow Cards */
        .borrow-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .borrow-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 25px;
            align-items: center;
            transition: all 0.3s ease;
        }

        .borrow-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .book-icon-large {
            font-size: 64px;
        }

        .borrow-info h3 {
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .borrow-info .author {
            font-size: 14px;
            color: #718096;
            margin-bottom: 12px;
        }

        .borrow-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #718096;
        }

        .meta-icon {
            font-size: 16px;
        }

        .borrow-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-borrowed {
            background: #fed7d7;
            color: #742a2a;
        }

        .badge-returned {
            background: #c6f6d5;
            color: #22543d;
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
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .borrow-card {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .book-icon-large {
                font-size: 48px;
            }

            .borrow-actions {
                align-items: center;
            }

            .borrow-meta {
                justify-content: center;
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
                    <h1>📖 My Borrowed Books</h1>
                    <p style="color: #718096; font-size: 14px; margin-top: 5px;">
                        Manage your borrowed books and return history
                    </p>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">← Dashboard</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('books.index') }}" class="btn btn-primary">🔧 Manage Books</a>
                    @else
                        <a href="{{ route('books.index') }}" class="btn btn-primary">📚 Browse Books</a>
                    @endif
                </div>
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

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-value">{{ $borrows->total() }}</div>
                <div class="stat-label">Total Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📤</div>
                <div class="stat-value">{{ $borrows->where('status', 'borrowed')->count() }}</div>
                <div class="stat-label">Currently Borrowed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📥</div>
                <div class="stat-value">{{ $borrows->where('status', 'returned')->count() }}</div>
                <div class="stat-label">Returned</div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab-buttons">
                <button class="tab-button active" onclick="filterBorrows('all')">
                    📚 All Borrows
                </button>
                <button class="tab-button" onclick="filterBorrows('borrowed')">
                    📤 Currently Borrowed
                </button>
                <button class="tab-button" onclick="filterBorrows('returned')">
                    📥 Returned
                </button>
            </div>
        </div>

        <!-- Borrow List -->
        @if($borrows->count() > 0)
            <div class="borrow-list" id="borrowList">
                @foreach($borrows as $borrow)
                    <div class="borrow-card" data-status="{{ $borrow->status }}">
                        <div class="book-icon-large">📕</div>
                        
                        <div class="borrow-info">
                            <h3>{{ $borrow->book->title }}</h3>
                            <p class="author">by {{ $borrow->book->author }}</p>
                            
                            <div class="borrow-meta">
                                <div class="meta-item">
                                    <span class="meta-icon">📅</span>
                                    <span>Borrowed: {{ $borrow->borrow_date->format('M d, Y') }}</span>
                                </div>
                                @if($borrow->return_date)
                                    <div class="meta-item">
                                        <span class="meta-icon">✅</span>
                                        <span>Returned: {{ $borrow->return_date->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                <div class="meta-item">
                                    <span class="meta-icon">📂</span>
                                    <span>{{ $borrow->book->category }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="borrow-actions">
                            <span class="status-badge {{ $borrow->status === 'borrowed' ? 'badge-borrowed' : 'badge-returned' }}">
                                {{ $borrow->status === 'borrowed' ? '📤 Borrowed' : '✅ Returned' }}
                            </span>
                            
                            @if($borrow->status === 'borrowed')
                                <form action="{{ route('borrows.return', $borrow->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-small">
                                        📥 Return Book
                                    </button>
                                </form>
                            @endif
                            
                            <a href="{{ route('books.show', $borrow->book->id) }}" class="btn btn-outline btn-small">
                                📖 View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $borrows->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📚</div>
                <h3>No Borrow Records</h3>
                <p>You haven't borrowed any books yet.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary">Browse Books</a>
            </div>
        @endif
    </div>

    <script>
        function filterBorrows(status) {
            // Update active tab
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter cards
            const cards = document.querySelectorAll('.borrow-card');
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'grid';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
