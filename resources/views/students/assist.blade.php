@extends('students.layouts')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<h2>Asistencias de {{ $student->nombre }}</h2>
@if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
@if ($assists->count() > 0)
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id del estudiante</th>
                <th>Fecha Asistencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assists as $assist)
                <tr>
                    <th scope="row">{{ $assist->students_id }}</th>
                    <td>{{date_Format($assist->created_at,"d-m-Y // h:i ") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay asistencias registradas para este estudiante.</p>
@endif

</body>
</html>
@endsection