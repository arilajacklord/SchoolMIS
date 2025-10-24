<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])->orderByDesc('borrow_id')->get();
        $users = User::all();
        $books = Book::all();

        return view('borrow.index', compact('borrows', 'users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'date_borrowed' => 'required|date',
        ]);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'date_borrowed' => $request->date_borrowed,
        ]);

        return redirect()->back()->with('success', 'Book borrowed successfully.');
    }

    public function update(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->update($request->all());

        return redirect()->back()->with('success', 'Borrow record updated.');
    }

    public function destroy($id)
    {
        Borrow::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Borrow record deleted.');
    }

    // ✅ Mark as Returned
    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->date_returned = now();
        $borrow->save();

        return redirect()->back()->with('success', 'Book marked as returned.');
    }
}
