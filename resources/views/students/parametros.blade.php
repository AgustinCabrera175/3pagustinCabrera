@extends('students.layouts')

@section('content')
<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Parametros de las asistencias</title>
</head>
<body>
@if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    @forelse ($parametros as $parametro)
<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Editar Parametros
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">    
                <form action="{{ route('parametros.editar', $parametro->id) }}" method="post">
                @csrf
                @method("PUT")
                    <div class="mb-3 row">
                        <label for="parametros" class="col-md-4 col-form-label text-md-end text-start">Total de clases</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('parametros') is-invalid @enderror" id="parametros" name="parametros" value="{{ $parametro->parametros }}">
                            @if ($errors->has('parametros'))
                            <span class="text-danger">{{ $errors->first('parametros') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="porcentajeRegular" class="col-md-4 col-form-label text-md-end text-start">Porcentaje Regular</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('porcentajeRegular') is-invalid @enderror" id="porcentajeRegular" name="porcentajeRegular" value="{{ $parametro->porcentajeRegular }}">
                            @if ($errors->has('porcentajeRegular'))
                            <span class="text-danger">{{ $errors->first('porcentajeRegular') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="porcentajePromocion" class="col-md-4 col-form-label text-md-end text-start">Porcentaje Promocion</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('porcentajePromocion') is-invalid @enderror" id="porcentajePromocion" name="porcentajePromocion" value="{{ $parametro->porcentajePromocion }}">
                            @if ($errors->has('porcentajePromocion'))
                            <span class="text-danger">{{ $errors->first('porcentajePromocion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>
                    </form>
            </div>
    </div>
</div>
</div>
        @empty
        <div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Agregar Parametros
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">    
                <form action="{{ route('parametros.agregar') }}" method="post">
                @csrf
                    <div class="mb-3 row">
                        <label for="parametros" class="col-md-4 col-form-label text-md-end text-start">Total de clases</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('parametros') is-invalid @enderror" min="10" max="200" id="parametros" name="parametros" value="{{ old('parametros') }}">
                            @if ($errors->has('parametros'))
                            <span class="text-danger">{{ $errors->first('parametros') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="porcentajeRegular" class="col-md-4 col-form-label text-md-end text-start">Porcentaje Regular</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('porcentajeRegular') is-invalid @enderror" id="porcentajeRegular" min="30" max="100" name="porcentajeRegular" value="{{ old('porcentajeRegular') }}">
                            @if ($errors->has('porcentajeRegular'))
                            <span class="text-danger">{{ $errors->first('porcentajeRegular') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="porcentajePromocion" class="col-md-4 col-form-label text-md-end text-start">Porcentaje Promocion</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('porcentajePromocion') is-invalid @enderror" id="porcentajePromocion" min="50" max="100" name="porcentajePromocion" value="{{ old('porcentajePromocion') }}">
                            @if ($errors->has('porcentajePromocion'))
                            <span class="text-danger">{{ $errors->first('porcentajePromocion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add">
                    </div>
                    </form>
            </div>
    </div>
</div>
</div>        
@endforelse
</body>
</html>
</x-app-layout>
@endsection