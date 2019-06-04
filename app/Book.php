<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Book
 * @package App
 * @property string $name
 * @property-read User $user
 * @property-read Chapter[]|Collection $chapters
 */
class Book extends Model
{
    /** @var array */
    protected $fillable = [
        'name',
    ];

    /**
     * Relation to owner of the book
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to chapters
     * @return HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
