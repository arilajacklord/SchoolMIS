<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Add New Payment</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-primary btn-sm" href="{{ route('payments.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                {{-- Invoice Dropdown --}}
                <div class="mb-3">
                    <label for="invoice_id" class="form-label"><strong>Invoice:</strong></label>
                    <select name="invoice_id" id="invoice_id" class="form-select @error('invoice_id') is-invalid @enderror">
                        <option value="">-- Select Invoice --</option>
                        @foreach($invoices as $invoice)
                            <option value="{{ $invoice->id }}" {{ old('invoice_id') == $invoice->id ? 'selected' : '' }}>
                                Invoice #{{ $invoice->id }} - ₱{{ number_format($invoice->amount, 2) }}
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
                    <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror">
                    @error('date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Total Amount --}}
                <div class="mb-3">
                    <label for="total_amount" class="form-label"><strong>Total Amount:</strong></label>
                    <input type="number" step="0.01" name="total_amount" id="total_amount" value="{{ old('total_amount') }}" class="form-control @error('total_amount') is-invalid @enderror">
                    @error('total_amount')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Payment Type --}}
                <div class="mb-3">
                    <label for="paymenttype" class="form-label"><strong>Payment Type:</strong></label>
                    <select name="paymenttype" id="paymenttype" class="form-select @error('paymenttype') is-invalid @enderror">
                        <option value="">-- Select Payment Type --</option>
                        <option value="cash" {{ old('paymenttype') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ old('paymenttype') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="gcash" {{ old('paymenttype') == 'gcash' ? 'selected' : '' }}>GCash</option>
                        <option value="check" {{ old('paymenttype') == 'check' ? 'selected' : '' }}>Check</option>
                    </select>
                    @error('paymenttype')
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
