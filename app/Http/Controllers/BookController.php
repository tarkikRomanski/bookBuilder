<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return void
     */
    public function store(BookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Book $book)
    {
        return view('books.preview', compact($book));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact($book));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return void
     */
    public function update(BookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        try {
            $book->delete();
            return redirect()->route('books.index');
        } catch (\Exception $e) {
            return redirect()->route('books.index');
        }
    }
}
