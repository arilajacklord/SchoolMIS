<x-app-layout>
    {{-- Alerts --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-4 mx-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4 mx-4">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mt-4 mx-4">{{ session('success') }}</div>
    @endif

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Payments for {{ $invoice->enrollment->user->fname ?? '' }} {{ $invoice->enrollment->user->lname ?? '' }}</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                <i class="fa fa-plus"></i> Add Payment
            </button>
        </div>

        <div class="card-body mb-3 d-flex justify-content-between align-items-center">
            <div>
                <h5>Student ID: {{ $invoice->enrollment->user->id ?? 'N/A' }}</h5>
                <h5>Name: {{ $invoice->enrollment->user->fname ?? '' }} {{ $invoice->enrollment->user->minitial ?? '' }} {{ $invoice->enrollment->user->lname ?? '' }}</h5>
            </div>
            <a href="{{ route('invoices.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back to Invoices
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-white">
                    <tr>
                        <th>Payment ID</th>
                        <th>Invoice ID</th>
                        <th>Amount Paid</th>
                        <th>Payment Method</th>
                        <th>Payment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoice->payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $payment->invoice->invoice_id ?? 'N/A' }}</td>
                            <td>{{ number_format($payment->total_amount, 2) }}</td>
                            <td>{{ ucfirst($payment->paymenttype) }}</td>
                            <td>{{ $payment->date }}</td>
                            <td>
                                {{-- View Modal Trigger --}}
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewPaymentModal{{ $payment->payment_id }}">
                                    <i class="fa fa-eye"></i> View
                                </button>

                                {{-- Edit Modal Trigger --}}
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->payment_id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>

                                {{-- Delete --}}
                                <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- View Payment Modal --}}
                        <div class="modal fade" id="viewPaymentModal{{ $payment->payment_id }}" tabindex="-1" aria-labelledby="viewPaymentModalLabel{{ $payment->payment_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Payment Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Payment ID:</strong> {{ $payment->payment_id }}</p>
                                        <p><strong>Invoice ID:</strong> {{ $payment->invoice->invoice_id ?? 'N/A' }}</p>
                                        <p><strong>Amount Paid:</strong> ₱{{ number_format($payment->total_amount, 2) }}</p>
                                        <p><strong>Payment Method:</strong> {{ ucfirst($payment->paymenttype) }}</p>
                                        <p><strong>Payment Date:</strong> {{ $payment->date }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('payments.print', $payment->payment_id) }}" target="_blank" class="btn btn-secondary">
                                            <i class="fa fa-print"></i> Print
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Payment Modal --}}
                        <div class="modal fade" id="editPaymentModal{{ $payment->payment_id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->payment_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('payments.update', $payment->payment_id) }}" method="POST" id="editPaymentForm{{ $payment->payment_id }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ $payment->total_amount }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Payment Method</label>
                                                <select name="paymenttype" class="form-select" required>
                                                    <option value="cash" {{ $payment->paymenttype == 'cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="card" {{ $payment->paymenttype == 'card' ? 'selected' : '' }}>Card</option>
                                                    <option value="online" {{ $payment->paymenttype == 'online' ? 'selected' : '' }}>Online</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="date" class="form-control" value="{{ $payment->date }}" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" form="editPaymentForm{{ $payment->payment_id }}" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Payment Modal --}}
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="invoice_id" value="{{ $invoice->invoice_id }}">
                        <input type="hidden" name="user_id" value="{{ $invoice->enrollment->user->invoice_id }}">

                        
    <div class="mb-3">
        <label class="form-label">Amount</label>
        <input type="number" step="0.01" class="form-control" name="total_amount" placeholder="Enter Amount" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Payment Method</label>
        <select name="paymenttype" class="form-select" required>
            <option value="cash">Cash</option>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
        </select>
    </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
