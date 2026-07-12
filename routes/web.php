<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\book\AddBookController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\FavoriteController; 
use App\Http\Controllers\ViewedBookController;
use App\Http\Controllers\ChatbotController;    

Route::get('/auth/register', function () {
return view('auth.register');
});
Route::post('/auth/register', [RegisterController::class,'register'])->name('register');
Route::get('/auth/login', function () {
return view('auth.login');
});
Route::get('/auth/forget-password', function(){
    return view('auth.forget-password');
});
Route::post('/auth/login', [LoginController::class,'login'])->name('login');
Route::post('/logout', function () {
Auth::logout();
    return redirect('/auth/login');
})->name('logout');
Route::get('/', [AddBookController::class,'index'])->name('home');
Route::middleware('auth')->post('/books/{book}/view', [ViewedBookController::class, 'store'])
    ->name('books.view');
Route::get('/', [ViewedBookController::class,'index']);
Route::post('/books/{id}/log-read', [AddBookController::class, 'logRead'])
     ->name('books.logRead')
     ->middleware('auth');
Route::get('/books/{id}/read', [AddBookController::class, 'readBook'])
     ->name('books.read')
     ->middleware('auth');
Route::middleware(['auth'])->group(function () {
    
    Route::get('/book', function () {
    return view('books.index');
    });
    Route::get('/book/{id}', [AddBookController::class, 'show'])->name('books.show');
    Route::get('/all-books', [AddBookController::class, 'index'])
        ->name('books.index');
    Route::get('/all-books', [AddBookController::class,'allBooks'])->name('/books.index');
    Route::get('/profile', function(){
        return view('user-profile.index');
    });
    Route::post('/books/{book}/favorite', [FavoriteController::class, 'toggle']);
    Route::get('/favorites', [FavoriteController::class, 'myList'])->name('favorites.index');
    Route::get('/books/search', [AddBookController::class, 'searchBar'])
    ->name('books.search');
});
Route::middleware(['auth', 'admin'])->group(function () {

    Route::put('/users/{id}/role', [RegisterController::class, 'updateRole'])
        ->name('users.role.update');

    Route::get('users', [RegisterController::class,'index'])->name('users');
    Route::delete('/users/{id}', [RegisterController::class, 'destroy'])->name('users.destroy');
    Route::delete('/books/{id}', [AddBookController::class, 'destroy'])
        ->name('books.delete');
    Route::delete('/category/{id}', [BookCategoryController::class, 'destroy'])
        ->name('categories.destroy');
    Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

});
Route::middleware(['auth','role:admin,member'])->group(function () {
   Route::get('/add-book', function () {
    return view('books.create');
    });
        Route::get('admin', [AddBookController::class,'adminHome'])->name('welcome');

    Route::post('/add-book', [AddBookController::class,'addBook'])->name('/add-book');
    Route::get('/books/{id}/edit', [AddBookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [AddBookController::class, 'update'])->name('books.update');
    Route::get('/add-book-categories', function () {
    return view('book_category.create');
    });
    Route::post('/add-book-category', [BookCategoryController::class,'store'])->name('add-book-category');
    Route::get('/add-book', [AddBookController::class,'create']);
    Route::get('/book-categories', [BookCategoryController::class, 'allCategories'])
    ->name('book_categories.index');
    Route::get('/search-books', [AddBookController::class, 'search'])
    ->name('books.search');
    Route::get('/books/search-suggestions', [AddBookController::class, 'searchSuggestions'])->name('books.search.suggestions');

});
