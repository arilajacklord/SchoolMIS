<x-app-layout>
    <div id="page-content">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Invoices List</h2>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceCreateModal">
                    <i class="fa fa-plus"></i> Add Invoice
                </button>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-white">
                        <tr>
                            <th>#</th>
                            <th>Enroll ID</th>
                            <th>Student Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Scholarship</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $index => $invoice)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $invoice->enrollment->enroll_id }}</td>
                                <td>{{ $invoice->enrollment->user->name }}</td>
                                <td>{{ number_format($invoice->amount, 2) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($invoice->status === 'paid') bg-success 
                                        @elseif($invoice->status === 'overdue') bg-danger 
                                        @else bg-warning @endif">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <!-- <td>{{ number_format($invoice->insurance ?? 0, 2) }}</td>
                                <td>{{ number_format($invoice->sanitation ?? 0, 2) }}</td> -->
                           
                                <td>
                                    @if($invoice->scholar)
                                        {{ $invoice->scholar->name }} - {{ number_format($invoice->scholar->amount, 2) }}
                                    @else
                                        Custom Scholarship / None
                                    @endif
                                </td>
                                <td>{{ number_format($invoice->balance ?? 0, 2) }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $invoice->invoice_id }}">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $invoice->invoice_id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <a href="{{ route('payments.index', ['invoice_id' => $invoice->invoice_id]) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-paypal"></i> Payment
                                    </a>
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#historyModal{{ $invoice->invoice_id }}">
                                        <i class="fa fa-history"></i> History
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">No invoices found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- === CREATE INVOICE MODAL === --}}
        <div class="modal fade" id="invoiceCreateModal" tabindex="-1" aria-labelledby="invoiceCreateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-3 shadow-lg">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="invoiceCreateModalLabel">
                            <i class="fa fa-file-invoice-dollar"></i> Add New Invoice
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
                        @csrf
                        <div class="modal-body">
                            {{-- Enrollment Dropdown --}}
                            <div class="mb-3">
                                <label for="enroll_id" class="form-label"><strong>Enrollment:</strong></label>
                                <select name="enroll_id" id="enroll_id" class="form-select">
                                    <option value="">-- Select Student --</option>
                                    @foreach($enrollments as $enroll)
                                        <option value="{{ $enroll->enroll_id }}">
                                            {{ $enroll->enroll_id }} - {{ $enroll->user->name ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label"><strong>Amount:</strong></label>
                                <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Status:</strong></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="unpaid">Unpaid</option>
                                    <option value="paid">Paid</option>
                                    <option value="partial">Partial</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="insurance" class="form-label"><strong>Insurance:</strong></label>
                                <input type="number" step="0.01" min="0" name="insurance" id="insurance" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="sanitation" class="form-label"><strong>Sanitation:</strong></label>
                                <input type="number" step="0.01" min="0" name="sanitation" id="sanitation" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="scholarship_id" class="form-label"><strong>Scholarship:</strong></label>
                                <select name="scholarship_id" id="scholarship_id" class="form-select">
                                    <option value="">-- Select Scholarship --</option>
                                    @foreach($scholarships as $scholarship)
                                        <option value="{{ $scholarship->scholar_id }}">
                                            {{ $scholarship->name }} — ₱{{ number_format($scholarship->amount, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="balance" class="form-label"><strong>Balance:</strong></label>
                                <input type="number" step="0.01" min="0" name="balance" id="balance" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="modal-footer d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Submit
                            </button>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- === VIEW / EDIT / HISTORY MODALS === --}}
        @foreach($invoices as $invoice)
            {{-- View Modal --}}
            <div class="modal fade" id="viewModal{{ $invoice->invoice_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title"><i class="fa fa-file-invoice"></i> Invoice Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3"><label>ID:</label> <input class="form-control" value="{{ $invoice->invoice_id }}" readonly></div>
                            <div class="mb-3"><label>Student:</label> <input class="form-control" value="{{ $invoice->enrollment->user->id ?? 'N/A' }} - {{ $invoice->enrollment->user->name ?? 'N/A' }} - {{ $invoice->enrollment->subject->descriptive_title ?? 'N/A' }}" readonly></div>
                            <div class="mb-3"><label>Amount:</label> <input class="form-control" value="₱{{ number_format($invoice->amount, 2) }}" readonly></div>
                            <div class="mb-3"><label>Status:</label> <input class="form-control" value="{{ ucfirst($invoice->status) }}" readonly></div>
                            <div class="mb-3"><label>Insurance:</label> <input class="form-control" value="₱{{ number_format($invoice->insurance ?? 0, 2) }}" readonly></div>
                            <div class="mb-3"><label>Sanitation:</label> <input class="form-control" value="₱{{ number_format($invoice->sanitation ?? 0, 2) }}" readonly></div>
                            <div class="mb-3"><label><strong>Scholarship:</strong></label><input class="form-control" value="{{ $invoice->scholar ? $invoice->scholar->name . ' - ₱' . number_format($invoice->scholar->amount, 2) : 'Custom Scholarship / None' }}" readonly></div>
                            <div class="mb-3"><label>Balance:</label> <input class="form-control" value="₱{{ number_format($invoice->balance ?? 0, 2) }}" readonly></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editModal{{ $invoice->invoice_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Invoice #{{ $invoice->invoice_id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('invoices.update', $invoice->invoice_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Amount:</label>
                                    <input type="number" step="0.01" min="0" name="amount" id="amount{{ $invoice->invoice_id }}" value="{{ old('amount', $invoice->amount) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Status:</label>
                                    <input type="text" id="status{{ $invoice->invoice_id }}" value="{{ ucfirst($invoice->status) }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Insurance:</label>
                                    <input type="number" step="0.01" min="0" name="insurance" id="insurance{{ $invoice->invoice_id }}" value="{{ old('insurance', $invoice->insurance) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Sanitation:</label>
                                    <input type="number" step="0.01" min="0" name="sanitation" id="sanitation{{ $invoice->invoice_id }}" value="{{ old('sanitation', $invoice->sanitation) }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="scholar_id{{ $invoice->invoice_id }}"><strong>Scholarship Name:</strong></label>
                                    <select name="scholar_id" id="scholar_id{{ $invoice->invoice_id }}" class="form-select">
                                        <option value="">-- Select Scholarship --</option>
                                        @foreach($scholarships as $scholarship)
                                            <option value="{{ $scholarship->scholar_id }}"
                                                {{ old('scholar_id', $invoice->scholar_id) == $scholarship->scholar_id ? 'selected' : '' }}>
                                                {{ $scholarship->name }} — ₱{{ number_format($scholarship->amount, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Balance:</label>
                                    <input type="number" step="0.01" name="balance" id="balance{{ $invoice->invoice_id }}" value="{{ $invoice->balance }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="modal-footer d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update</button>
                                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- History Modal --}}
            <div class="modal fade" id="historyModal{{ $invoice->invoice_id }}" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment History for Invoice #{{ $invoice->invoice_id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @forelse($invoice->payments as $payment)
                                <div class="card mb-3">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p><strong>Payment ID:</strong> {{ $payment->payment_id }}</p>
                                            <p><strong>Amount Paid:</strong> ₱{{ number_format($payment->total_amount, 2) }}</p>
                                            <p><strong>Payment Method:</strong> {{ ucfirst($payment->paymenttype) }}</p>
                                            <p><strong>Date:</strong> {{ $payment->date }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ route('payments.print', $payment->payment_id) }}" target="_blank" class="btn btn-secondary btn-sm">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">No payment history found.</p>
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- === BALANCE CALCULATION SCRIPT === --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // CREATE MODAL BALANCE
            function calculateBalance() {
                let amount = parseFloat(document.getElementById('amount').value) || 0;
                let insurance = parseFloat(document.getElementById('insurance').value) || 0;
                let sanitation = parseFloat(document.getElementById('sanitation').value) || 0;
                let scholarshipSelect = document.getElementById('scholarship_id');
                let scholarAmount = 0;

                if (scholarshipSelect && scholarshipSelect.selectedIndex > 0) {
                    let text = scholarshipSelect.options[scholarshipSelect.selectedIndex].text;
                    let match = text.match(/₱([\d,\.]+)/);
                    if (match) scholarAmount = parseFloat(match[1].replace(/,/g, '')) || 0;
                }

                document.getElementById('balance').value = ((amount + insurance + sanitation) - scholarAmount).toFixed(2);
            }
            ['amount','insurance','sanitation','scholarship_id'].forEach(id => {
                let el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', calculateBalance);
                    el.addEventListener('change', calculateBalance);
                }
            });

            // EDIT MODALS BALANCE
            @foreach($invoices as $invoice)
            function calcBalance{{ $invoice->invoice_id }}() {
                let amount = parseFloat(document.getElementById('amount{{ $invoice->invoice_id }}').value) || 0;
                let insurance = parseFloat(document.getElementById('insurance{{ $invoice->invoice_id }}').value) || 0;
                let sanitation = parseFloat(document.getElementById('sanitation{{ $invoice->invoice_id }}').value) || 0;
                let scholarSelect = document.getElementById('scholar_id{{ $invoice->invoice_id }}');
                let scholarAmount = 0;

                if (scholarSelect && scholarSelect.selectedIndex > 0) {
                    let text = scholarSelect.options[scholarSelect.selectedIndex].text;
                    let match = text.match(/₱([\d,\.]+)/);
                    if (match) scholarAmount = parseFloat(match[1].replace(/,/g, '')) || 0;
                }

                let balance = (amount + insurance + sanitation) - scholarAmount;
                document.getElementById('balance{{ $invoice->invoice_id }}').value = balance.toFixed(2);

                // Auto-update status
                let statusField = document.getElementById('status{{ $invoice->invoice_id }}');
                let total = amount + insurance + sanitation;
                if (balance <= 0) statusField.value = 'Paid';
                else if (balance < total) statusField.value = 'Partial';
                else statusField.value = 'Unpaid';
            }

            ['amount{{ $invoice->invoice_id }}','insurance{{ $invoice->invoice_id }}','sanitation{{ $invoice->invoice_id }}','scholar_id{{ $invoice->invoice_id }}']
                .forEach(id => {
                    let el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', calcBalance{{ $invoice->invoice_id }});
                        el.addEventListener('change', calcBalance{{ $invoice->invoice_id }});
                    }
                });
            @endforeach
        });
    </script>
</x-app-layout>
