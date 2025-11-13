<?php
namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('enrollment.student', 'enrollment.subject')->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
        $enrollments = Enrollment::with('student', 'subject')->get();
        return view('grades.create', compact('enrollments'));
    }

    /**
     * Store a newly created grade.
     */
    public function store(Request $request)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,id',
            'prelim'    => 'nullable|numeric',
            'midterm'   => 'nullable|numeric',
            'semifinal' => 'nullable|numeric',
            'final'     => 'nullable|numeric',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');
    }

    /**
     * Display the specified grade.
     */
    public function show(Grade $grade)
    {
        $grade->load('enrollment.student', 'enrollment.subject');
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified grade.
     */
    public function edit(Grade $grade)
    {
        $enrollments = Enrollment::with('student', 'subject')->get();
        return view('grades.edit', compact('grade', 'enrollments'));
    }

    /**
     * Update the specified grade.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'enroll_id' => 'required|exists:enrollments,id',
            'prelim'    => 'nullable|numeric',
            'midterm'   => 'nullable|numeric',<?php

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
        $grades = Grade::with('enrollment')->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
        $enrollments = Enrollment::all(); // For dropdown
        return view('grades.create', compact('enrollments'));
    }

    /**
     * Store a newly created grade.
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
            'final' => 'nullable|numeric',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')
                         ->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')
                         ->with('success', 'Grade deleted successfully.');
    }
}

            'semifinal' => 'nullable|numeric',
            'final'     => 'nullable|numeric',
        ]);

        $grade->update($request->all());

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
