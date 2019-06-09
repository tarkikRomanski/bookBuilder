<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Services\BooksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class BookController extends Controller
{
    /** @var BooksService */
    private $booksService;

    /**
     * BookController constructor.
     * @param BooksService $booksService
     */
    public function __construct(BooksService $booksService)
    {
        $this->booksService = $booksService;
    }

    /**
     * Creates a new book
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        $createdBook = $this->booksService->createBook($request->get('name'));

        return $createdBook
            ? \response()->json(['book' => new BookResource($createdBook)])
            : \response()->json([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Returns list of the books
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /** todo: Add functionality */
        return \response()->json([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Returns the book
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return \response()->json(['book' => new BookResource($book)]);
    }

    /**
     * Updates the book
     * @param BookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        return $this->booksService->updateBook($book, $request->get('name'))
            ? \response()->json()
            : \response()->json([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Deletes the book
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        try {
            $deletedId = $book->id;
            $book->delete();
            return \response()->json(['deleted_id' => $deletedId]);
        } catch (Exception $e) {
            return \response()->json([], Response::HTTP_BAD_REQUEST);
        }
    }
}
