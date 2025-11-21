<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Http\Requests\RegistrationStoreRequest;
use App\Http\Requests\RegistrationUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class RegistrationController extends Controller
{
    /**
     * Display a listing of registrations.
     */
    public function studentinfo_index(): View

    {
        $registrations = Registration::latest()->get();
        return view('studentinfo.index', compact('registrations'));
    }

    public function index(): View
    {
        $registrations = Registration::latest()->get();
        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new registration.
     */
    public function create(): View
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(RegistrationStoreRequest $request): RedirectResponse
    {
        try {
            // ✅ Step 1: Create User account first
            $fullname = $request->student_Fname . ' ' . $request->student_Mname . ' ' . $request->student_Lname;
            $user = User::create([
                'name'     => $fullname,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'type'     => $request->type,
            ]);

            // ✅ Step 2: Create Registration record linked to the user
            Registration::create([
                'user_id'             => $user->id,
                'student_Fname'        => $request->student_Fname,
                'student_Mname'        => $request->student_Mname,
                'student_Lname'        => $request->student_Lname,
                'course_level'        => $request->course_level,
                'student_address'     => $request->student_address,
                'student_phone_num'   => $request->student_phone_num,
                'student_status'      => $request->student_status,
                'student_citizenship' => $request->student_citizenship,
                'student_birthdate'   => $request->student_birthdate,
                'student_religion'    => $request->student_religion,
                'student_age'         => $request->student_age,

                // Father info
                // 'father_Fname'        => $request->father_Fname,
                // 'father_Mname'        => $request->father_Mname,
                // 'father_Lname'        => $request->father_Lname,
                // 'father_address'      => $request->father_address,
                // 'father_cell_no'      => $request->father_cell_no,
                // 'father_age'          => $request->father_age,
                // 'father_religion'     => $request->father_religion,
                // 'father_birthdate'    => $request->father_birthdate,
                // 'father_profession'   => $request->father_profession,
                // 'father_occupation'   => $request->father_occupation,

                // // Mother info
                // 'mother_Fname'        => $request->mother_Fname,
                // 'mother_Mname'        => $request->mother_Mname,
                // 'mother_Lname'        => $request->mother_Lname,
                // 'mother_address'      => $request->mother_address,
                // 'mother_cell_no'      => $request->mother_cell_no,
                // 'mother_age'          => $request->mother_age,
                // 'mother_religion'     => $request->mother_religion,
                // 'mother_birthdate'    => $request->mother_birthdate,
                // 'mother_profession'   => $request->mother_profession,
                // 'mother_occupation'   => $request->mother_occupation,
            ]);

            return redirect()
                ->route('registration.index')
                ->with('success', 'Registration created successfully.');

        } catch (Exception $e) {
            // Rollback user if registration creation fails
            if (isset($user)) {
                $user->delete();
            }

            Log::error('Registration store failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create registration: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified registration.
     */
    public function show(Registration $registration): View
    {
        return view('/registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified registration.
     */
    public function edit($id): View
    {
        $student = Registration::findOrFail($id);
        return view('registration.edit', compact('student'));
    }

    /**
     * Update the specified registration in storage.
     */
    public function update(RegistrationUpdateRequest $request, Registration $registration): RedirectResponse
    {
        try {
            // ✅ Update Registration record
            $registration->update($request->only($registration->getFillable()));

            // ✅ Update linked User account (keep password if not changed)
            if ($registration->user) {
                $registration->user->update([
                    'name'     => $request->student_name,
                    'email'    => $request->email ?? $registration->user->email,
                    'password' => $request->filled('password')
                        ? Hash::make($request->password)
                        : $registration->user->password,
                ]);
            }

            return redirect()
                ->route('registrations.index')
                ->with('success', 'Registration updated successfully.');

        } catch (Exception $e) {
            Log::error('Registration update failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update registration.');
        }
    }

    /**
     * Remove the specified registration from storage.
     */
    public function destroy(Registration $registration): RedirectResponse
    {
        try {
            // ✅ Delete linked user first
            if ($registration->user) {
                $registration->user->delete();
            }

            $registration->delete();

            return redirect()
                ->route('registrations.index')
                ->with('success', 'Registration deleted successfully.');

        } catch (Exception $e) {
            Log::error('Registration delete failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to delete registration.');
        }
    }
}
