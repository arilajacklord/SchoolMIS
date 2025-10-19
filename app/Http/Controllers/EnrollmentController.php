<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Subject;
use App\Models\Schoolyear;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'subject', 'schoolyear'])
            ->orderBy('enroll_id', 'desc')
            ->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return view('enrollments.create', compact('users', 'subjects', 'schoolyears'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        Enrollment::create($request->only(['user_id', 'subject_id', 'schoolyear_id']));

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment added successfully.');
    }

    /**
     * Display the specified enrollment.
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['user', 'subject', 'schoolyear']);
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit(Enrollment $enrollment)
    {
        $users = User::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return view('enrollments.edit', compact('enrollment', 'users', 'subjects', 'schoolyears'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        $enrollment->update($request->only(['user_id', 'subject_id', 'schoolyear_id']));

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment deleted successfully.');
    }
}
