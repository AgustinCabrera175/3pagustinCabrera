@extends('students.layouts')

@section('content')
<x-app-layout>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
   
    @if ($message = Session::get('cumple'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        
        @if ($error = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        @endif
        
        <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Student List</span>
            <div>
                <a href="{{route('students.pdf')}}" class="btn btn-info btn-sm"><i class="bi bi-filetype-pdf"></i> Crear un PDF</a>
                <a href="{{route('students.excel')}}" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Crear un Excel</a>
            </div>
        </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Añadir Nuevo Estudiante</a>
                        <a href="{{ route('students.cumple') }}" class="btn btn-primary btn-sm my-2"><i class="bi bi-calendar-plus"></i> Ver Cumpleaños Hoy</a>
                    </div>
                    
                    <form action="{{ route('students.agregarAsistencia')}}" method="post">
                        @csrf
                        <input type="number" name="dni" class="form-control-sm">
                        <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-search"></i> Añadir nueva Asistencia</button>
                    </form>
                </div>    
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Edad </th>
                            <th scope="col">Curso </th>
                            <th scope="col">Condicion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($studentsCondition as $studentsConditions)  
                       
                        <tr>
                            <th scope="row">{{ $studentsConditions['student']->id }}</th>
                            <td>{{ $studentsConditions['student']->nombre }}</td>
                            <td>{{ $studentsConditions['student']->apellido }}</td>
                            <td>{{ $studentsConditions['student']->dni }}</td>
                            <td>{{ \Carbon\Carbon::parse($studentsConditions['student']->fechaNacimiento)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::createFromDate($studentsConditions['student']->fechaNacimiento)->age }}</td>
                            <td>{{ $studentsConditions['student']->curso }}</td>
                            <td class="{{ $studentsConditions['colorCondition'] }}">{{ $studentsConditions['condition'] }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $studentsConditions['student']->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('students.show', $studentsConditions['student']->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="{{ route('students.edit', $studentsConditions['student']->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <a href="{{ route('students.assistsView', $studentsConditions['student']->id) }}" class="btn btn-success btn-sm"><i class="bi bi-person"></i> Info</a>

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                                <form action="{{route('students.asistencia', $studentsConditions['student']->id)}}" method="post" class="mt-1">
                                    @csrf
                                    <input type="hidden" name="dni" value="{{$studentsConditions['student']->dni}}">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-up"></i> </button>
                                </form>
                                @if ($studentsConditions['student']->assists->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->count() > 0)
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="9">
                                <span class="text-danger">
                                    <strong>No Student Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  

            </div>
        </div>
    </div>    
</div>
</x-app-layout>
    
@endsection
