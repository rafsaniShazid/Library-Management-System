<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} - Library Management System</title>
    
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav-bar {
            margin-bottom: 20px;
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

        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a67d8;
        }

        .btn-success {
            background: #48bb78;
            color: white;
        }

        .btn-success:hover {
            background: #38a169;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .book-cover {
            text-align: center;
            margin-bottom: 25px;
        }

        .book-icon {
            font-size: 120px;
            margin-bottom: 20px;
        }

        .book-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-available {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-unavailable {
            background: #fed7d7;
            color: #742a2a;
        }

        .book-header h1 {
            font-size: 32px;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .book-author {
            font-size: 18px;
            color: #718096;
            margin-bottom: 20px;
        }

        .book-category {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .book-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: #f7fafc;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-label {
            font-size: 13px;
            color: #718096;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
        }

        .stat-value.available {
            color: #48bb78;
        }

        .stat-value.unavailable {
            color: #f56565;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f7fafc;
        }

        .borrow-history {
            max-height: 400px;
            overflow-y: auto;
        }

        .borrow-item {
            padding: 15px;
            background: #f7fafc;
            border-radius: 10px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .borrow-user {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .borrow-date {
            font-size: 13px;
            color: #718096;
        }

        .borrow-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-borrowed {
            background: #fed7d7;
            color: #742a2a;
        }

        .badge-returned {
            background: #c6f6d5;
            color: #22543d;
        }

        .empty-history {
            text-align: center;
            padding: 40px 20px;
            color: #a0aec0;
        }

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

        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .book-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <div class="nav-bar">
            <a href="{{ route('books.index') }}" class="btn btn-outline">← Back to Books</a>
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

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Book Cover / Info -->
            <div class="card">
                <div class="book-cover">
                    <div class="book-icon">📕</div>
                    <div class="book-status {{ $book->available_copies > 0 ? 'status-available' : 'status-unavailable' }}">
                        {{ $book->available_copies > 0 ? '✅ Available' : '❌ Unavailable' }}
                    </div>
                </div>

                <div class="book-stats">
                    <div class="stat-box">
                        <div class="stat-label">Total Copies</div>
                        <div class="stat-value">{{ $book->total_copies }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Available</div>
                        <div class="stat-value {{ $book->available_copies > 0 ? 'available' : 'unavailable' }}">
                            {{ $book->available_copies }}
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    @if($book->available_copies > 0)
                        <form action="{{ route('borrows.store', $book->id) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn btn-success" style="width: 100%;">
                                📤 Borrow This Book
                            </button>
                        </form>
                    @else
                        <button class="btn" style="background: #e2e8f0; color: #a0aec0; cursor: not-allowed; width: 100%;" disabled>
                            ❌ Currently Unavailable
                        </button>
                    @endif
                </div>
            </div>

            <!-- Book Details -->
            <div class="card">
                <div class="book-header">
                    <h1>{{ $book->title }}</h1>
                    <p class="book-author">by {{ $book->author }}</p>
                    <span class="book-category">{{ $book->category }}</span>
                </div>

                <h2 class="section-title">📋 Borrow History</h2>
                
                <div class="borrow-history">
                    @if($book->borrows->count() > 0)
                        @foreach($book->borrows as $borrow)
                            <div class="borrow-item">
                                <div>
                                    <div class="borrow-user">{{ $borrow->user->name }}</div>
                                    <div class="borrow-date">
                                        Borrowed: {{ $borrow->borrow_date->format('M d, Y') }}
                                        @if($borrow->return_date)
                                            | Returned: {{ $borrow->return_date->format('M d, Y') }}
                                        @endif
                                    </div>
                                </div>
                                <span class="borrow-badge {{ $borrow->status === 'borrowed' ? 'badge-borrowed' : 'badge-returned' }}">
                                    {{ ucfirst($borrow->status) }}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-history">
                            <div style="font-size: 48px; margin-bottom: 10px;">📚</div>
                            <p>No borrow history yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
