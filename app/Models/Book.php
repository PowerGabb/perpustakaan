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

    protected $guarded = [''];


    public function categories () {
        return $this->belongsToMany(Categories::class, 'book_categories');
    }

}
