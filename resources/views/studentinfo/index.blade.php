<x-app-layout>

    <!-- Alerts -->
    @if ($errors->any())
        <div class="alert alert-danger mt-4 mx-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4 mx-4">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mt-4 mx-4">{{ session('success') }}</div>
    @endif

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <!-- Back button -->
        <a href="{{ route('registration.index') }}" class="btn btn-secondary btn-sm me-3">
            <i class="fas fa-arrow-left"><-</i> 
        </a>

        <!-- Heading -->
        @if($registrations->isNotEmpty())
            <h2 class="mb-0">StudentInfo for {{ $registrations->first()->user->name ?? 'N/A' }}</h2>
        @else
            <h2 class="mb-0">Student Info</h2>
        @endif
    </div>

    <!-- Add Student button -->
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fa fa-plus"></i> Add Student Info
    </button>
</div>


        <div class="card-body">
            <div class="table-responsive">
                <table id="studentInfoTable" class="table table-striped table-bordered table-hover align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Parent Number</th>
                            <th>Type</th>
                            <th>Email</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reg->student_Fname }} {{ $reg->student_Mname }} {{ $reg->student_Lname }}</td>
                                <td>{{ $reg->father_Fname }} {{ $reg->father_Lname }} & {{ $reg->mother_Fname }} {{ $reg->mother_Lname }}</td>
                                <td>{{ $reg->father_cell_no }} || {{ $reg->mother_cell_no }}</td>
                                <td>{{ $reg->user->type ?? 'N/A' }}</td>
                                <td>{{ $reg->user->email ?? 'N/A' }}</td>
                                <!-- <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $reg->id }}">
                                        <i class="fa fa-eye">View</i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $reg->id }}">
                                        <i class="fa fa-edit">Edit</i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reg->id }}">
                                        <i class="fa fa-trash">Delete</i>
                                    </button>
                                </td> -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">No registrations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- View Modal -->
@foreach($registrations as $reg)
<div class="modal fade" id="viewModal{{ $reg->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- PSA Header -->
            <div class="modal-header text-center w-100 border-bottom-0">
                <div class="w-100">
                    <h5 class="modal-title fw-bold">
                        <!-- Republic of the Philippines<br>
                        Department of Information Technology<br> -->
                        <u>Student Information Sheet</u>
                    </h5>
                    <small class="text-muted">Confidential and Official Document</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <!-- STUDENT INFORMATION -->
                <h5 class="text-primary fw-bold mb-3">I. Student Information</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>First Name:</strong> {{ $reg->student_Fname }}</div>
                    <div class="col-md-4"><strong>Middle Name:</strong> {{ $reg->student_Mname }}</div>
                    <div class="col-md-4"><strong>Last Name:</strong> {{ $reg->student_Lname }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Email:</strong> {{ $reg->user->email ?? $reg->email }}</div>
                    <div class="col-md-4"><strong>Course Level:</strong> {{ $reg->course_level }}</div>
                    <div class="col-md-4"><strong>Address:</strong> {{ $reg->student_address }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Phone Number:</strong> {{ $reg->student_phone_num }}</div>
                    <div class="col-md-4"><strong>Status:</strong> {{ $reg->student_status }}</div>
                    <div class="col-md-4"><strong>Citizenship:</strong> {{ $reg->student_citizenship }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Birthdate:</strong> {{ $reg->student_birthdate }}</div>
                    <div class="col-md-4"><strong>Religion:</strong> {{ $reg->student_religion }}</div>
                    <div class="col-md-4"><strong>Age:</strong> {{ $reg->student_age }}</div>
                </div>

                <!-- FATHER INFORMATION -->
                <h5 class="text-success fw-bold mb-3 mt-4">II. Father Information</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>First Name:</strong> {{ $reg->father_Fname }}</div>
                    <div class="col-md-4"><strong>Middle Name:</strong> {{ $reg->father_Mname }}</div>
                    <div class="col-md-4"><strong>Last Name:</strong> {{ $reg->father_Lname }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Address:</strong> {{ $reg->father_address }}</div>
                    <div class="col-md-4"><strong>Cell Number:</strong> {{ $reg->father_cell_no }}</div>
                    <div class="col-md-4"><strong>Age:</strong> {{ $reg->father_age }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Religion:</strong> {{ $reg->father_religion }}</div>
                    <div class="col-md-4"><strong>Birthdate:</strong> {{ $reg->father_birthdate }}</div>
                    <div class="col-md-4"><strong>Profession:</strong> {{ $reg->father_profession }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12"><strong>Occupation:</strong> {{ $reg->father_occupation }}</div>
                </div>

                <!-- MOTHER INFORMATION -->
                <h5 class="text-pink-600 fw-bold mb-3 mt-4">III. Mother Information</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>First Name:</strong> {{ $reg->mother_Fname }}</div>
                    <div class="col-md-4"><strong>Middle Name:</strong> {{ $reg->mother_Mname }}</div>
                    <div class="col-md-4"><strong>Last Name:</strong> {{ $reg->mother_Lname }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Address:</strong> {{ $reg->mother_address }}</div>
                    <div class="col-md-4"><strong>Cell Number:</strong> {{ $reg->mother_cell_no }}</div>
                    <div class="col-md-4"><strong>Age:</strong> {{ $reg->mother_age }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Religion:</strong> {{ $reg->mother_religion }}</div>
                    <div class="col-md-4"><strong>Birthdate:</strong> {{ $reg->mother_birthdate }}</div>
                    <div class="col-md-4"><strong>Profession:</strong> {{ $reg->mother_profession }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12"><strong>Occupation:</strong> {{ $reg->mother_occupation }}</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

                        
<div class="modal fade" id="editModal{{ $reg->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('registration.update', $reg->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    {{-- STEP 1 - Student Info --}}
                    <div class="form-step" id="edit-step-1-{{ $reg->id }}">
                        <h5 class="mb-3">Student Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="student_Fname" class="form-control" value="{{ old('student_Fname', $reg->student_Fname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="student_Mname" class="form-control" value="{{ old('student_Mname', $reg->student_Mname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="student_Lname" class="form-control" value="{{ old('student_Lname', $reg->student_Lname) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Course Level</label>
                                <input type="text" name="course_level" class="form-control" value="{{ old('course_level', $reg->course_level) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="student_address" class="form-control" value="{{ old('student_address', $reg->student_address) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="student_phone_num" class="form-control" value="{{ old('student_phone_num', $reg->student_phone_num) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <input type="text" name="student_status" class="form-control" value="{{ old('student_status', $reg->student_status) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Citizenship</label>
                                <input type="text" name="student_citizenship" class="form-control" value="{{ old('student_citizenship', $reg->student_citizenship) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="student_birthdate" class="form-control" value="{{ old('student_birthdate', $reg->student_birthdate) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="student_religion" class="form-control" value="{{ old('student_religion', $reg->student_religion) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="student_age" class="form-control" value="{{ old('student_age', $reg->student_age) }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary edit-next" data-modal="{{ $reg->id }}">Next</button>
                        </div>
                    </div>

                    {{-- STEP 2 - Father Info --}}
                    <div class="form-step d-none" id="edit-step-2-{{ $reg->id }}">
                        <h5 class="mb-3">Father Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="father_Fname" class="form-control" value="{{ old('father_Fname', $reg->father_Fname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="father_Mname" class="form-control" value="{{ old('father_Mname', $reg->father_Mname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="father_Lname" class="form-control" value="{{ old('father_Lname', $reg->father_Lname) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="father_address" class="form-control" value="{{ old('father_address', $reg->father_address) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cell Number</label>
                                <input type="text" name="father_cell_no" class="form-control" value="{{ old('father_cell_no', $reg->father_cell_no) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="father_age" class="form-control" value="{{ old('father_age', $reg->father_age) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="father_religion" class="form-control" value="{{ old('father_religion', $reg->father_religion) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="father_birthdate" class="form-control" value="{{ old('father_birthdate', $reg->father_birthdate) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profession</label>
                                <input type="text" name="father_profession" class="form-control" value="{{ old('father_profession', $reg->father_profession) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="father_occupation" class="form-control" value="{{ old('father_occupation', $reg->father_occupation) }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary edit-prev" data-modal="{{ $reg->id }}">Back</button>
                            <button type="button" class="btn btn-primary edit-next" data-modal="{{ $reg->id }}">Next</button>
                        </div>
                    </div>

                    {{-- STEP 3 - Mother Info --}}
                    <div class="form-step d-none" id="edit-step-3-{{ $reg->id }}">
                        <h5 class="mb-3">Mother Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="mother_Fname" class="form-control" value="{{ old('mother_Fname', $reg->mother_Fname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="mother_Mname" class="form-control" value="{{ old('mother_Mname', $reg->mother_Mname) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="mother_Lname" class="form-control" value="{{ old('mother_Lname', $reg->mother_Lname) }}">
                            </div>
                        </div>
                        <div class="row mb-3">  
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="mother_address" class="form-control" value="{{ old('mother_address', $reg->mother_address) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cell Number</label>
                                <input type="text" name="mother_cell_no" class="form-control" value="{{ old('mother_cell_no', $reg->mother_cell_no) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="mother_age" class="form-control" value="{{ old('mother_age', $reg->mother_age) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="mother_religion" class="form-control" value="{{ old('mother_religion', $reg->mother_religion) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="mother_birthdate" class="form-control" value="{{ old('mother_birthdate', $reg->mother_birthdate) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profession</label>
                                <input type="text" name="mother_profession" class="form-control" value="{{ old('mother_profession', $reg->mother_profession) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="mother_occupation" class="form-control" value="{{ old('mother_occupation', $reg->mother_occupation) }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary edit-prev" data-modal="{{ $reg->id }}">Back</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


                      
                        <div class="modal fade" id="deleteModal{{ $reg->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this registration?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('registration.destroy', $reg->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Registration Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ isset($reg) ? route('registration.update', $reg->id) : route('registration.store') }}" method="POST">
                @csrf
                @if(isset($reg))
                    @method('PUT')
                @endif
                <div class="modal-body">

                    {{-- STEP 1 - Student Info --}}
                    <div class="form-step" id="step-1">
                        <h5 class="mb-3"><i class="fa fa-user-graduate text-primary"></i> Student Information</h5>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="student_Fname" class="form-control" value="{{ $reg->student_Fname ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="student_Mname" class="form-control" value="{{ $reg->student_Mname ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="student_Lname" class="form-control" value="{{ $reg->student_Lname ?? '' }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $reg->user->email ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type</label>
                                <input type="text" name="type" class="form-control" value="{{ $reg->user->type ?? '' }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Course Level</strong></label>
                                <select name="course_level" class="form-control" required>
                                    <option value="" disabled selected>Select Course Level</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="student_address" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="student_phone_num" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><strong>Status</strong></label>
                                <select name="student_status" class="form-control" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Citizenship</label>
                                <input type="text" name="student_citizenship" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="student_birthdate" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="student_religion" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="student_age" class="form-control" min="0">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                    </div>

                    {{-- STEP 2 - Father Info --}}
                    <div class="form-step d-none" id="step-2">
                        <h5 class="mb-3"><i class="fas fa-male text-success"></i> Father Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="father_Fname" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="father_Mname" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="father_Lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="father_address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cell Number</label>
                                <input type="text" name="father_cell_no" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="father_age" class="form-control" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="father_religion" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="father_birthdate" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profession</label>
                                <input type="text" name="father_profession" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="father_occupation" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-step">Back</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                    </div>

                    {{-- STEP 3 - Mother Info --}}
                    <div class="form-step d-none" id="step-3">
                        <h5 class="mb-3"><i class="fas fa-female text-pink-600"></i> Mother Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="mother_Fname" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="mother_Mname" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="mother_Lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="mother_address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cell Number</label>
                                <input type="text" name="mother_cell_no" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="mother_age" class="form-control" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="mother_religion" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="mother_birthdate" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profession</label>
                                <input type="text" name="mother_profession" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="mother_occupation" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-step">Back</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </div>
            </form>

            <!-- Validation Modal Inside Create Modal -->
            <div class="modal fade" id="createValidationModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

        </div>
    </div>
</div>

<!-- Create Modal Validation Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const createModalEl = document.getElementById('createModal');
    const steps = createModalEl.querySelectorAll(".form-step");
    const nextBtns = createModalEl.querySelectorAll(".next-step");
    const prevBtns = createModalEl.querySelectorAll(".prev-step");
    const form = createModalEl.querySelector("form");
    let currentStep = 0;

    const validationModal = new bootstrap.Modal(createModalEl.querySelector('#createValidationModal'));

    function showStep(step) {
        steps.forEach((s, i) => s.classList.toggle("d-none", i !== step));
    }

    function validateStep(step) {
        const inputs = steps[step].querySelectorAll("input[required]");
        for (let input of inputs) {
            if (!input.value.trim()) {
                validationModal.show();
                input.focus();
                return false;
            }
        }
        return true;
    }

    function validateAllSteps() {
        for (let i = 0; i < steps.length; i++) {
            const inputs = steps[i].querySelectorAll("input[required]");
            for (let input of inputs) {
                if (!input.value.trim()) {
                    currentStep = i;
                    showStep(currentStep);
                    validationModal.show();
                    input.focus();
                    return false;
                }
            }
        }
        return true;
    }

    nextBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        const inputs = steps[currentStep].querySelectorAll("input[required]");
        let allFilled = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                allFilled = false;
            }
        });

        if (!allFilled) {
            // Show validation modal and stay on current step
            validationModal.show();
        } else if (currentStep < steps.length - 1) {
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

    form.addEventListener("submit", function (e) {
        if (!validateAllSteps()) {
            e.preventDefault();
        } else {
            if (!confirm("Are you sure you want to create this student?")) {
                e.preventDefault();
            }
        }
    });

    showStep(currentStep);
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const createModal = document.getElementById('createModal');
    const steps = createModal.querySelectorAll(".form-step");
    const nextBtns = createModal.querySelectorAll(".next-step");
    const prevBtns = createModal.querySelectorAll(".prev-step");
    const form = createModal.querySelector("form");
    let currentStep = 0;

    const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));

    function showStep(step) {
        steps.forEach((s, i) => s.classList.toggle("d-none", i !== step));
    }

    // Validate required fields in the current step
    function validateStep(step) {
        const inputs = steps[step].querySelectorAll("input[required]");
        for (let input of inputs) {
            if (!input.value.trim()) {
                input.focus();
                return false;
            }
        }
        return true;
    }

    // Next buttons
    nextBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault(); // prevent default step change
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

    // Previous buttons
    prevBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Form submit: validate all steps before sending
    form.addEventListener("submit", function (e) {
        for (let i = 0; i < steps.length; i++) {
            if (!validateStep(i)) {
                currentStep = i;
                showStep(currentStep);
                validationModal.show();
                e.preventDefault();
                return false;
            }
        }
    });

    showStep(currentStep);
});
</script>


<!-- Edit Modal Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        let steps = modal.querySelectorAll('.form-step');
        let currentStep = 0;

        const showStep = (step) => {
            steps.forEach((s, i) => s.classList.toggle('d-none', i !== step));
        };

        modal.querySelectorAll('.edit-next').forEach(btn => {
            btn.addEventListener('click', () => {
                if(currentStep < steps.length - 1){
                    currentStep++;
                    showStep(currentStep);
                }
            });
        });

        modal.querySelectorAll('.edit-prev').forEach(btn => {
            btn.addEventListener('click', () => {
                if(currentStep > 0){
                    currentStep--;
                    showStep(currentStep);
                }
            });
        });

        showStep(currentStep);
    });
});
</script>
</x-app-layout>
