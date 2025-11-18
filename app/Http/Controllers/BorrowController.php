<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    // ✅ Show Borrow List Page
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->orderByDesc('borrow_id')
            ->get();

        $users = User::all();
        $books = Book::where('status', 'Available')->get(); // Only available books

        return view('borrow.index', compact('borrows', 'users', 'books'));
    }

    // ✅ Store New Borrow Record
   public function store(Request $request)
{
    // Validate incoming request
    $request->validate([
        'book_id' => 'required|exists:books,book_id',
    ]);

    // Create a borrow record
    $borrow = new Borrow();
    $borrow->book_id = $request->book_id;
    $borrow->user_id = auth()->id(); // ✅ Logged-in user
    $borrow->borrow_date = now();    // ✅ Current date
    $borrow->status = 'Borrowed';
    $borrow->save();

    // Update the book status
    $book = Book::findOrFail($request->book_id);
    $book->status = 'Borrowed';
    $book->save();

    return redirect()->back()->with('success', 'Book borrowed successfully!');
}

    // ✅ Update Borrow Record
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

    // ✅ Delete Borrow Record
    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);

        // Before deleting, set book status to Available again
        Book::where('book_id', $borrow->book_id)->update(['status' => 'Available']);

        $borrow->delete();

        return redirect()->back()->with('success', 'Borrow record deleted successfully.');
    }

    // ✅ Mark as Returned
    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->date_returned = now();
        $borrow->save();

        // Return the book to Available
        Book::where('book_id', $borrow->book_id)->update(['status' => 'Available']);

        return redirect()->back()->with('success', 'Book marked as returned.');
    }
}
