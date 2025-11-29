<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Patients List</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        h3 { margin: 0 0 10px 0; }
    </style>
</head>
<body>
<h3>Patients Report</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>DOB</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->first_name }} {{ $p->last_name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->phone }}</td>
                <td>{{ ucfirst($p->gender) }}</td>
                <td>{{ $p->dob }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
