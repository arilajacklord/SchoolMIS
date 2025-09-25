<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Invoices List</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Add Invoice
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Enrollment</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Insurance</th>
                        <th>Sanitation</th>
                        <th>Balance</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $index => $invoice)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $invoice->enroll_id }}</td>
                            <td>{{ number_format($invoice->amount, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($invoice->status === 'paid') bg-success 
                                    @elseif($invoice->status === 'overdue') bg-danger 
                                    @else bg-warning @endif">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td>{{ number_format($invoice->insurance ?? 0, 2) }}</td>
                            <td>{{ number_format($invoice->sanitation ?? 0, 2) }}</td>
                            <td>{{ number_format($invoice->balance ?? 0, 2) }}</td>
                            <td>{{ $invoice->due_date }}</td>
                            <td>
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this invoice?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
