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
                $q->select('subject_id')
                    ->from('enrollments')
                    ->where('schoolyear_id', $selectedId);
            })->get();
        }

        return view('grades.index', compact('schoolyears', 'selectedSchoolyear', 'subjects'));
    }


    // Show students under a subject
    public function showSubject($schoolyear_id, $subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $schoolyear = Schoolyear::findOrFail($schoolyear_id);

        // FIXED: use correct relation "registration"
        $enrollments = Enrollment::with(['registration', 'grades'])
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

        // FIXED: Create or update grade
        $grade = Grade::updateOrCreate(
            ['enroll_id' => $request->enroll_id],
            [
                'prelim' => $request->prelim,
                'midterm' => $request->midterm,
                'semifinal' => $request->semifinal,
                'final' => $request->final,
            ]
        );

        return redirect()->back()->with('success', 'Grade saved successfully!');
    }


    // Fetch grade via AJAX
    public function get($enroll_id)
    {
        return response()->json(
            Grade::where('enroll_id', $enroll_id)->first()
        );
    }


    // Print grade slip
    public function print($enroll_id)
    {
        $enrollment = Enrollment::with(['registration', 'subject', 'grades'])
            ->findOrFail($enroll_id);

        // FIXED: grades is a hasOne relation — never a collection
        if (!$enrollment->grades) {
            $enrollment->grades()->create([]);
            $enrollment->load('grades');
        }

        // Use correct registration fields — now safe
        $reg = $enrollment->registration;

        $student_fname = $reg->student_Fname ?? '';
        $student_mname = $reg->student_Mname ?? '';
        $student_lname = $reg->student_Lname ?? '';

        return view('grades.print', compact('enrollment', 'student_fname', 'student_mname', 'student_lname'));
    }
}
