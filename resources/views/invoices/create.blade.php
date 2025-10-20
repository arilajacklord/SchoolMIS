<x-app-layout>
    <!-- Create Invoice Modal -->
    <div class="modal fade" id="invoiceCreateModal" tabindex="-1" aria-labelledby="invoiceCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="invoiceCreateModalLabel">
                        <i class="fa fa-file-invoice-dollar"></i> Add New Invoice
                    </h5>
                    <a href="{{ route('invoices.index') }}" class="btn-close btn-close-white"></a>
                </div>
                
                <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
                    @csrf
                    <div class="modal-body">
                        {{-- Enrollment Dropdown --}}
                        <div class="mb-3">
                            <label for="enroll_id" class="form-label"><strong>Enrollment:</strong></label>
                            <select name="enroll_id" id="enroll_id" class="form-select @error('enroll_id') is-invalid @enderror">
                                <option value="">-- Select Student --</option>
                                @foreach($enrollments as $enroll)
                                    <option value="{{ $enroll->enroll_id }}" {{ old('enroll_id') == $enroll->enroll_id ? 'selected' : '' }}>
                                        {{ $enroll->enroll_id }} - {{ $enroll->user->name ?? 'N/A' }}
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
                            <input type="number" step="0.01" min="0" name="amount" id="amount" 
                                   value="{{ old('amount') }}" 
                                   class="form-control @error('amount') is-invalid @enderror">
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
                                <option value="partial" {{ old('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                            </select>
                            @error('status')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Insurance --}}
                        <div class="mb-3">
                            <label for="insurance" class="form-label"><strong>Insurance:</strong></label>
                            <input type="number" step="0.01" min="0" name="insurance" id="insurance" 
                                   value="{{ old('insurance') }}" 
                                   class="form-control @error('insurance') is-invalid @enderror">
                            @error('insurance')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sanitation --}}
                        <div class="mb-3">
                            <label for="sanitation" class="form-label"><strong>Sanitation:</strong></label>
                            <input type="number" step="0.01" min="0" name="sanitation" id="sanitation" 
                                   value="{{ old('sanitation') }}" 
                                   class="form-control @error('sanitation') is-invalid @enderror">
                            @error('sanitation')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Scholarship --}}
                        <div class="mb-3">
                            <label for="scholarship" class="form-label"><strong>Scholarship:</strong></label>
                            <input type="number" step="0.01" min="0" name="scholarship" id="scholarship" 
                                   value="{{ old('scholarship') }}" 
                                   class="form-control @error('scholarship') is-invalid @enderror">
                            @error('scholarship')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Balance (Auto Calculated) --}}
                        <div class="mb-3">
                            <label for="balance" class="form-label"><strong>Balance:</strong></label>
                            <input type="number" step="0.01" min="0" name="balance" id="balance" 
                                   value="{{ old('balance') }}" 
                                   class="form-control @error('balance') is-invalid @enderror" readonly>
                            @error('balance')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> Submit
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-dark btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Balance Calculation Script --}}
    <script>
        function calculateBalance() {
            let amount = parseFloat(document.getElementById('amount').value) || 0;
            let insurance = parseFloat(document.getElementById('insurance').value) || 0;
            let sanitation = parseFloat(document.getElementById('sanitation').value) || 0;
            let scholarship = parseFloat(document.getElementById('scholarship').value) || 0;

            let balance = (amount + insurance + sanitation) - scholarship;
            document.getElementById('balance').value = balance.toFixed(2);
        }

        ['amount','insurance','sanitation','scholarship'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateBalance);
        });

        // Auto-show modal and blur background
        document.addEventListener('DOMContentLoaded', function() {
            var modalEl = document.getElementById('invoiceCreateModal');
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });

            modal.show();

            // Blur only the page content
            modalEl.addEventListener('shown.bs.modal', function () {
                document.getElementById('page-content').style.filter = 'blur(6px)';
                document.getElementById('page-content').style.pointerEvents = 'none';
            });

            modalEl.addEventListener('hidden.bs.modal', function () {
                document.getElementById('page-content').style.filter = '';
                document.getElementById('page-content').style.pointerEvents = '';
            });
        });
    </script>
</x-app-layout>
