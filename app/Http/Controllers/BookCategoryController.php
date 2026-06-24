<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller
{
    //
    public function allCategories()
    {
        $categories = BookCategory::all();

        return view('book_category.index', compact('categories'));
    }
    public function store(Request $request)
    {
    $request->validate([
        'category_name'=>['required','string'],
    ]);
    // dd($request->all());
    BookCategory::create([
        'category_name' => $request->category_name,
    ]);

    return redirect()->back()->with('success', 'Category added successfully');
    }   
    public function destroy($id)
    {
        $category = BookCategory::findOrFail($id);

        $category->delete();

        return back()->with('success', 'Category deleted successfully 🗑️');
    }
    
    
}
