<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        "book_image",
        "book_name",
        "author_name",
        "category_id",
        "description",
        "book_pdf",

    ];
    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(
            User::class,
            'favorites',
            'book_id',
            'user_id'
        )->withTimestamps();
    }
}
