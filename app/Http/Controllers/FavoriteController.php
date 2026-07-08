<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Book;
use App\Models\Favorite;
use App\Models\BookCategory;
class FavoriteController extends Controller
{
    public function toggle(Request $request, Book $book)
    {
        $user = auth()->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
            ]);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }

    public function myList()
    {
        $categories = BookCategory::latest()->take(7)->get();
        $books = auth()->user()->favoriteBooks()->latest()->get();
        $latestBooks = Book::latest()->take(8)->get();
        $allBooks    = Book::latest()->get();             // full list for sidebar
         if (auth()->check()) {
            $userFavoriteIds = auth()->user()->favoriteBooks()->pluck('books.id')->toArray();
        } else {
            $userFavoriteIds = [];
        }
        return view('user-layout.favorite-books', compact('books','allBooks','latestBooks', 'categories', 'userFavoriteIds'));
    }
    public function index()
    {
        $books = Book::latest()->get();
        $categories = BookCategory::latest()->take(7)->get();
        $latestBooks = Book::latest()->take(8)->get();
        $allBooks    = Book::latest()->get();             // full list for sidebar


        if (auth()->check()) {
            $userFavoriteIds = auth()->user()->favoriteBooks()->pluck('books.id')->toArray();
        } else {
            $userFavoriteIds = [];
        }

        return view('user-layout.master', compact('books', 'userFavoriteIds','categories','latestBooks','allBooks'));
    }
}
