<!DOCTYPE html>
<html>
<head>
    <title>Student List PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student List</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">DNI</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Edad</th>
                <th scope="col">Curso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)  
            <tr>
                <th scope="row">{{ $student->id }}</th>
                <td>{{ $student->nombre }}</td>
                <td>{{ $student->apellido }}</td>
                <td>{{ $student->dni }}</td>
                <td>{{ \Carbon\Carbon::parse($student->fechaNacimiento)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::createFromDate($student->fechaNacimiento)->age }}</td>
                <td>{{ $student->curso }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>