<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    // Show Borrow List Page
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->orderByDesc('borrow_id')
            ->get();

        $users = User::all();

        // Books that are NOT currently borrowed
        $books = Book::whereNotIn('book_id', function($q) {
            $q->select('book_id')->from('borrows')->whereNull('date_returned');
        })->get();

        return view('borrow.index', compact('borrows', 'users', 'books'));
    }

    // Store New Borrow Record
  public function store(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,book_id',
    ]);

    // Check if book is already borrowed
    $activeBorrow = Borrow::where('book_id', $request->book_id)
        ->whereNotNull('date_borrowed')
        ->whereNull('date_returned')
        ->exists();

    if ($activeBorrow) {
        return back()->with('error', 'This book is already borrowed.');
    }

    // Create borrow record
    $borrow = new Borrow();
    $borrow->book_id = $request->book_id;
    $borrow->user_id = auth()->id();
    $borrow->date_borrowed = now();
    $borrow->save();

    return back()->with('success', 'Book borrowed successfully!');
}

 public function returnBook($id)
{
    // Find the original borrow record (NOT returned yet)
    $borrow = Borrow::where('borrow_id', $id)
        ->whereNull('date_returned')
        ->firstOrFail();

    // Create a new row for the return event
    $new = new Borrow();
    $new->book_id = $borrow->book_id;
    $new->user_id = $borrow->user_id;
    $new->date_borrowed = $borrow->date_borrowed; // keep original borrow date
    $new->date_returned = now();                  // set return date
    $new->save();

    return redirect()->back()->with('success', 'Book return recorded.');
}

    // Update Borrow Record
    public function update(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);

        $request->validate([
            'book_id' => 'required|exists:books,book_id',
            'user_id' => 'required|exists:users,id',
            'date_borrowed' => 'required|date',
        ]);

        $borrow->update([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'date_borrowed' => $request->date_borrowed,
        ]);

        return redirect()->back()->with('success', 'Borrow record updated successfully.');
    }

    // Delete Borrow Record
    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();

        return redirect()->back()->with('success', 'Borrow record deleted successfully.');
    }
}
