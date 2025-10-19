<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\SchoolyearStoreRequest;
use App\Http\Requests\SchoolyearUpdateRequest;

class SchoolyearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $schoolyears = Schoolyear::orderBy('schoolyear_id', 'desc')->paginate(5);

        return view('schoolyears.index', compact('schoolyears'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('schoolyears.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolyearStoreRequest $request): RedirectResponse
    {
        Schoolyear::create($request->validated());

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schoolyear $schoolyear): View
    {
        return view('schoolyears.show', compact('schoolyear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schoolyear $schoolyear): View
    {
        return view('schoolyears.edit', compact('schoolyear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolyearUpdateRequest $request, Schoolyear $schoolyear): RedirectResponse
    {
        $schoolyear->update($request->validated());

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schoolyear $schoolyear): RedirectResponse
    {
        $schoolyear->delete();

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear deleted successfully.');
    }
}
