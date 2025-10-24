<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()

    {
        // Use your existing borrow, book, and user tables
        $histories = DB::table('borrows')
            ->join('books', 'borrows.book_id', '=', 'books.book_id')
            ->join('users', 'borrows.user_id', '=', 'users.id')
            ->select(
                'borrows.borrow_id',
                'users.name as user_name',
                'books.title as book_title',
                'borrows.date_borrowed',
                'borrows.date_returned'
            )
            ->orderByDesc('borrows.borrow_id')
            ->get();

        return view('history.index', compact('histories'));
    }
    }