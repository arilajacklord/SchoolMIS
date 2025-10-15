<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header d-flex justify-content-between align-items-center">
            View Student
            {{-- Back button on top right --}}
            <a href="{{ route('registration.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </h2>

        <div class="card-body">
            {{-- STEP 1 - Student Info --}}
            <div class="form-step" id="step-1">
                <h5 class="mb-3"><i class="fa fa-user-graduate text-primary"></i> Student Information</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Full Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Email</strong></label>
                        <input type="email" class="form-control" value="{{ $registration->user->email ?? $registration->email }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Course Level</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->course_level }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Address</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_address }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>Phone Number</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_phone_num }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_status }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Citizenship</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_citizenship }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>Birthdate</strong></label>
                        <input type="date" class="form-control" value="{{ $registration->student_birthdate }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Religion</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->student_religion }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Age</strong></label>
                        <input type="number" class="form-control" value="{{ $registration->student_age }}" disabled>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            {{-- STEP 2 - Father Info --}}
            <div class="form-step d-none" id="step-2">
                <h5 class="mb-3"><i class="fas fa-male text-success"></i> Father Information</h5>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>First Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_Fname }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Middle Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_Mname }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Last Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_Lname }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Address</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_address }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Cell Number</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_cell_no }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>Age</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_age }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Religion</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_religion }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Birthdate</strong></label>
                        <input type="date" class="form-control" value="{{ $registration->father_birthdate }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Profession</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_profession }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Occupation</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->father_occupation }}" disabled>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            {{-- STEP 3 - Mother Info --}}
            <div class="form-step d-none" id="step-3">
                <h5 class="mb-3"><i class="fas fa-female text-pink-600"></i> Mother Information</h5>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>First Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_Fname }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Middle Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_Mname }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Last Name</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_Lname }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Address</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_address }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Cell Number</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_cell_no }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>Age</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_age }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Religion</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_religion }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Birthdate</strong></label>
                        <input type="date" class="form-control" value="{{ $registration->mother_birthdate }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label><strong>Profession</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_profession }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Occupation</strong></label>
                        <input type="text" class="form-control" value="{{ $registration->mother_occupation }}" disabled>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                    <a href="{{ route('registration.index') }}" class="btn btn-success">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Step Navigation Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const steps = document.querySelectorAll(".form-step");
            const nextBtns = document.querySelectorAll(".next-step");
            const prevBtns = document.querySelectorAll(".prev-step");
            let currentStep = 0;

            function showStep(step) {
                steps.forEach((s, i) => {
                    s.classList.toggle("d-none", i !== step);
                });
            }

            nextBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            prevBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            showStep(currentStep);
        });
    </script>
</x-app-layout>
