<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewedBook extends Model
{
    //
    protected $fillable = ['user_id', 'book_id', 'viewed_at'];
    public $timestamps = false;

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
