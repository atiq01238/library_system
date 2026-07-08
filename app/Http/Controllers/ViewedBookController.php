<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\ViewedBook;
use App\Models\BookCategory;

class ViewedBookController extends Controller
{
   public function index()
{
    $books = Book::all();
    $allBooks = Book::all();
    $categories = BookCategory::with('books')->get();
    $latestBooks = Book::latest()->take(8)->get();

    $favoriteBooks = collect();
    $userFavoriteIds = [];
    $viewedBooksCount = 0;

    if (auth()->check()) {
        $favoriteBooks = auth()->user()->favoriteBooks; // adjust to however your Favorite relation/model works
        $userFavoriteIds = $favoriteBooks->pluck('id')->toArray();

        $viewedBooksCount = ViewedBook::where('user_id', auth()->id())->count();
    }

    return view('user-layout.master', compact(
        'books',
        'allBooks',
        'categories',
        'latestBooks',
        'favoriteBooks',
        'userFavoriteIds',
        'viewedBooksCount'
    ));
}
    public function store(Book $book)
    {
        ViewedBook::updateOrCreate(
            ['user_id' => auth()->id(), 'book_id' => $book->id],
            ['viewed_at' => now()]
        );

        $count = ViewedBook::where('user_id', auth()->id())->count();

        return response()->json(['status' => 'viewed', 'count' => $count]);
    }
}
