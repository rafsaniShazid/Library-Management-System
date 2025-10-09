<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->exists ? 'Edit Book' : 'Add New Book' }} - Library Management</title>
    
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
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        h1 {
            font-size: 28px;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #718096;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #f56565;
            font-size: 13px;
            margin-top: 5px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
            flex: 1;
            text-align: center;
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
            background: #f7fafc;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #f56565;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-back:hover {
            background: rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('books.index') }}" class="nav-back">← Back to Manage Books</a>
            @else
                <a href="{{ route('books.index') }}" class="nav-back">← Back to Browse Books</a>
            @endif
        @else
            <a href="{{ route('books.index') }}" class="nav-back">← Back to Books</a>
        @endauth
        
        <div class="card">
            <h1>{{ $book->exists ? '✏️ Edit Book' : '➕ Add New Book' }}</h1>
            <p class="subtitle">{{ $book->exists ? 'Update the book information below' : 'Fill in the details to add a new book to the library' }}</p>

            @if($errors->any())
                <div class="alert alert-error">
                    <span style="font-size: 20px;">⚠️</span>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin-top: 5px; margin-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ $book->exists ? route('books.update', $book) : route('books.store') }}">
                @csrf
                @if($book->exists) @method('PATCH') @endif

                <div class="form-group">
                    <label for="title">Book Title *</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $book->title) }}" 
                        placeholder="e.g., The Great Gatsby"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="author">Author *</label>
                    <input 
                        type="text" 
                        id="author" 
                        name="author" 
                        value="{{ old('author', $book->author) }}" 
                        placeholder="e.g., F. Scott Fitzgerald"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <input 
                        type="text" 
                        id="category" 
                        name="category" 
                        value="{{ old('category', $book->category) }}" 
                        placeholder="e.g., Fiction, Science, History"
                    >
                </div>

                <div class="form-group">
                    <label for="total_copies">Total Copies *</label>
                    <input 
                        type="number" 
                        id="total_copies" 
                        name="total_copies" 
                        min="0" 
                        value="{{ old('total_copies', $book->total_copies ?? 1) }}" 
                        placeholder="0"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="available_copies">Available Copies *</label>
                    <input 
                        type="number" 
                        id="available_copies" 
                        name="available_copies" 
                        min="0" 
                        value="{{ old('available_copies', $book->available_copies ?? 1) }}" 
                        placeholder="0"
                        required
                    >
                    <p style="color: #718096; font-size: 13px; margin-top: 5px;">
                        Number of copies currently available for borrowing
                    </p>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        {{ $book->exists ? '💾 Update Book' : '➕ Add Book' }}
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
