<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt #{{ $payment->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; }
        .receipt-box {
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
<div class="receipt-box">
    <div class="header">
        <h2>Payment Receipt</h2>
        <p><strong>Receipt #: </strong>{{ $payment->id }}</p>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Invoice</th>
            <td>#{{ $payment->invoice->id ?? 'N/A' }}</td>
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
