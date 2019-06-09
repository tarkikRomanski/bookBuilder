<?php

namespace App\Http\Resources;

use App\Book;
use App\Chapter;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Book $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'authors' => $resource->users->map([$this, 'authorsMapper']),
            'chapters' => $resource->chapters->map([$this, 'chaptersMapper']),
            'archived' => $resource->archived_at,
        ];
    }

    /**
     * Processes chapters of the book
     * @param Chapter $chapter
     * @return array
     */
    public function chaptersMapper(Chapter $chapter): array
    {
        return [
            'id' => $chapter->id,
            'name' => $chapter->title,
            'show' => $chapter->show,
            'order' => $chapter->order,
        ];
    }

    /**
     * Processes authors of the book
     * @param User $user
     * @return array
     */
    public function authorsMapper(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
        ];
    }
}
