<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cashiers List</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
            margin: 10px;
            line-height: 1.3;
        }

        h3 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            color: #0d6efd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 4px 6px;
            font-size: 9px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #fefefe;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <h3>Cashiers List</h3>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Cashier Code</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Shift</th>
                <th>Status</th>
                <th>Date Hired</th>
                <th>Float Amount</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cashiers as $cashier)
            <tr>
                <td>{{ $cashier->employee_id }}</td>
                <td>{{ $cashier->cashier_code }}</td>
                <td>{{ $cashier->full_name }}</td>
                <td>{{ $cashier->email }}</td>
                <td>{{ $cashier->phone }}</td>
                <td>{{ ucfirst($cashier->shift) ?? '-' }}</td>
                <td>{{ ucfirst($cashier->status) }}</td>
                <td>{{ $cashier->date_hired?->format('Y-m-d') ?? '-' }}</td>
                <td>{{ number_format($cashier->float_amount, 2) }}</td>
                <td>{{ $cashier->notes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
