<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $stats = [
            'total_books' => Book::count(),
            'total_copies' => Book::sum('total_copies'),
            'available_books' => Book::where('available_copies', '>', 0)->count(),
            'borrowed_books' => Book::sum('total_copies') - Book::sum('available_copies'),
            'total_users' => User::where('role', 'user')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'active_borrows' => Borrow::where('status', 'borrowed')->count(),
            'returned_books' => Borrow::where('status', 'returned')->count(),
        ];

        // Get recent borrows
        $recent_borrows = Borrow::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get popular books (most borrowed)
        $popular_books = Book::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->take(5)
            ->get();

        // Get available books
        $available_books = Book::where('available_copies', '>', 0)
            ->orderBy('title')
            ->take(8)
            ->get();

        // Get books by category
        $books_by_category = Book::select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        return view('welcome', compact(
            'stats',
            'recent_borrows',
            'popular_books',
            'available_books',
            'books_by_category'
        ));
    }
}
