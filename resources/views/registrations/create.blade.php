<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header d-flex justify-content-between align-items-center">
            Registration
            <a href="{{ route('registration.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </h2>

        <div class="card-body">
            <form id="registrationForm" action="{{ route('registration.store') }}" method="POST" novalidate>
                @csrf


                {{-- Student Info --}}
                <!-- <h5 class="mb-3"><i class="fa fa-user-graduate text-primary"></i>FPR</h5> -->

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label><strong>First Name</strong></label>
                        <input type="text" name="student_Fname" class="form-control" value="{{ old('student_Fname') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label><strong>Middle Name</strong></label>
                        <input type="text" name="student_Mname" class="form-control" value="{{ old('student_Mname') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label><strong>Last Name</strong></label>
                        <input type="text" name="student_Lname" class="form-control" value="{{ old('student_Lname') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label><strong>Confirm Password</strong></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label><strong>User Type</strong></label>
                        <select name="type" class="form-control" required>
                            <option value="">Select</option>
                            <option value="student" {{ old('type') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="teacher" {{ old('type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="cashier" {{ old('type') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="librarian" {{ old('type') == 'librarian' ? 'selected' : '' }}>Librarian</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Validation Modal --}}
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
                    <p class="text-muted">Some fields are missing. Kindly complete them before submitting.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Go Back</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Validation Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registrationForm");
            const validationModalEl = document.getElementById("validationModal");
            const validationModal = new bootstrap.Modal(validationModalEl);

            form.addEventListener("submit", function (e) {
                const requiredFields = form.querySelectorAll("[required]");
                let valid = true;
                let firstEmptyField = null;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add("is-invalid");
                        if (!firstEmptyField) firstEmptyField = field;
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                if (!valid) {
                    e.preventDefault(); // stop form submission
                    validationModal.show(); // show modal
                    if (firstEmptyField) firstEmptyField.focus(); // focus first empty field
                }
            });

            // Remove red border as user types
            const requiredFields = form.querySelectorAll("[required]");
            requiredFields.forEach(field => {
                field.addEventListener("input", function () {
                    if (field.value.trim()) field.classList.remove("is-invalid");
                });
            });
        });
    </script>
</x-app-layout>
