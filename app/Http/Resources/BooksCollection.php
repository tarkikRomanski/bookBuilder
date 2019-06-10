<?php

namespace App\Http\Resources;

use App\Book;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BooksCollection
 * @package App\Http\Resources
 */
class BooksCollection extends ResourceCollection
{
    /** @var array */
    private $pagination;

    /**
     * BooksCollection constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage()
        ];

        parent::__construct($resource->getCollection());
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(static function (Book $book) {
                return [
                    'id' => $book->id,
                    'name' => $book->name,
                    'created' => $book->created_at->toDateTimeString(),
                    'authors' => $book->users->map( static function(User $user) {
                        return [
                            'id' => $user->id,
                            'email' => $user->email,
                        ];
                    }),
                ];
            }),
            'pagination' => $this->pagination,
        ];
    }
}
