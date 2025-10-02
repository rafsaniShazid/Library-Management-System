<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'borrow_date' => 'date',
            'return_date' => 'date',
        ];
    }

    /**
     * Get the user that owns the borrow.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that was borrowed.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Check if the book is currently borrowed.
     */
    public function isBorrowed()
    {
        return $this->status === 'borrowed';
    }

    /**
     * Check if the book has been returned.
     */
    public function isReturned()
    {
        return $this->status === 'returned';
    }

    /**
     * Mark the book as returned.
     */
    public function markAsReturned()
    {
        $this->update([
            'return_date' => now()->toDateString(),
            'status' => 'returned'
        ]);
    }
}
