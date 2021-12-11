@extends('layouts.app')


@section('content')

<div class="card">
    <div class="card-header">
        <strong>Prodcuctos</strong>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Crear Producto
        </button>
        @if (session('status'))
            @if(session('status') == '1')
                <div class="alert alert-success">
                    Se guardo
                </div>
            @else
                <div class="alert alert-danger">
                    {{session('status') }}
                </div>
            @endif
            @endif
        <!-- Modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            
                        </div>

                        <div class="d-flex justify-content-between">
                        <div class=">
                            <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
                            </div>
                            <div class="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                      
                       
                    </div>
                    <div class="modal-body">
                        <form action="/producto/guardar" method="post">
                        @csrf
                            <div class="mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb3">
                                <label for="">Categoría: </label>
                                <select name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror" id="">
                                    <option value="">------Seleccione-----</option>
                                    @foreach($categorias as $value)
                                    <option  value="{{ $value->idCategoria }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Precio: </label>
                                <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror">
                                @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Cantidad: </label>
                                <input type="number" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror">
                                @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Crear producto</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="card-body">

        <table id="tbl_productos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach($productos as $value)
                <tr>
                    <td>{{$value->nombre}}</td>
                    <td>{{$value->categoria}}</td>
                    <td>{{$value->precio}}</td>
                    <td>{{$value->cantidad}}</td>

                    @if($value->estado == 1)
                    <td>
                        <span>Activo</span>
                    </td>
                    @else
                    <td>
                        <span>Inactivo</span>
                    </td>
                    @endif

                  
                    <td>
                        @if($value->estado == 1)
                    
                        <span><a href="{{url('/producto/cambiar/estado/'.$value->idProducto.'/0')}}" class="btn  btn-danger btn-sm"> <i class="fas fa-lock"></i></a></span>
                 
                    @else
                    
                        <span><a href="{{url('/producto/cambiar/estado/'.$value->idProducto.'/1')}}" class="btn  btn-success btn-sm"> <i class="fas fa-unlock-alt"></i></a></span>
                    
                    @endif
                    

                    <span> <a href="{{url('/producto/editar/'.$value->idProducto)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> </span>
                      <!-- Button trigger modal -->
        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection



@section('script')

<script>
    $(document).ready( function () {
    $('#tbl_productos').DataTable();
} );</script>

@endsection