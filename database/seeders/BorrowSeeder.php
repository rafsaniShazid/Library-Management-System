<?php

namespace Database\Seeders;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and books to create borrow records
        $users = User::all();
        $books = Book::all();

        if ($users->count() > 0 && $books->count() > 0) {
            $borrows = [
                [
                    'user_id' => $users->first()->id, // First user
                    'book_id' => $books->where('title', 'To Kill a Mockingbird')->first()->id,
                    'borrow_date' => now()->subDays(10)->toDateString(),
                    'return_date' => null,
                    'status' => 'borrowed',
                ],
                [
                    'user_id' => $users->first()->id,
                    'book_id' => $books->where('title', 'Pride and Prejudice')->first()->id,
                    'borrow_date' => now()->subDays(15)->toDateString(),
                    'return_date' => null,
                    'status' => 'borrowed',
                ],
                [
                    'user_id' => $users->first()->id,
                    'book_id' => $books->where('title', 'Introduction to Algorithms')->first()->id,
                    'borrow_date' => now()->subDays(5)->toDateString(),
                    'return_date' => null,
                    'status' => 'borrowed',
                ],
                [
                    'user_id' => $users->first()->id,
                    'book_id' => $books->where('title', 'Clean Code')->first()->id,
                    'borrow_date' => now()->subDays(20)->toDateString(),
                    'return_date' => now()->subDays(3)->toDateString(),
                    'status' => 'returned',
                ],
                [
                    'user_id' => $users->first()->id,
                    'book_id' => $books->where('title', 'Sapiens')->first()->id,
                    'borrow_date' => now()->subDays(12)->toDateString(),
                    'return_date' => null,
                    'status' => 'borrowed',
                ],
                [
                    'user_id' => $users->first()->id,
                    'book_id' => $books->where('title', 'The Alchemist')->first()->id,
                    'borrow_date' => now()->subDays(8)->toDateString(),
                    'return_date' => null,
                    'status' => 'borrowed',
                ],
            ];

            foreach ($borrows as $borrow) {
                Borrow::create($borrow);
            }
        }
    }
}
