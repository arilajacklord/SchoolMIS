<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolyearController extends Controller
{
    // Show paginated list of school years
    public function index(): View
    {
        $schoolyears = Schoolyear::latest()->paginate(5);

        return view('schoolyears.index', compact('schoolyears'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Store new school year
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'semester' => 'required|string|in:1st Semester,2nd Semester,Summer',
        ]);

        Schoolyear::create($validated);

        return redirect()->route('schoolyears.index')
            ->with('success', 'School Year created successfully.');
    }

    // Update school year
    public function update(Request $request, Schoolyear $schoolyear): RedirectResponse
    {
        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'semester' => 'required|string|in:1st Semester,2nd Semester,Summer',
        ]);

        $schoolyear->update($validated);

        return redirect()->route('schoolyears.index')
            ->with('success', 'School Year updated successfully.');
    }

    // Delete school year
    public function destroy(Schoolyear $schoolyear): RedirectResponse
    {
        $schoolyear->delete();

        return redirect()->route('schoolyears.index')
            ->with('success', 'School Year deleted successfully.');
    }

    // API method to show school year JSON data (for modal View)
    public function apiShow($id)
    {
        $schoolyear = Schoolyear::findOrFail($id);
        return response()->json($schoolyear);
    }

    // API method to show school year JSON data (for modal Edit)
    public function apiEdit($id)
    {
        return $this->apiShow($id);
    }
}
