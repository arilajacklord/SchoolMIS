<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Schoolyear;

class GradeController extends Controller
{
    // Page 1: List subjects by selected school year
    public function index(Request $request)
    {
        $schoolyears = Schoolyear::all();
        $selectedSchoolyear = null;
        $subjects = [];

        if ($request->has('schoolyear_id')) {
            $selectedSchoolyear = Schoolyear::find($request->schoolyear_id);
            if ($selectedSchoolyear) {
                $subjects = Subject::orderBy('course_code', 'asc')->get();
            }
        }

        return view('grades.index', compact('schoolyears', 'selectedSchoolyear', 'subjects'));
    }

    // Page 2: Show students in a subject
    public function showSubject($schoolyear_id, $subject_id)
    {
        $schoolyear = Schoolyear::findOrFail($schoolyear_id);
        $subject = Subject::findOrFail($subject_id);

        $enrollments = Enrollment::where('schoolyear_id', $schoolyear_id)
            ->where('subject_id', $subject_id)
            ->with(['registration', 'grade'])
            ->get();

        return view('grades.students', compact('schoolyear', 'subject', 'enrollments'));
    }

    // Store or update grades
    public function store(Request $request)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,enroll_id',
            'prelim' => 'nullable|numeric|min:0|max:100',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'semifinal' => 'nullable|numeric|min:0|max:100',
            'final' => 'nullable|numeric|min:0|max:100',
        ]);

        $grade = Grade::firstOrNew(['enroll_id' => $request->enroll_id]);
        $grade->fill($request->only(['prelim','midterm','semifinal','final']));
        $grade->save();

        return redirect()->back()->with('success', 'Grade saved successfully!');
    }

    // Fetch grade for modal via AJAX
    public function getGrade($enroll_id)
    {
        $grade = Grade::where('enroll_id', $enroll_id)->first();
        return response()->json($grade);
    }

    // Print single student's grade
    public function print($enroll_id)
    {
        $enrollment = Enrollment::with(['registration','subject','schoolyear','grade'])
            ->findOrFail($enroll_id);

        return view('grades.print', compact('enrollment'));
    }
}
