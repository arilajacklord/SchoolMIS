<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments.
     */
    public function index(): View
    {
        // Raw SQL to fetch enrollments joined with related tables
        $enrollments = "SELECT 
            e.enroll_id, e.subject_id, e.schoolyear_id, e.user_id, 
            s.descriptive_title, 
            CONCAT(sy.schoolyear, ' - ', sy.semester) as schoolyear, 
            u.name 
        FROM enrollments e 
        INNER JOIN subjects s ON e.subject_id = s.subject_id 
        INNER JOIN schoolyears sy ON e.schoolyear_id = sy.schoolyear_id 
        INNER JOIN users u ON e.user_id = u.id";

        $result = DB::select($enrollments);
        $enroll_list = collect($result);

        // Fetch data for dropdowns/forms
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $users = User::all();

        return view('enrollments.index', compact('enroll_list', 'subjects', 'schoolyears', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create(): View
    {
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $users = User::all();

        return view('enrollments.create', compact('subjects', 'schoolyears', 'users'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(EnrollmentStoreRequest $request): RedirectResponse
    {
        Enrollment::create($request->validated());

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified enrollment.
     */
    public function show(Enrollment $enrollment): View
    {
        $enrollment->load(['subject', 'schoolyear', 'user']); // eager load relations
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit(Enrollment $enrollment): View
    {
        $enrollment->load(['subject', 'schoolyear', 'user']); // eager load relations

        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $users = User::all();

        return view('enrollments.edit', compact('enrollment', 'subjects', 'schoolyears', 'users'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(EnrollmentUpdateRequest $request, Enrollment $enrollment): RedirectResponse
    {
        $enrollment->update($request->validated());

        return redirect()->route('enrollments.index')
                        ->with('success', 'Enrollment updated successfully');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(Enrollment $enrollment): RedirectResponse
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
                        ->with('success', 'Enrollment deleted successfully');
    }

    // Return JSON for editing modal
    public function apiEdit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return response()->json($enrollment);
    }

    // Return JSON for viewing modal (fixed to include related data)
    public function apiShow($id)
    {
        $enrollment = Enrollment::with(['subject', 'schoolyear', 'user'])->findOrFail($id);

        return response()->json([
            'enroll_id' => $enrollment->enroll_id,
            'subject' => $enrollment->subject->descriptive_title ?? 'N/A',
            'schoolyear' => $enrollment->schoolyear->schoolyear ?? 'N/A',
            'semester' => $enrollment->schoolyear->semester ?? 'N/A',
            'user' => $enrollment->user->name ?? 'N/A',
        ]);
    }
}
