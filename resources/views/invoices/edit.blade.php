<x-app-layout>
    <!-- Page Content Wrapper -->
    <div id="page-content">
        <!-- Normal page content goes here -->
    </div>

    <!-- Edit Invoice Modal -->
    <div class="modal fade" id="invoiceEditModal" tabindex="-1" aria-labelledby="invoiceEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="invoiceEditModalLabel">
                        <i class="fa fa-edit"></i> Edit Invoice
                    </h5>
                    <a href="{{ route('invoices.index') }}" class="btn-close"></a>
                </div>

                <form action="{{ route('invoices.update', $invoice->invoice_id) }}" method="POST" id="invoiceEditForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        {{-- Amount --}}
                        <div class="mb-3">
                            <label for="amount" class="form-label"><strong>Amount:</strong></label>
                            <input type="number" step="0.01" min="0" name="amount" id="amount"
                                   value="{{ old('amount', $invoice->amount) }}"
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
                                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="partial" {{ $invoice->status == 'partial' ? 'selected' : '' }}>Partial</option>
                            </select>
                            @error('status')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Insurance --}}
                        <div class="mb-3">
                            <label for="insurance" class="form-label"><strong>Insurance:</strong></label>
                            <input type="number" step="0.01" min="0" name="insurance" id="insurance"
                                   value="{{ old('insurance', $invoice->insurance) }}"
                                   class="form-control @error('insurance') is-invalid @enderror">
                            @error('insurance')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sanitation --}}
                        <div class="mb-3">
                            <label for="sanitation" class="form-label"><strong>Sanitation:</strong></label>
                            <input type="number" step="0.01" min="0" name="sanitation" id="sanitation"
                                   value="{{ old('sanitation', $invoice->sanitation) }}"
                                   class="form-control @error('sanitation') is-invalid @enderror">
                            @error('sanitation')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Scholarship --}}
                        <div class="mb-3">
                            <label for="scholarship" class="form-label"><strong>Scholarship:</strong></label>
                            <input type="number" step="0.01" min="0" name="scholarship" id="scholarship"
                                   value="{{ old('scholarship', $invoice->scholarship) }}"
                                   class="form-control @error('scholarship') is-invalid @enderror">
                            @error('scholarship')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Balance (Auto-calculated) --}}
                        <div class="mb-3">
                            <label for="balance" class="form-label"><strong>Balance:</strong></label>
                            <input type="number" step="0.01" min="0" name="balance" id="balance"
                                   value="{{ old('balance', $invoice->balance) }}" class="form-control" readonly>
                        </div>

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> Update
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-dark btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Auto-show modal, blur background, and calculate balance --}}
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

        document.addEventListener('DOMContentLoaded', function() {
            var modalEl = document.getElementById('invoiceEditModal');
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });

            modal.show();

            modalEl.addEventListener('shown.bs.modal', function () {
                document.getElementById('page-content').style.filter = 'blur(6px)';
                document.getElementById('page-content').style.pointerEvents = 'none';
                calculateBalance(); // Initialize balance on load
            });

            modalEl.addEventListener('hidden.bs.modal', function () {
                document.getElementById('page-content').style.filter = '';
                document.getElementById('page-content').style.pointerEvents = '';
            });
        });
    </script>
</x-app-layout>
