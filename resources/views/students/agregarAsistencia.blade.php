@extends('students.layouts')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Asistencia</title>
</head>
<body>
@if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-error" role="alert">
                {{ $message }}
            </div>
        @endif
        
    <h1>  Asistencias de {{ $student->nombre }}</h1>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
        </tr>
        <tr>
            <td>{{$student->nombre}}</td>
            <td>{{$student->apellido}}</td>
            <td>{{$student->dni}}</td>
        </tr>
    </table>
    <form action="{{route('students.asistencia', $student->id)}}" method="post">
    @csrf
        <input type="hidden" name="dni" value="{{$student->dni}}">
        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-bar-up"></i> Agregar Asistencia </button>
    </form>
</body>
</html>