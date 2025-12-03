<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pharmacists List</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }

        thead th {
            background-color: #4a90e2;
            color: #fff;
            padding: 8px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tbody td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        th, td {
            vertical-align: middle;
        }

        .status-active {
            color: #fff;
            background-color: #28a745;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            text-align: center;
            display: inline-block;
        }

        .status-inactive {
            color: #fff;
            background-color: #6c757d;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            text-align: center;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h3>Pharmacists List</h3>
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th>License #</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pharmacists as $ph)
            <tr>
                <td>
                    @if($ph->profile_photo)
                        <img src="{{ public_path($ph->profile_photo) }}" alt="Photo">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $ph->first_name }}</td>
                <td>{{ $ph->last_name }}</td>
                <td>{{ $ph->email }}</td>
                <td>{{ $ph->phone ?? '—' }}</td>
                <td>{{ ucfirst($ph->gender ?? '—') }}</td>
                <td>{{ $ph->date_of_birth?->format('Y-m-d') ?? '—' }}</td>
                <td>{{ $ph->address ?? '—' }}</td>
                <td>{{ $ph->license_number ?? '—' }}</td>
                <td>
                    @if($ph->status)
                        <span class="status-active">Active</span>
                    @else
                        <span class="status-inactive">Inactive</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
