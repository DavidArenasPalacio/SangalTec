@extends('layouts.app')


@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between p-2">
            <h3>Gestión Usuario</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Crear Usuario
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Crear Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <form action="/usuario/guardar" method="post" id="form">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nombre:</label>
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb3">
                                <label for="">Rol: </label>
                                <select name="rol_id" class="form-control @error('rol_id') is-invalid @enderror" id="">
                                    <option value="">------Seleccione-----</option>
                                    @foreach($roles as $value)
                                    <option value="{{ $value->id }}">{{ $value->Nombre_Rol }}</option>
                                    @endforeach
                                </select>
                                @error('rol_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Documento: </label>
                                <input type="text" name="documento" class="form-control @error('documento') is-invalid @enderror">
                                @error('documento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Teléfono: </label>
                                <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror">
                                @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Dirección: </label>
                                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror">
                                @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Email: </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Contraseña: </label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="card-body">

        <table id="tbl_usuarios" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('script')

<script>
    $('#tbl_usuarios').DataTable({
        processing: true,
        serverSide: true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: '/usuario/listar',
        columns: [{
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'rol',
                name: 'rol'
            },
            {
                data: 'documento',
                name: 'documento'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'estado',
                name: 'estado',
                orderable: false,
                serachable: false
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            }
        ]
    }
    );
    $('#btnGuardar').click((e) => {
    let form = $('#form');
        e.preventDefault();
        Swal.fire({
            title: '¿Desea Crear El Usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>
@endsection