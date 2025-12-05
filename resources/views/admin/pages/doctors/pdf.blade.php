<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Doctors List</title>
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
            table-layout: fixed
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
    <h3>Doctors List</h3>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>License No</th>
                <th>PTR No</th>
                <th>S2 No</th>
                <th>Specialization</th>
                <th>Sub Specialization</th>
                <th>Department</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->first_name }}</td>
                <td>{{ $doctor->last_name }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->gender }}</td>
                <td>{{ $doctor->birthdate }}</td>
                <td>{{ $doctor->license_no }}</td>
                <td>{{ $doctor->ptr_no }}</td>
                <td>{{ $doctor->s2_no }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->sub_specialization }}</td>
                <td>{{ $doctor->department }}</td>
                <td>{{ $doctor->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
