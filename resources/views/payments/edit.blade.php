<x-app-layout>
    {{-- Edit Payment Modal --}}
    <div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('payments.update', $payment->payment_id) }}" method="POST" id="editPaymentForm">
                        @csrf
                        @method('PUT')

                        {{-- Invoice --}}
                        <div class="mb-3">
                            <label for="invoice_id" class="form-label"><strong>Invoice:</strong></label>
                            <select name="invoice_id" id="invoice_id" class="form-select @error('invoice_id') is-invalid @enderror">
                                <option value="">-- Select Invoice --</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice->id }}" {{ $payment->invoice_id == $invoice->id ? 'selected' : '' }}>
                                        Invoice #{{ $invoice->id }} - {{ $invoice->status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('invoice_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label for="date" class="form-label"><strong>Date:</strong></label>
                            <input type="date" name="date" id="date" value="{{ old('date', $payment->date) }}" 
                                   class="form-control @error('date') is-invalid @enderror">
                            @error('date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Total Amount --}}
                        <div class="mb-3">
                            <label for="total_amount" class="form-label"><strong>Total Amount:</strong></label>
                            <input type="number" step="0.01" name="total_amount" id="total_amount"
                                   value="{{ old('total_amount', $payment->total_amount) }}"
                                   class="form-control @error('total_amount') is-invalid @enderror">
                            @error('total_amount')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Payment Type --}}
                        <div class="mb-3">
                            <label for="paymenttype" class="form-label"><strong>Payment Type:</strong></label>
                            <select name="paymenttype" id="paymenttype" class="form-select @error('paymenttype') is-invalid @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="cash" {{ $payment->paymenttype == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ $payment->paymenttype == 'card' ? 'selected' : '' }}>Card</option>
                                <option value="online" {{ $payment->paymenttype == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('paymenttype')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                    <button type="submit" form="editPaymentForm" class="btn btn-success">
                        <i class="fa fa-save"></i> Update Payment
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
