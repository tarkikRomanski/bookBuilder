<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Chapter
 *
 * @package App
 * @property string $title
 * @property string $content
 * @property int $order
 * @property-read Book $book
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $show
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
