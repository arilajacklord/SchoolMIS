<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments.
     */
    public function index(): View
    {
        $enrollments = "Select * from enrollments e INNER JOIN subjects s on e.subject_id = s.subject_id 
            INNER JOIN schoolyears sy on e.schoolyear_id = sy.schoolyear_id INNER JOIN users u on e.user_id = u.id";
        //
        // $enrollments = Enrollment::with(['subject', 'schoolyear', 'user'])->get();
        //
        $result = DB::select($enrollments);
        $enroll_list = collect($result);
    //dd($enrollments);
        return view('enrollments.index', compact('enroll_list'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create(): View
    {
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $users = User::all();

        return view('enrollments.create', compact('subjects', 'schoolyears', 'users'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(EnrollmentStoreRequest $request): RedirectResponse
    {
        Enrollment::create($request->validated());

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified enrollment.
     */
    public function show(Enrollment $enrollment): View
    {
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit(Enrollment $enrollment): View
    {
        $subjects = Subject::all();
        $schoolyears = Schoolyear::all();
        $users = User::all();

        return view('enrollments.edit', compact('enrollment', 'subjects', 'schoolyears', 'users'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(EnrollmentUpdateRequest $request, Enrollment $enrollment): RedirectResponse
    {
        $enrollment->update($request->validated());

        return redirect()->route('enrollments.index')
                        ->with('success', 'Enrollment updated successfully');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(Enrollment $enrollment): RedirectResponse
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
                        ->with('success', 'Enrollment deleted successfully');
    }
}
