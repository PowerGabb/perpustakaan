<?php

namespace App\Models;

use App\Models\NoRak;
use App\Models\Author;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function categories () {
        return $this->belongsToMany(Categories::class, 'book_categories');
    }

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noRak(): BelongsTo
    {
        return $this->belongsTo(NoRak::class, 'rak_id');
    }

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function publisher () {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
}
