<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - {{ $invoice->invoice_no }}</title>
    <style>
        /* Global */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #f0f0f0;
            border-radius: 10px;
        }

        h1, h2, h3, h4 {
            margin: 0;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #4CAF50;
        }

        /* Info Sections */
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info div {
            width: 48%;
        }

        .info strong {
            display: inline-block;
            width: 120px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .notes {
            font-style: italic;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Clinic Receipt</h2>
            <p>Invoice #: <strong>{{ $invoice->invoice_no }}</strong></p>
            <p>Date: {{ $invoice->paid_at?->format('F j, Y, h:i A') }}</p>
        </div>
        <div class="info">
            <div>
                <h4>Cashier Details</h4>
                <p><strong>Name:</strong> {{ $invoice->cashier?->full_name ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="info">
            <div>
                <p><strong>Payment Method:</strong> {{ ucfirst($invoice->payment_method) }}</p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Consultation / Services</td>
                    <td>{{ number_format($invoice->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            Total Paid: {{ number_format($invoice->total_amount, 2) }}
        </div>
        <div class="total">
            Amount Paid: {{ number_format($invoice->amount, 2) }}
        </div>
        <div class="footer">
            Thank you for your payment!<br>
            Powered by Clinic ERP System
        </div>
    </div>
</body>
</html>
