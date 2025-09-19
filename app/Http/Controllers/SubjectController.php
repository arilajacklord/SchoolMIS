<?php

namespace App\Http\Controllers;


use App\Models\Subject;
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
    $subjects = Subject::all(); // or paginate, or whatever you need
    return view('subjects.index', compact('subjects'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $subjects = Subject::all(); 

    return view('subjects.create', compact('subjects'));
   
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
        return view('subjects.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectUpdateRequest $request, Subject $subject): RedirectResponse
    {
       // var_dump("dfghjkl.;");
       if($request->validated()){
        echo "failed";
       }
       else{
        echo "success";
       }

        $subject->update($request->validated());

        return redirect()->route('subjects.index')
                        ->with('success','Product updated successfully');
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