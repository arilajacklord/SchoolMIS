<?php

namespace App\Http\Controllers;

 use App\Models\Schoolyear;
use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     */
   public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'schoolyear' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
    ]);

    Schoolyear::create($validated);

    return redirect()->route('schoolyears.index')
        ->with('success', 'School Year created successfully.');
}
    /**
     * Display the specified resource (for view modal).
     */
    public function show($id)
    {
        $schoolyear = Schoolyear::findOrFail($id);

        // Handle AJAX requests
        if (request()->ajax()) {
            return response()->json($schoolyear);
        }

        return view('schoolyears.show', compact('schoolyear'));
    }

    /**
     * Show the form for editing the specified resource (AJAX modal).
     */
    public function edit(Schoolyear $schoolyear)
{
    if (request()->ajax()) {
        return response()->json($schoolyear);
    }
    return view('schoolyears.edit', compact('schoolyear'));
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Schoolyear $schoolyear)
{
    $validated = $request->validate([
        'schoolyear' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
    ]);

    $schoolyear->update($validated);

    return redirect()->route('schoolyears.index')->with('success', 'School year updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $schoolyear = Schoolyear::findOrFail($id);
        $schoolyear->delete();

        return redirect()->route('schoolyears.index')
            ->with('success', 'School Year deleted successfully.');
    }
}
