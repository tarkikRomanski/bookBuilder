<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Chapter
 * @package App
 * @property string $title
 * @property string $content
 * @property int $order
 * @property-read Book $book
 */
class Chapter extends Model
{
    /** @var array */
    protected $fillable = [
        'title',
        'content',
        'order',
    ];

    /**
     * Relation to book which content the chapter
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
