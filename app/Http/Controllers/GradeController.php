<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Schoolyear;

class GradeController extends Controller
{
    // Show subjects by selected school year
    public function index(Request $request)
    {
        $schoolyears = Schoolyear::all();
        $selectedId = $request->schoolyear_id;
        $selectedSchoolyear = null;
        $subjects = [];

        if ($selectedId) {
            $selectedSchoolyear = Schoolyear::find($selectedId);
            $subjects = Subject::whereIn('subject_id', function ($q) use ($selectedId) {
                $q->select('subject_id')->from('enrollments')->where('schoolyear_id', $selectedId);
            })->get();
        }

        return view('grades.index', compact('schoolyears', 'selectedSchoolyear', 'subjects'));
    }

    // Show students under a subject
    public function showSubject($schoolyear_id, $subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $schoolyear = Schoolyear::findOrFail($schoolyear_id);

        $enrollments = Enrollment::with(['registration', 'grade'])
            ->where('subject_id', $subject_id)
            ->where('schoolyear_id', $schoolyear_id)
            ->get();

        return view('grades.students', compact('enrollments', 'subject', 'schoolyear'));
    }

    // Store or update grade
    public function store(Request $request)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,enroll_id',
            'prelim' => 'nullable|numeric|min:0|max:100',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'semifinal' => 'nullable|numeric|min:0|max:100',
            'final' => 'nullable|numeric|min:0|max:100',
        ]);

        $enroll_id = $request->enroll_id;

        // Get existing grade or create new
        $grade = Grade::firstOrNew(['enroll_id' => $enroll_id]);
        $grade->prelim = $request->prelim;
        $grade->midterm = $request->midterm;
        $grade->semifinal = $request->semifinal;
        $grade->final = $request->final;
        $grade->save();

        return redirect()->back()->with('success', 'Grade saved successfully!');
    }

    // Fetch grade for AJAX
    public function get($enroll_id)
    {
        $grade = Grade::where('enroll_id', $enroll_id)->first();
        return response()->json($grade);
    }

    // Print grade slip
    public function print($enroll_id)
    {
        $enrollment = Enrollment::with(['registration', 'subject', 'grade'])->findOrFail($enroll_id);
        return view('grades.print', compact('enrollment'));
    }
}
