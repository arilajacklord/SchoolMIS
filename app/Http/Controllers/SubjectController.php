<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $subjects = Subject::all();
    return view('subjects.index', compact('subjects'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $subjects = Subject::all(); 
    $courses = Course::all();


    return view('subjects.create', compact('courses'));
   
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectStoreRequest $request): RedirectResponse
    {
        Subject::create($request->validated());

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject): View
    {
        return view('subjects.show',compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject): View
{
    $courses = Course::all();
    $subjects = Subject::all(); 

    return view('subjects.edit', compact('subject', 'courses', 'subjects'));
}




    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectUpdateRequest $request, Subject $subject): RedirectResponse
    {
       // var_dump("dfghjkl.;");
        $subject->update($request->validated());

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();

        return redirect()->route('subjects.index')
                        ->with('success','Subject deleted successfully');
    }

    
}