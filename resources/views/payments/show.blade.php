<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Payment Details</h2>
        <div class="card-body">

            <a href="{{ route('payments.index') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-arrow-left"></i> Back
            </a>

            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $payment->id }}</td>
                </tr>
                <tr>
                    <th>Invoice</th>
                    <td>Invoice #{{ $payment->invoice->id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $payment->date }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>₱{{ number_format($payment->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Payment Type</th>
                    <td>{{ ucfirst($payment->paymenttype) }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2">
                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Delete this payment?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
                {{-- Print button --}}
                <a href="{{ route('payments.print', $payment->id) }}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Print
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
