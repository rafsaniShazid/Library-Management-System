<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'category' => 'Fiction',
                'total_copies' => 5,
                'available_copies' => 5,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'category' => 'Fiction',
                'total_copies' => 3,
                'available_copies' => 2,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'category' => 'Dystopian Fiction',
                'total_copies' => 4,
                'available_copies' => 4,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category' => 'Romance',
                'total_copies' => 3,
                'available_copies' => 1,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'category' => 'Fiction',
                'total_copies' => 2,
                'available_copies' => 2,
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'category' => 'Computer Science',
                'total_copies' => 3,
                'available_copies' => 2,
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'category' => 'Programming',
                'total_copies' => 4,
                'available_copies' => 3,
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'category' => 'Philosophy',
                'total_copies' => 2,
                'available_copies' => 2,
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'category' => 'History',
                'total_copies' => 3,
                'available_copies' => 1,
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'category' => 'Fiction',
                'total_copies' => 2,
                'available_copies' => 0,
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
