<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Edit Invoice</h2>
        <div class="card-body">

            <a href="{{ route('invoices.index') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-arrow-left"></i> Back
            </a>

            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Enrollment --}}
                <div class="mb-3">
                    <label for="enroll_id" class="form-label"><strong>Enrollment:</strong></label>
                    <select name="enroll_id" id="enroll_id" class="form-select @error('enroll_id') is-invalid @enderror">
                        <option value="">-- Select Enrollment --</option>
                        @foreach($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" {{ $invoice->enroll_id == $enrollment->id ? 'selected' : '' }}>
                                {{ $enrollment->user->name ?? 'N/A' }} - {{ $enrollment->subject->descriptive_title ?? 'N/A' }}
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
                    <input type="number" step="0.01" name="amount" id="amount"
                           value="{{ old('amount', $invoice->amount) }}"
                           class="form-control @error('amount') is-invalid @enderror">
                    @error('amount')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label for="due_date" class="form-label"><strong>Due Date:</strong></label>
                    <input type="date" name="due_date" id="due_date"
                           value="{{ old('due_date', $invoice->due_date) }}"
                           class="form-control @error('due_date') is-invalid @enderror">
                    @error('due_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label"><strong>Status:</strong></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">-- Select Status --</option>
                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="overdue" {{ $invoice->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                    @error('status')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Insurance --}}
                <div class="mb-3">
                    <label for="insurance" class="form-label"><strong>Insurance:</strong></label>
                    <input type="number" step="0.01" name="insurance" id="insurance"
                           value="{{ old('insurance', $invoice->insurance) }}"
                           class="form-control @error('insurance') is-invalid @enderror">
                    @error('insurance')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sanitation --}}
                <div class="mb-3">
                    <label for="sanitation" class="form-label"><strong>Sanitation:</strong></label>
                    <input type="number" step="0.01" name="sanitation" id="sanitation"
                           value="{{ old('sanitation', $invoice->sanitation) }}"
                           class="form-control @error('sanitation') is-invalid @enderror">
                    @error('sanitation')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Balance --}}
                <div class="mb-3">
                    <label for="balance" class="form-label"><strong>Balance:</strong></label>
                    <input type="number" step="0.01" name="balance" id="balance"
                           value="{{ old('balance', $invoice->balance) }}"
                           class="form-control @error('balance') is-invalid @enderror">
                    @error('balance')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
