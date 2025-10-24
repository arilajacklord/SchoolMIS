<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $books = Book::paginate(10);
       return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $date= $request->input('date_purchased');
    $date_purchased = date('Y-m-d', strtotime($date));
    if ($date_purchased > date('Y-m-d')) {
        return redirect()->back()->withErrors(['date_purchased' => 'The date purchased cannot
    be in the future.'])->withInput();
    }
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'date_pub' => 'required|date',
        'status' => 'required|string',
        'date_purchased' => 'required|date',
    ]);

    Book::create($validated);

    return redirect()->route('books.index')->with('success', 'Book added successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Book $books)
    {
        return view('books.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($book_id)
{
    $book = Book::findOrFail($book_id);
    return view('books.edit', compact('book'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $book_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date_pub' => 'required|date',
            'status' => 'required|string',
            'date_purchased' => 'required|date',
        ]);

        $books = Book::where('book_id', $book_id)->firstOrFail();

        $books->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($book_id)
{
    $books = Books::where('book_id', $book_id)->firstOrFail();
    $books->delete();

    return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
}

}
