<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Display a list of books
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $books = Book::where('writer_id', auth()->user()->id)->get();
        return view('books.index', compact('books'));
    }
    public function explore()
    {
        $books = Book::paginate(8); // Paginate for better performance
        return view('books.explore', compact('books'));
    }
    public function borrow(Book $book)
    {
        $book->update(['status' => 'Borrowed', 'borrowed_at' => now(), 'borrower_id' => auth()->id()]);
        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }


    // Show the form for creating a new book
    public function create()
    {
        return view('books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'required|mimes:pdf|max:50000',
        ]);

        // Handle File Uploads
        $coverPath = $request->file('cover')->store('covers', 'public');
        $pdfPath = $request->file('pdf')->store('pdfs', 'public');

        // Create Book
        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'writer_id' => auth()->user()->id,
            'cover' => $coverPath,
            'pdf' => $pdfPath,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Display a single book
    public function show(Book $book)
    {
        $writer = User::where('id', $book->writer_id)->first()->name;
        return view('books.show', compact('book',"writer"));
    }

    // Show the form for editing a book
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update a book in the database
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'writer_id' => 'required|exists:users,id',
            'borrower_id' => 'nullable|exists:users,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:50000',
        ]);

        // Handle file updates
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $book->cover = $coverPath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
            $book->pdf = $pdfPath;
        }

        // Update book details
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'writer_id' => $request->writer_id,
            'borrower_id' => $request->borrower_id,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete a book from the database
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
