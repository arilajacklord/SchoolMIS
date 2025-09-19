<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;
use App\Http\Requests\bookStoreRequest;
use App\Http\Requests\bookUpdateRequest;


class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = book::latest() ->paginate(5);
        return view('book.index', compact('book'))->with('i', (request()->input('page', 1) - 1) * 5);
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        book::create($request->validated());
        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, book $book)
    {
        $book->update($request->validated());
      return redirect()->route('book.index')->with('success', 'Book updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }
}
