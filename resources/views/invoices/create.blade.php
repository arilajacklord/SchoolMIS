    <x-app-layout>
        <div class="card mt-5">
            <h2 class="card-header">Add New Invoice</h2>
            <div class="card-body">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <a class="btn btn-primary btn-sm" href="{{ route('invoices.index') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf

                    {{-- Enrollment Dropdown --}}
                    <div class="mb-3">
                        <label for="enroll_id" class="form-label"><strong>Enrollment:</strong></label>
                        <select name="enroll_id" id="enroll_id" class="form-select @error('enroll_id') is-invalid @enderror">
                            <option value="">-- Select Student --</option>
                            @foreach($enrollments as $enroll)
                                <option value="{{ $enroll->id }}" {{ old('enroll_id') == $enroll->id ? 'selected' : '' }}>
                                    Enrollment #{{ $enroll->id }} - {{ $enroll->user->student_name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('enroll_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="mb-3">
                        <label for="amount" class="form-label"><strong>Amount:</strong></label>
                        <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror">
                        @error('amount')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label"><strong>Status:</strong></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">-- Select Status --</option>
                            <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                        @error('status')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Insurance --}}
                    <div class="mb-3">
                        <label for="insurance" class="form-label"><strong>Insurance:</strong></label>
                        <input type="number" step="0.01" name="insurance" id="insurance" value="{{ old('insurance') }}" class="form-control @error('insurance') is-invalid @enderror">
                        @error('insurance')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Sanitation --}}
                    <div class="mb-3">
                        <label for="sanitation" class="form-label"><strong>Sanitation:</strong></label>
                        <input type="number" step="0.01" name="sanitation" id="sanitation" value="{{ old('sanitation') }}" class="form-control @error('sanitation') is-invalid @enderror">
                        @error('sanitation')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Balance --}}
                    <div class="mb-3">
                        <label for="balance" class="form-label"><strong>Balance:</strong></label>
                        <input type="number" step="0.01" name="balance" id="balance" value="{{ old('balance') }}" class="form-control @error('balance') is-invalid @enderror">
                        @error('balance')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-3">
                        <label for="due_date" class="form-label"><strong>Due Date:</strong></label>
                        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="form-control @error('due_date') is-invalid @enderror">
                        @error('due_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-disk"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </x-app-layout>
