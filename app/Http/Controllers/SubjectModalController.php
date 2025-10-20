<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectModalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Subject::all();
        return view('subjectmodals.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        Subject::create([
            'course_code' => $request->course_code,
            'descriptive_title' => $request->descriptive_title,
            'led_units' => $request->led_units,
            'lab_units' => $request->lab_units,
            'total_units' => $request->total_units,
            'co_requisite' => $request->co_requisite,
            'pre_requisite' => $request->pre_requisite,
        ]);

        return redirect()->route('subjectmodals.index')
                         ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::find($id);
        return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::find($id);
        $subject->update([
            'course_code' => $request->course_code,
            'descriptive_title' => $request->descriptive_title,
            'led_units' => $request->led_units,
            'lab_units' => $request->lab_units,
            'total_units' => $request->total_units,
            'co_requisite' => $request->co_requisite,
            'pre_requisite' => $request->pre_requisite,
        ]);

        return redirect()->route('subjectmodals.index')
                         ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('subjectmodals.index')
                         ->with('success', 'Subject deleted successfully.');
    }
}
