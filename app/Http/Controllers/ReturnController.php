<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Return;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = Borrow::with(['user', 'book'])
            ->whereNotNull('date_returned')
            ->orderByDesc('date_returned')
            ->get();

        return view('returns.index', compact('returns'));
    }
}
