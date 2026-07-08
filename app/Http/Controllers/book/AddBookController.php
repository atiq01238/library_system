<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
class AddBookController extends Controller
{
    //
    public function addBook(request $request)
    {
    //  dd($request->all());
   $request->validate([
        'book_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'book_name' => 'required|string|max:255',
        'author_name' => 'required|string|max:255',
        'category_id' => 'required|exists:book_categories,id',
        'description' => 'required|string',
        'book_pdf' => 'required|mimes:pdf|max:10240',

    ]);
    // dd($request->all());
    if (!$request->hasFile('book_image')) {
        return back()->withErrors(['book_image' => 'Please upload a book image'])->withInput();
    }

    $imageName = time() . '.' . $request->book_image->extension();
    $request->book_image->move(public_path('uploads/books'), $imageName);

    $pdfName = null;

    if ($request->hasFile('book_pdf')) {
        $pdfName = time().'_'.$request->book_pdf->getClientOriginalName();
        $request->book_pdf->move(public_path('uploads/pdfs'), $pdfName);
    }

    Book::create([
        'book_image' => $imageName,
        'book_name' => $request->book_name,
        'author_name' => $request->author_name,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'book_pdf' => $pdfName,

    ]);

    return back()->with('success', 'Book added successfully');
    }


    public function index()
    {
        $books = Book::latest()->take(4)->get();
        $latestBooks = Book::latest()->take(8)->get();
        $allBooks = Book::latest()->get();
        $categories = BookCategory::latest()->take(7)->get();

        if (auth()->check()) {
            $userFavoriteIds = auth()->user()->favoriteBooks()->pluck('books.id')->toArray();
            $favoriteBooks = auth()->user()->favoriteBooks()->latest()->get();
            $readBooksCount = auth()->check() ? auth()->user()->readBooks()->count() : 0;
        } else {
            $userFavoriteIds = [];
            $favoriteBooks = collect();
            $readBooksCount = 0; 
        }

        return view('user-layout.master', compact(
            'books',
            'categories',
            'latestBooks',
            'allBooks',
            'userFavoriteIds',
            'favoriteBooks',
            'readBooksCount' 
        ));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
    public function allBooks()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // delete image file (optional but good)
        $imagePath = public_path('uploads/books/' . $book->book_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $book->delete();

        return back()->with('success', 'Book deleted successfully 🗑');
    }
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = BookCategory::orderBy('category_name', 'asc')->get();
        return view('books.edit', compact('book','categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'book_name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:book_categories,id',
            'description' => 'required|string',
        ]);
        // dd($request->all());
        $book = Book::findOrFail($id);

        if ($request->hasFile('book_image')) {

            $oldImage = public_path('uploads/books/' . $book->book_image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $imageName = time() . '.' . $request->book_image->extension();
            $request->book_image->move(public_path('uploads/books'), $imageName);

            $book->book_image = $imageName;
        }

        $book->book_name = $request->book_name;
        $book->author_name = $request->author_name; 
        $book->category_id = $request->category_id;
        $book->description = $request->description;
        $book->save();

       return redirect()->route('/books.index')->with('success', 'Book updated successfully ✏️');
    }
   public function create()
    {
        $categories = BookCategory::orderBy('category_name', 'asc')->get();

        return view('books.create', compact('categories'));
    }
    public function search(Request $request)
    {
        $books = Book::where('book_name', 'LIKE', '%' . $request->search . '%')
                    ->get();

        return view('books.search-result', compact('books'));
    }
    public function adminHome()
    {
        $totalBooks = Book::count();
        $totalCategories = BookCategory::count();
        $totalUsers = User::count();
        $overdueBooks = Book::where('due_date', '<', now())
                            ->where('status', 'borrowed');

        $recentBooks = Book::with('category')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('welcome', compact(
            'totalBooks',
            'totalCategories',
            'totalUsers',
            'overdueBooks',
            'recentBooks'
        ));
    }
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $books = Book::where('book_name', 'like', "%{$query}%")
                    ->orWhere('arthur_name', 'like', "%{$query}%")
                    ->take(8)
                    ->get(['id', 'book_name', 'arthur_name', 'book_image']);

        return response()->json($books);
    }
  public function logRead($id)
    {
        $book = Book::findOrFail($id);

        auth()->user()->readBooks()->syncWithoutDetaching([
            $book->id => ['read_at' => now()]
        ]);

        return response()->json([
            'readCount' => auth()->user()->readBooks()->count()
        ]);
    }
    public function readBook($id)
    {
        $book = Book::findOrFail($id);

        auth()->user()->readBooks()->syncWithoutDetaching([
            $book->id => ['read_at' => now()]
        ]);

        $pdfPath = public_path('uploads/pdfs/' . $book->book_pdf);

        if (!file_exists($pdfPath)) {
            abort(404, 'PDF not found');
        }

        return response()->file($pdfPath);
    }
    public function searchBar(Request $request)
    {
        $search = $request->search;

        $books = Book::with('category')
            ->where('book_name', 'like', "%{$search}%")
            ->orWhere('author_name', 'like', "%{$search}%")
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('category_name', 'like', "%{$search}%");
            })
            ->get();

        return view('user.search', compact('books', 'search'));
    }
}
