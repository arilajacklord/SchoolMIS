<?php
namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\Enrollment;
use Illuminate\Http\Request;
class GradeController extends Controller
{
    /**
     * Display a listing of grades.
     */

 
     public function index()
    {
        // Get all grades with related enrollment data
        $grades = Grade::with(['enrollment.registration', 'enrollment.subject', 'enrollment.schoolyear'])->get();

        // Get all enrollments for the Add Grade modal dropdown
        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();

        // Pass both to the view
        return view('grades.index', compact('grades', 'enrollments'));

    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {

        $enrollments = Enrollment::all(); // For dropdown

        $enrollments = Enrollment::with(['registration', 'subject', 'schoolyear'])->get();

        return view('grades.create', compact('enrollments'));
    }

    /**

     * Store a newly created grade.

     * Store a newly created grade in storage.

     */
    public function store(Request $request)
    {
        $request->validate([

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
 

    /**
     * Update the specified grade in storage.
     */


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
