<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);
        $message = strtolower(trim($request->message));

        // --- 1. User asking about interests/genres/categories ---
        if (preg_match('/\b(interest|categor(y|ies)|genre|type of books?)\b/', $message)) {
            $categories = BookCategory::withCount('books')->get();

            return response()->json([
                'type'  => 'categories',
                'reply' => 'Sure! Here are our available categories — tap one to see its books:',
                'categories' => $categories->map(fn ($c) => [
                    'name'  => $c->category_name,
                    'count' => $c->books_count,
                ]),
            ]);
        }

        // --- 2. User tapped/typed an exact category name ---
        $matchedCategory = BookCategory::whereRaw('LOWER(category_name) = ?', [$message])->first();

        if ($matchedCategory) {
            $books = $matchedCategory->books()->take(10)->get();

            return response()->json([
                'type'  => 'books',
                'reply' => "Here are books in \"{$matchedCategory->category_name}\":",
                'books' => $books->map(fn ($b) => [
                    'name'   => $b->book_name,
                    'author' => $b->author_name,
                    'image'  => asset('uploads/books/' . $b->book_image),
                    'url'    => route('books.read', $b->id),
                ]),
            ]);
        }

        // --- 3. Fallback to AI for everything else ---
        $books = Book::with('category')->latest()->take(30)->get()
            ->map(fn ($b) => "- \"{$b->book_name}\" by {$b->author_name} "
                . "(Category: " . ($b->category->category_name ?? 'General') . ")")
            ->implode("\n");

        $systemContext = "You are the assistant for an online library/bookstore website. "
            . "You help visitors find books, explain categories, and answer questions "
            . "about reading. Here is a sample of books currently available:\n{$books}\n\n"
            . "Keep answers short and friendly.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('BAZAARLINK_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://bazaarlink.ai/api/v1/chat/completions', [
            'model' => 'auto:free',
            'messages' => [
                ['role' => 'system', 'content' => $systemContext],
                ['role' => 'user', 'content' => $request->message],
            ],
        ]);

        if ($response->failed()) {
            return response()->json(['type' => 'text', 'reply' => 'Sorry, something went wrong.'], 500);
        }

        $data = $response->json();
        $reply = $data['choices'][0]['message']['content'] ?? "Sorry, I couldn't understand that.";

        return response()->json(['type' => 'text', 'reply' => $reply]);
    }
}