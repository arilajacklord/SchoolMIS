<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
 use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Schoolyear;


class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'subject', 'schoolyear'])->get();
        $users = User::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return view('enrollments.index', compact('enrollments', 'users', 'subjects', 'schoolyears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        Enrollment::create($request->only(['user_id', 'subject_id', 'schoolyear_id']));

        return redirect()->route('enrollments.index')->with('success', 'Enrollment added successfully.');
    }

    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $users = User::all();
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();

        return response()->json([
            'enroll_id' => $enrollment->enroll_id,
            'user_id' => $enrollment->user_id,
            'subject_id' => $enrollment->subject_id,
            'schoolyear_id' => $enrollment->schoolyear_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->only(['user_id', 'subject_id', 'schoolyear_id']));

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    public function show($id)
    {
        $enrollment = Enrollment::with(['user', 'subject', 'schoolyear'])->findOrFail($id);

        return response()->json([
            'user' => $enrollment->user->name ?? 'N/A',
            'subject' => $enrollment->subject->descriptive_title ?? 'N/A',
            'schoolyear' => $enrollment->schoolyear->schoolyear ?? 'N/A',
            'semester' => $enrollment->schoolyear->semester ?? '',
        ]);
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}