<?php

namespace App\Http\Controllers;

use App\Models\Books;
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
       $books = Books::paginate(10);
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

    // create record
    Books::create($request->all());

    // redirect back with success message
    return redirect()->route('books.index')->with('success', 'Book added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        return view('books.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($book_id)
{
    $book = Books::findOrFail($book_id);
    return view('books.edit', compact('book'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $books)
    {
        $books->update($request->validated());
      return redirect()->route('books.index')->with('success', 'Book updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Books $book)
{
    $books->delete();

    return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
}
}
