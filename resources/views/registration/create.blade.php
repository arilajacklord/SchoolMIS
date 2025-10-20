<x-app-layout>
    
    <div class="card mt-5">
       <h2 class="card-header d-flex justify-content-between align-items-center">
        Student Registration
        <a href="{{ route('registration.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </h2>
        <div class="card-body">
            <form id="registrationForm" action="{{ route('registration.store') }}" method="POST">
                @csrf

                @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                {{-- STEP 1 - Student Info --}}
                <div class="form-step" id="step-1">
                    <h5 class="mb-3"><i class="fa fa-user-graduate text-primary"></i> Student Information</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Full Name</strong></label>
                            <input type="text" name="student_name" class="form-control"
                                value="{{ old('student_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Confirm Password</strong></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Course Level</strong></label>
                            <input type="text" name="course_level" class="form-control"
                                value="{{ old('course_level') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Address</strong></label>
                            <input type="text" name="student_address" class="form-control"
                                value="{{ old('student_address') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label><strong>Phone Number</strong></label>
                            <input type="text" name="student_phone_num" class="form-control"
                                value="{{ old('student_phone_num') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Status</strong></label>
                            <input type="text" name="student_status" class="form-control"
                                value="{{ old('student_status') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Citizenship</strong></label>
                            <input type="text" name="student_citizenship" class="form-control"
                                value="{{ old('student_citizenship') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label><strong>Birthdate</strong></label>
                            <input type="date" name="student_birthdate" class="form-control"
                                value="{{ old('student_birthdate') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Religion</strong></label>
                            <input type="text" name="student_religion" class="form-control"
                                value="{{ old('student_religion') }}">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Age</strong></label>
                            <input type="number" name="student_age" class="form-control"
                                value="{{ old('student_age') }}" min="0">
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
                            <input type="text" name="father_Fname" class="form-control"
                                value="{{ old('father_Fname') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Middle Name</strong></label>
                            <input type="text" name="father_Mname" class="form-control"
                                value="{{ old('father_Mname') }}">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Last Name</strong></label>
                            <input type="text" name="father_Lname" class="form-control"
                                value="{{ old('father_Lname') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Address</strong></label>
                            <input type="text" name="father_address" class="form-control"
                                value="{{ old('father_address') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Cell No.</strong></label>
                            <input type="text" name="father_cell_no" class="form-control"
                                value="{{ old('father_cell_no') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label><strong>Age</strong></label>
                            <input type="number" name="father_age" class="form-control"
                                value="{{ old('father_age') }}" min="0">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Religion</strong></label>
                            <input type="text" name="father_religion" class="form-control"
                                value="{{ old('father_religion') }}">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Birthdate</strong></label>
                            <input type="date" name="father_birthdate" class="form-control"
                                value="{{ old('father_birthdate') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Profession</strong></label>
                            <input type="text" name="father_profession" class="form-control"
                                value="{{ old('father_profession') }}">
                        </div>
                        <div class="col-md-6">
                            <label><strong>Occupation</strong></label>
                            <input type="text" name="father_occupation" class="form-control"
                                value="{{ old('father_occupation') }}">
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
                            <input type="text" name="mother_Fname" class="form-control"
                                value="{{ old('mother_Fname') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Middle Name</strong></label>
                            <input type="text" name="mother_Mname" class="form-control"
                                value="{{ old('mother_Mname') }}">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Last Name</strong></label>
                            <input type="text" name="mother_Lname" class="form-control"
                                value="{{ old('mother_Lname') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Address</strong></label>
                            <input type="text" name="mother_address" class="form-control"
                                value="{{ old('mother_address') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Cell No.</strong></label>
                            <input type="text" name="mother_cell_no" class="form-control"
                                value="{{ old('mother_cell_no') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label><strong>Age</strong></label>
                            <input type="number" name="mother_age" class="form-control"
                                value="{{ old('mother_age') }}" min="0">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Religion</strong></label>
                            <input type="text" name="mother_religion" class="form-control"
                                value="{{ old('mother_religion') }}">
                        </div>
                        <div class="col-md-4">
                            <label><strong>Birthdate</strong></label>
                            <input type="date" name="mother_birthdate" class="form-control"
                                value="{{ old('mother_birthdate') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Profession</strong></label>
                            <input type="text" name="mother_profession" class="form-control"
                                value="{{ old('mother_profession') }}">
                        </div>
                        <div class="col-md-6">
                            <label><strong>Occupation</strong></label>
                            <input type="text" name="mother_occupation" class="form-control"
                                value="{{ old('mother_occupation') }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-secondary prev-step">Back</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

   {{-- Modal Popup for Validation Warning --}}
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
    <div class="mb-3">
        <i class="fa fa-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
    </div>
    <h5 class="fw-bold text-danger">Please fill out all required fields</h5>
    <p class="text-muted">Some fields are missing. Kindly complete them before proceeding.</p>
</div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Go Back</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const steps = document.querySelectorAll(".form-step");
        const nextBtns = document.querySelectorAll(".next-step");
        const prevBtns = document.querySelectorAll(".prev-step");
        let currentStep = 0;

        const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));

        function showStep(step) {
            steps.forEach((s, i) => {
                s.classList.toggle("d-none", i !== step);
            });
        }

        function validateStep(step) {
            const inputs = steps[step].querySelectorAll("input[required]");
            for (let input of inputs) {
                if (!input.value.trim()) {
                    return false;
                }
            }
            return true;
        }

        nextBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                } else {
                    validationModal.show();
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

    {{-- Step Navigation Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const steps = document.querySelectorAll(".form-step");
            const nextBtns = document.querySelectorAll(".next-step");
            const prevBtns = document.querySelectorAll(".prev-step");
            const form = document.getElementById("registrationForm");
            const toastEl = document.getElementById("formToast");
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            let currentStep = 0;

            function showStep(step) {
                steps.forEach((s, i) => {
                    s.classList.toggle("d-none", i !== step);
                });
            }

            function validateStep(step) {
                const inputs = steps[step].querySelectorAll("input[required]");
                for (let input of inputs) {
                    if (!input.value.trim()) {
                        toast.show();
                        input.focus();
                        return false;
                    }
                }
                return true;
            }

            nextBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if (validateStep(currentStep)) {
                        if (currentStep < steps.length - 1) {
                            currentStep++;
                            showStep(currentStep);
                        }
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

            form.addEventListener("submit", function (e) {
                if (!validateStep(currentStep)) {
                    e.preventDefault();
                }
            });

            showStep(currentStep);
        });
    </script>
</x-app-layout>