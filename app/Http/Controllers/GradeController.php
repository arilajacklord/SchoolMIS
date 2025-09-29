<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Show grade management page
     */
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $students = [];

        if ($request->has('subject_id') && $request->has('schoolyear_id')) {
            $students = Enrollment::with('student')
                ->where('subject_id', $request->subject_id)
                ->where('schoolyear_id', $request->schoolyear_id)
                ->get()
                ->pluck('student'); // Get only the student objects
        }

        return view('grades.index', compact('subjects', 'schoolyears', 'students'));
    }

    /**
     * Store or update grades
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'schoolyear_id' => 'required|exists:schoolyears,schoolyear_id',
            'prelim' => 'required|numeric|min:0|max:100',
            'midterm' => 'required|numeric|min:0|max:100',
            'semifinal' => 'required|numeric|min:0|max:100',
            'final' => 'required|numeric|min:0|max:100',
        ]);

        // Check if grade already exists
        $grade = Grade::where('user_id', $request->user_id)
            ->where('subject_id', $request->subject_id)
            ->where('schoolyear_id', $request->schoolyear_id)
            ->first();

        if ($grade) {
            // Update existing grade
            $grade->update([
                'prelim' => $request->prelim,
                'midterm' => $request->midterm,
                'semifinal' => $request->semifinal,
                'final' => $request->final,
            ]);
        } else {
            // Create new grade record
            Grade::create([
                'user_id' => $request->user_id,
                'subject_id' => $request->subject_id,
                'schoolyear_id' => $request->schoolyear_id,
                'prelim' => $request->prelim,
                'midterm' => $request->midterm,
                'semifinal' => $request->semifinal,
                'final' => $request->final,
            ]);
        }

        return redirect()->back()->with('success', 'Grade saved successfully.');
    }
}
