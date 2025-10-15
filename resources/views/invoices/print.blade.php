<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; }
        .table th { width: 30%; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="header">
        <h2>Invoice</h2>
        <p><strong>Invoice #: </strong>{{ $invoice->id }}</p>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Student</th>
            <td>{{ $invoice->enrollment->user->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Subject</th>
            <td>{{ $invoice->enrollment->subject->descriptive_title ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>₱{{ number_format($invoice->amount, 2) }}</td>
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
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($invoice->status) }}</td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td>{{ $invoice->due_date }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    <div class="text-center no-print">
        <button onclick="window.print()" class="btn btn-primary mt-3">
            <i class="fa fa-print"></i> Print
        </button>
    </div>
</div>
</body>
</html>
