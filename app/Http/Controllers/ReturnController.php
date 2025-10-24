<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = Borrow::with(['user', 'book'])
            ->whereNotNull('date_returned')
            ->orderByDesc('date_returned')
            ->get();

        return view('return.index', compact('returns'));
    }
}
