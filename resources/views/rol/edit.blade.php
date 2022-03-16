@extends('layouts.app')


@section('content')
<section class="container">
<div class="p-5 bg-white">
    <h2 class="text-center">Modificar Rol</h2>
<form action="/rol/actualizar" method="post">
    @csrf
    <input type="hidden" name="idRol" value="{{$rol[0]["idRol"]}}">
    <div class="mb-3">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$rol[0]["nombre"]}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
    <a href="/rol" class="btn btn-primary">Cancelar</a>
    <button type="submit" class="btn btn-success">Modificar rol</button>
   
    </div>
</form>
</div>
</section>
@endsection