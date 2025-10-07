<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System - Dashboard</title>
    
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
            font-weight: 700;
        }

        .header-subtitle {
            color: #718096;
            font-size: 14px;
            margin-top: 5px;
        }

        .header-nav {
            display: flex;
            gap: 15px;
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
            cursor: pointer;
        }

        .btn-primary {
            background: #667eea;
            color: white;
            border: none;
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-icon.blue { background: #e6f0ff; color: #667eea; }
        .stat-icon.green { background: #e6fff9; color: #48bb78; }
        .stat-icon.purple { background: #f3e8ff; color: #9f7aea; }
        .stat-icon.orange { background: #fff5e6; color: #ed8936; }

        .stat-label {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .stat-value {
            color: #2d3748;
            font-size: 32px;
            font-weight: 700;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f7fafc;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
        }

        .view-all {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .view-all:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }

        .book-card {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .book-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .book-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .book-title {
            font-size: 15px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-author {
            font-size: 13px;
            color: #718096;
            margin-bottom: 10px;
        }

        .book-category {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .book-availability {
            font-size: 12px;
            color: #48bb78;
            font-weight: 500;
        }

        .book-availability.unavailable {
            color: #f56565;
        }

        /* Categories */
        .category-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: #f7fafc;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .category-item:hover {
            background: #edf2f7;
            transform: translateX(5px);
        }

        .category-name {
            font-size: 14px;
            font-weight: 500;
            color: #2d3748;
        }

        .category-count {
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Popular Books */
        .popular-list {
            list-style: none;
        }

        .popular-item {
            padding: 15px 0;
            border-bottom: 1px solid #f7fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popular-item:last-child {
            border-bottom: none;
        }

        .popular-info h4 {
            font-size: 15px;
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .popular-info p {
            font-size: 13px;
            color: #718096;
        }

        .popular-badge {
            background: #48bb78;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Activity List */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #f7fafc;
            display: flex;
            align-items: start;
            gap: 15px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f7fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 20px;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 14px;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #a0aec0;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #a0aec0;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>📚 Library Management System</h1>
                <p class="header-subtitle">Welcome to your digital library dashboard</p>
            </div>
            <div class="header-nav">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('books.index') }}" class="btn btn-outline">Browse Books</a>
                        <a href="{{ route('borrows.index') }}" class="btn btn-outline">My Borrows</a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">📚</div>
                <div class="stat-label">Total Books</div>
                <div class="stat-value">{{ $stats['total_books'] ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">✅</div>
                <div class="stat-label">Available Books</div>
                <div class="stat-value">{{ $stats['available_books'] ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple">📖</div>
                <div class="stat-label">Books Borrowed</div>
                <div class="stat-value">{{ $stats['borrowed_books'] ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">👥</div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Available Books -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">📕 Available Books</h2>
                    <a href="{{ route('books.index') }}" class="view-all">View All →</a>
                </div>
                @if(isset($available_books) && $available_books->count() > 0)
                    <div class="books-grid">
                        @foreach($available_books as $book)
                            <div class="book-card">
                                <div class="book-icon">📕</div>
                                <div class="book-title">{{ Str::limit($book->title, 30) }}</div>
                                <div class="book-author">{{ Str::limit($book->author, 25) }}</div>
                                <div class="book-category">{{ $book->category }}</div>
                                <div class="book-availability {{ $book->available_copies == 0 ? 'unavailable' : '' }}">
                                    {{ $book->available_copies }} available
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📚</div>
                        <p>No books available at the moment</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Categories -->
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-header">
                        <h2 class="card-title">📂 Categories</h2>
                    </div>
                    @if(isset($books_by_category) && $books_by_category->count() > 0)
                        <div class="category-list">
                            @foreach($books_by_category as $category)
                                <div class="category-item">
                                    <span class="category-name">{{ $category->category }}</span>
                                    <span class="category-count">{{ $category->count }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <p>No categories found</p>
                        </div>
                    @endif
                </div>

                <!-- Popular Books -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">🔥 Popular Books</h2>
                    </div>
                    @if(isset($popular_books) && $popular_books->count() > 0)
                        <ul class="popular-list">
                            @foreach($popular_books as $book)
                                <li class="popular-item">
                                    <div class="popular-info">
                                        <h4>{{ Str::limit($book->title, 30) }}</h4>
                                        <p>{{ Str::limit($book->author, 25) }}</p>
                                    </div>
                                    <div class="popular-badge">{{ $book->borrows_count }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <p>No borrow history yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">📋 Recent Activity</h2>
                <a href="{{ route('borrows.index') }}" class="view-all">View All →</a>
            </div>
            @if(isset($recent_borrows) && $recent_borrows->count() > 0)
                <ul class="activity-list">
                    @foreach($recent_borrows as $borrow)
                        <li class="activity-item">
                            <div class="activity-icon">
                                {{ $borrow->status === 'borrowed' ? '📤' : '📥' }}
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    <strong>{{ $borrow->user->name }}</strong> 
                                    {{ $borrow->status === 'borrowed' ? 'borrowed' : 'returned' }}
                                    <strong>{{ $borrow->book->title }}</strong>
                                </div>
                                <div class="activity-time">
                                    {{ $borrow->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📋</div>
                    <p>No recent activity</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
