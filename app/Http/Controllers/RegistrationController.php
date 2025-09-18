<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Http\Requests\RegistrationStoreRequest;
use App\Http\Requests\RegistrationUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    /**
     * Display a listing of registration records.
     */
    public function index()
    {
        $registrations = Registration::with('user')->latest()->get();
        return view('registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new registration record.
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Store a newly created registration record in storage.
     */
    public function store(RegistrationStoreRequest $request)
    {
        // ✅ Create linked User
        $user = User::create([
            'name'     => $request->student_name,
            'email'    => $request->email, // make sure your form includes email
            'password' => Hash::make(Str::random(12)), // or request a password
        ]);

        // ✅ Create Registration with student + parent info
        Registration::create([
            'user_id'           => $user->id,
            'student_name'      => $request->student_name,
            'course_level'      => $request->course_level,
            'student_address'   => $request->student_address,
            'student_phone'     => $request->student_phone,
            'student_status'    => $request->student_status,
            'student_citizenship' => $request->student_citizenship,
            'student_birthdate' => $request->student_birthdate,
            'student_religion'  => $request->student_religion,
            'student_age'       => $request->student_age,
            'father_Fname'      => $request->father_Fname,
            'father_Mname'      => $request->father_Mname,
            'father_Lname'      => $request->father_Lname,
            'father_address'    => $request->father_address,
            'father_cell_no'    => $request->father_cell_no,
            'father_age'        => $request->father_age,
            'father_religion'   => $request->father_religion,
            'father_birthdate'  => $request->father_birthdate,
            'father_profession' => $request->father_profession,
            'father_occupation' => $request->father_occupation,
            'mother_Fname'      => $request->mother_Fname,
            'mother_Mname'      => $request->mother_Mname,
            'mother_Lname'      => $request->mother_Lname,
            'mother_address'    => $request->mother_address,
            'mother_cell_no'    => $request->mother_cell_no,
            'mother_age'        => $request->mother_age,
            'mother_religion'   => $request->mother_religion,
            'mother_birthdate'  => $request->mother_birthdate,
            'mother_profession' => $request->mother_profession,
            'mother_occupation' => $request->mother_occupation,
        ]);

        return redirect()
            ->route('registration.index')
            ->with('success', 'Registration created successfully.');
    }

    /**
     * Display the specified registration record.
     */
    public function show(Registration $registration)
    {
        $registration->load('user');
        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified registration record.
     */
    public function edit(Registration $registration)
    {
        $registration->load('user');
        return view('registration.edit', compact('registration'));
    }

    /**
     * Update the specified registration record in storage.
     */
    public function update(RegistrationUpdateRequest $request, Registration $registration)
    {
        // ✅ Update Registration fields
        $registration->update($request->only($registration->getFillable()));

        // ✅ Update linked User
        if ($registration->user) {
            $registration->user->update([
                'name'  => $request->student_name,
                'email' => $request->email ?? $registration->user->email,
            ]);
        }

        return redirect()
            ->route('registration.index')
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Remove the specified registration record from storage.
     */
    public function destroy(Registration $registration)
    {
        if ($registration->user) {
            $registration->user->delete();
        }

        $registration->delete();

        return redirect()
            ->route('registration.index')
            ->with('success', 'Registration deleted successfully.');
    }
}
