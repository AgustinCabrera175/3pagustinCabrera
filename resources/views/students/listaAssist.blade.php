@extends('students.layouts')

@section('content')
<x-app-layout>
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
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)  
                       
                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <td>{{ $student->nombre }}</td>
                            <td>{{ $student->apellido }}</td>
                            <td>{{ $student->dni }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->fechaNacimiento)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::createFromDate($student->fechaNacimiento)->age }}</td>
                            <td>{{ $student->curso }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <a href="{{ route('students.assistsView', $student->id) }}" class="btn btn-success btn-sm"><i class="bi bi-person"></i> Info</a>

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                                
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No Student Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>





</x-app-layout>
    
@endsection