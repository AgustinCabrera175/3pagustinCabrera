@extends('students.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Student Information
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $student->nombre }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-end text-start"><strong>Apellido:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $student->apellido }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="dni" class="col-md-4 col-form-label text-md-end text-start"><strong>DNI:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $student->dni }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-end text-start"><strong>Fecha de Nacimiento:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $student->fechaNacimiento }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="grupo" class="col-md-4 col-form-label text-md-end text-start"><strong>Curso:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $student->curso }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection