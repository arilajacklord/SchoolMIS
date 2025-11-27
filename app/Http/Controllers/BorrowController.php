<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of currently borrowed books.
     */
public function index()
{
    // Get all borrows for display
    $borrows = Borrow::with(['user', 'book'])
        ->orderByDesc('borrow_id')
        ->get();

    $users = User::all();

    // Only books not currently borrowed
    $borrowedBookIds = Borrow::whereNull('date_returned')->pluck('book_id')->toArray();
    $books = Book::whereNotIn('book_id', $borrowedBookIds)->get();

    return view('borrow.index', compact('borrows', 'users', 'books'));
}

public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,book_id',
        'due_date' => 'required|date|after_or_equal:date_borrowed',
    ]);

    // Ensure the book is not already borrowed
    $alreadyBorrowed = Borrow::where('book_id', $request->book_id)
        ->whereNull('date_returned')
        ->exists();

    if ($alreadyBorrowed) {
        return redirect()->back()->withErrors(['book_id' => 'This book is already borrowed.']);
    }

    Borrow::create([
        'user_id' => $request->user_id,
        'book_id' => $request->book_id,
        'date_borrowed' => $request->date_borrowed,
        'date_returned' => null, // mark as borrowed
    ]);

    return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully!');
}
    /**
     * Show the form for editing a borrow record.
     */
    public function edit($borrow_id)
    {
        $borrow = Borrow::findOrFail($borrow_id);
        $users = User::all();

        // Include only books that are available OR the current borrowed book
        $borrowedBookIds = Borrow::whereNull('date_returned')
            ->where('borrow_id', '!=', $borrow_id)
            ->pluck('book_id');
        $books = Book::whereNotIn('book_id', $borrowedBookIds)->get();

        return view('borrow.edit', compact('borrow', 'users', 'books'));
    }

    /**
     * Update the borrow record.
     */
public function update(Request $request, $id)
{
    $borrow = Borrow::findOrFail($id);

    $borrow->date_borrowed = $request->date_borrowed;
    $borrow->due_date = $request->due_date;

    $borrow->save();

    return back()->with('success', 'Borrow updated successfully!');
}

    /**
     * Delete a borrow record.
     */
    public function destroy($borrow_id)
    {
        Borrow::findOrFail($borrow_id)->delete();
        return redirect()->back()->with('success', 'Borrow record deleted successfully.');
    }

    /**
     * Mark a borrow as returned.
     */
public function returnBook($borrow_id)
{
    $borrow = Borrow::findOrFail($borrow_id);
    
    // Mark as returned
    $borrow->date_returned = now();
    $borrow->save();

    return redirect()->back()->with('success', 'Book returned successfully.');
}

    /**
     * Show borrow history (both returned and borrowed).
     */
    public function history()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->orderByDesc('borrow_id')
            ->get();

        return view('history.index', compact('borrows'));
    }
}
