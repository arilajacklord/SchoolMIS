<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'semester' => 'required|string|in:1st Semester,2nd Semester,Summer',
        ]);

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolyearStoreRequest $request): RedirectResponse
    {
        Schoolyear::create($request->validated());

        return redirect()->route('schoolyears.index')
            ->with('success', 'School Year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schoolyear $schoolyear): View
    {
        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'semester' => 'required|string|in:1st Semester,2nd Semester,Summer',
        ]);

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
