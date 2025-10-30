<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index(): View
    {
        $subjects = Subject::paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Store a newly created subject.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255',
            'descriptive_title' => 'required|string|max:255',
            'lec_units' => 'required|integer|min:0',
            'lab_units' => 'required|integer|min:0',
            'co_requisite' => 'nullable|string|max:255',
            'pre_requisite' => 'nullable|string|max:255',
        ]);

        $validated['total_units'] = ($validated['lec_units'] ?? 0) + ($validated['lab_units'] ?? 0);

        Subject::create($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Display a specific subject (for AJAX).
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }

    /**
     * Update an existing subject.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'course_code' => 'required|string|max:255',
            'descriptive_title' => 'required|string|max:255',
            'lec_units' => 'required|integer|min:0',
            'lab_units' => 'required|integer|min:0',
            'total_units' => 'nullable|integer|min:0',
            'co_requisite' => 'nullable|string|max:255',
            'pre_requisite' => 'nullable|string|max:255',
        ]);

        $validated['total_units'] = ($validated['lec_units'] ?? 0) + ($validated['lab_units'] ?? 0);

        $subject->update($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove a subject.
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
     }
}
