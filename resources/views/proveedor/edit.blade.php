@extends('layouts.app')


@section('content')
<section class="container">
    <div class="p-5 bg-white">
        <h2 class="text-center">Modificar Proveedor</h2>
        <form action="/proveedor/actualizar" method="post">
            @csrf
            <input type="hidden" name="idProveedor" value="{{$proveedor[0]["idProveedor"]}}">
            <div class="mb-3">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$proveedor[0]["nombre"]}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class=" mb-3">
                <label for="">Correo: </label>
                <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{$proveedor[0]["correo"]}}">
                @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Teléfono: </label>
                <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{$proveedor[0]["telefono"]}}">
                @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Dirección: </label>
                <input type="tel" name="text" class="form-control @error('direccion') is-invalid @enderror" value="{{$proveedor[0]["direccion"]}}">
                @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="/proveedor" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Modificar proveedor</button>

            </div>
        </form>
    </div>
</section>
@endsection