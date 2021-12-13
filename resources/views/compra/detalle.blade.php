@extends('layouts.app')


@section('content')

<section class="cotainer">
    <div class="p-3 m-auto bg-white">
        <h2>Productos:</h2>
        @foreach($detal as  $value)
        <p><strong>Nombre Producto: </strong>{{$value->producto}}</p>
        <p><strong>Nombre Cantidad: </strong>{{$value->cantidad}}</p>

        @endforeach
        <a href="/compra" class="btn btn-success">Volver</a>
    </div>
</section>

@endsection