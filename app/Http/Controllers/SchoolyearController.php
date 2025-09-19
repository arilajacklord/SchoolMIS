<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\SchoolyearStoreRequest;
use App\Http\Requests\SchoolyearUpdateRequest;

class SchoolyearController extends Controller
{
    public function index(): View
    {
        $schoolyears = Schoolyear::latest()->paginate(5);

        return view('schoolyears.index', compact('schoolyears'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('schoolyears.create');
    }

    public function store(SchoolyearStoreRequest $request): RedirectResponse
    {
        Schoolyear::create($request->validated());

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear created successfully.');
    }

    public function show(Schoolyear $schoolyear): View
    {
        return view('schoolyears.show', compact('schoolyear'));
    }

    public function edit(Schoolyear $schoolyear): View
    {
        return view('schoolyears.edit', compact('schoolyear'));
    }

    public function update(SchoolyearUpdateRequest $request, Schoolyear $schoolyear): RedirectResponse
    {
        $schoolyear->update($request->validated());

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear updated successfully');
    }

    public function destroy(Schoolyear $schoolyear): RedirectResponse
    {
        $schoolyear->delete();

        return redirect()->route('schoolyears.index')
                         ->with('success', 'Schoolyear deleted successfully');
    }
}
