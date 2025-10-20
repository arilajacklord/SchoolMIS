<x-app-layout>
    <!-- Page Content Wrapper -->
    <div id="page-content">
        <!-- Normal page content goes here -->
    </div>

    <!-- Show Invoice Modal -->
    <div class="modal fade" id="invoiceShowModal" tabindex="-1" aria-labelledby="invoiceShowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="invoiceShowModalLabel">
                        <i class="fa fa-file-invoice"></i> Invoice Details
                    </h5>
                    <a href="{{ route('invoices.index') }}" class="btn-close btn-close-white"></a>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>ID:</strong></label>
                        <input type="text" class="form-control" value="{{ $invoice->invoice_id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Student:</strong></label>
                        <input type="text" class="form-control" 
                               value="{{ $invoice->enrollment->user->id ?? 'N/A' }} - {{ $invoice->enrollment->user->name ?? 'N/A' }} - {{ $invoice->enrollment->subject->descriptive_title ?? 'N/A' }}" 
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Amount:</strong></label>
                        <input type="text" class="form-control" value="₱{{ number_format($invoice->amount, 2) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Status:</strong></label>
                        <input type="text" class="form-control" value="{{ ucfirst($invoice->status) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Insurance:</strong></label>
                        <input type="text" class="form-control" value="₱{{ number_format($invoice->insurance, 2) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Sanitation:</strong></label>
                        <input type="text" class="form-control" value="₱{{ number_format($invoice->sanitation, 2) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Balance:</strong></label>
                        <input type="text" class="form-control" value="₱{{ number_format($invoice->balance, 2) }}" readonly>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2">
                    <a href="{{ route('invoices.edit', $invoice->invoice_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('invoices.print', $invoice->invoice_id) }}" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fa fa-print"></i> Print
                    </a>
                    <a href="{{ route('invoices.index') }}" class="btn btn-dark btn-sm">Close</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-show modal and blur background --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalEl = document.getElementById('invoiceShowModal');
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });

            modal.show();

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
