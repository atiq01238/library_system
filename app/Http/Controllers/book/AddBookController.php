<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\Book;
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
        $books = Book::latest()->take(5)->get();
        return view('user-layout.master', compact('books'));
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
        return view('books.edit', compact('book'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'book_name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $book = Book::findOrFail($id);

        // if new image uploaded
        if ($request->hasFile('book_image')) {

            // delete old image
            $oldImage = public_path('uploads/books/' . $book->book_image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            // upload new image
            $imageName = time() . '.' . $request->book_image->extension();
            $request->book_image->move(public_path('uploads/books'), $imageName);

            $book->book_image = $imageName;
        }

        // update other fields
        $book->book_name = $request->book_name;
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
}
