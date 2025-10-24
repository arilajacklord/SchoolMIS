<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Payment Details</h2>
        <div class="card-body">

            {{-- Payment Details --}}
            <div class="mb-3">
                <label class="form-label"><strong>ID:</strong></label>
                <input type="text" class="form-control" value="{{ $payment->payment_id }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Invoice:</strong></label>
                <input type="text" class="form-control" value="{{ $payment->invoice->invoice_id ?? 'N/A' }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Date:</strong></label>
                <input type="text" class="form-control" value="{{ $payment->date }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Total Amount:</strong></label>
                <input type="text" class="form-control" value="₱{{ number_format($payment->total_amount, 2) }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Payment Type:</strong></label>
                <input type="text" class="form-control" value="{{ ucfirst($payment->paymenttype) }}" readonly>
            </div>

            {{-- Action Buttons moved below --}}
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('payments.index') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>

                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                    <i class="fa fa-edit"></i> Edit Payment
                </button>

                <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" onsubmit="return confirm('Delete this payment?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>

                <a href="{{ route('payments.print', $payment->payment_id) }}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Print
                </a>
            </div>

        </div>
    </div>

    {{-- Edit Payment Modal --}}
    <div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('payments.update', $payment->payment_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label"><strong>Invoice:</strong></label>
                            <input type="text" class="form-control" value="Invoice #{{ $payment->invoice->invoice_id ?? 'N/A' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Date:</strong></label>
                            <input type="date" name="date" class="form-control" value="{{ $payment->date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Total Amount:</strong></label>
                            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ $payment->total_amount }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Payment Type:</strong></label>
                            <select name="paymenttype" class="form-select">
                                <option value="cash" {{ $payment->paymenttype == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ $payment->paymenttype == 'card' ? 'selected' : '' }}>Card</option>
                                <option value="gcash" {{ $payment->paymenttype == 'gcash' ? 'selected' : '' }}>GCash</option>
                                <option value="check" {{ $payment->paymenttype == 'check' ? 'selected' : '' }}>Check</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-disk"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
