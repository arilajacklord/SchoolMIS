<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Edit Payment</h2>
        <div class="card-body">

            <a href="{{ route('payments.index') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-arrow-left"></i> Back
            </a>

            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
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

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
