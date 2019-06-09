<?php

namespace App\Services;

use App\Book;
use Carbon\Carbon;

/**
 * Class BooksService
 * @package App\Services
 */
class BooksService
{
    /**
     * Creates a new book
     * @param string $name
     * @return Book
     */
    public function createBook(string $name): Book
    {
        /** @var Book $book */
        $book = Book::create([
            'name' => $name,
        ]);

        $book->users()->save(auth()->user());

        return $book;
    }

    /**
     * Updates the books
     * @param Book $book
     * @param string $name
     * @return bool
     */
    public function updateBook(Book $book, string $name): bool
    {
        return $book->update([
            'name' => $name,
        ]);
    }

    /**
     * Archives the book
     * @param Book $book
     * @return bool
     */
    public function archiveBook(Book $book): bool
    {
        return $book->update([
            'archived_at' => Carbon::now(),
        ]);
    }

    /**
     * Unarchive the books
     * @param Book $book
     * @return bool
     */
    public function unarchiveBook(Book $book): bool
    {
        return $book->update([
            'archived_at' => null,
        ]);
    }
}
