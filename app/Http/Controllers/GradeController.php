<?php
<<<<<<< HEAD
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Enrollment;
use Illuminate\Http\Request;
=======

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Enrollment;
>>>>>>> 2b24e5ae9f136ab15c24d08d008338698880683c

class GradeController extends Controller
{
    /**
     * Display a listing of grades.
     */
<<<<<<< HEAD
    public function index()
    {
        $grades = Grade::with('enrollment')->get();
        return view('grades.index', compact('grades'));
=======
     public function index()
    {
        // Get all grades with related enrollment data
        $grades = Grade::with(['enrollment.registration', 'enrollment.subject', 'enrollment.schoolyear'])->get();

        // Get all enrollments for the Add Grade modal dropdown
        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();

        // Pass both to the view
        return view('grades.index', compact('grades', 'enrollments'));
>>>>>>> 2b24e5ae9f136ab15c24d08d008338698880683c
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
<<<<<<< HEAD
        $enrollments = Enrollment::all(); // For dropdown
=======
        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();
>>>>>>> 2b24e5ae9f136ab15c24d08d008338698880683c
        return view('grades.create', compact('enrollments'));
    }

    /**
<<<<<<< HEAD
     * Store a newly created grade.
=======
     * Store a newly created grade in storage.
>>>>>>> 2b24e5ae9f136ab15c24d08d008338698880683c
     */
    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'enroll_id' => 'required|exists:enrollments,id',
            'prelim' => 'nullable|numeric',
            'midterm' => 'nullable|numeric',
            'semifinal' => 'nullable|numeric',
            'final' => 'nullable|numeric',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')
                         ->with('success', 'Grade added successfully.');
    }

    /**
     * Show the form for editing a grade.
     */
    public function edit(Grade $grade)
    {
        $enrollments = Enrollment::all();
        return view('grades.edit', compact('grade', 'enrollments'));
    }

    /**
     * Update the specified grade.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,id',
            'prelim' => 'nullable|numeric',
            'midterm' => 'nullable|numeric',
            'semifinal' => 'nullable|numeric',
            'final'     => 'nullable|numeric',
        ]);

        $grade->update($request->all());

=======
            'enroll_id' => 'required|exists:enrollments,enroll_id',
            'prelim' => 'nullable|numeric|min:0|max:100',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'semifinal' => 'nullable|numeric|min:0|max:100',
            'final' => 'nullable|numeric|min:0|max:100',
        ]);

        Grade::create([
            'enroll_id' => $request->enroll_id,
            'prelim' => $request->prelim,
            'midterm' => $request->midterm,
            'semifinal' => $request->semifinal,
            'final' => $request->final,
        ]);

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');
    }

    /**
     * Display the specified grade.
     */
    public function show($id)
{
    $grade = Grade::with('enrollment.registration', 'enrollment.subject', 'enrollment.schoolyear')->findOrFail($id);
    return view('grades.show', compact('grade'));
}


    /**
     * Show the form for editing the specified grade.
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();

        return view('grades.edit', compact('grade', 'enrollments'));
    }

    /**
     * Update the specified grade in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,enroll_id',
            'prelim' => 'nullable|numeric|min:0|max:100',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'semifinal' => 'nullable|numeric|min:0|max:100',
            'final' => 'nullable|numeric|min:0|max:100',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update([
            'enroll_id' => $request->enroll_id,
            'prelim' => $request->prelim,
            'midterm' => $request->midterm,
            'semifinal' => $request->semifinal,
            'final' => $request->final,
        ]);

>>>>>>> 2b24e5ae9f136ab15c24d08d008338698880683c
        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
