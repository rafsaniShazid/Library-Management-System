<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'category',
        'total_copies',
        'available_copies',
    ];

    /**
     * Get the borrows for the book.
     */
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    /**
     * Get the currently borrowed instances of this book.
     */
    public function currentBorrows()
    {
        return $this->hasMany(Borrow::class)->where('status', 'borrowed');
    }

    /**
     * Check if book is available for borrowing.
     */
    public function isAvailable()
    {
        return $this->available_copies > 0;
    }

    /**
     * Decrease available copies when book is borrowed.
     */
    public function borrowCopy()
    {
        if ($this->available_copies > 0) {
            $this->decrement('available_copies');
            return true;
        }
        return false;
    }

    /**
     * Increase available copies when book is returned.
     */
    public function returnCopy()
    {
        if ($this->available_copies < $this->total_copies) {
            $this->increment('available_copies');
            return true;
        }
        return false;
    }
}
