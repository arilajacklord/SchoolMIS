<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Regestration;
use App\Models\Subject;
use App\Models\Schoolyear;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create()
    {
        $students = Registration::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return view('enrollments.create', compact('students', 'subjects', 'schoolyears'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:regestrations,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        Enrollment::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'schoolyear_id' => $request->schoolyear_id,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment added successfully.');
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Regestration::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return view('enrollments.edit', compact('enrollment', 'students', 'subjects', 'schoolyears'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:regestrations,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'schoolyear_id' => $request->schoolyear_id,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
