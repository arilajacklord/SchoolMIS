<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Invoice Details</h2>
        <div class="card-body">

            <a href="{{ route('invoices.index') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-arrow-left"></i> Back
            </a>

            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $invoice->id }}</td>
                </tr>
                <tr>
                    <th>Enrollment</th>
                    <td>{{ $invoice->enrollment->user->name ?? 'N/A' }} - {{ $invoice->enrollment->subject->descriptive_title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>₱{{ number_format($invoice->amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>{{ $invoice->due_date }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($invoice->status) }}</td>
                </tr>
                <tr>
                    <th>Insurance</th>
                    <td>₱{{ number_format($invoice->insurance, 2) }}</td>
                </tr>
                <tr>
                    <th>Sanitation</th>
                    <td>₱{{ number_format($invoice->sanitation, 2) }}</td>
                </tr>
                <tr>
                    <th>Balance</th>
                    <td>₱{{ number_format($invoice->balance, 2) }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2">
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Delete this invoice?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
                {{-- Print button --}}
                <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Print
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
