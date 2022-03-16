<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view("proveedor.index");
    }


    public function listar()
    {
        $proveedor = Proveedor::all();

        return DataTables::of($proveedor)
            ->editColumn('estado', function ($proveedor) {
                return $proveedor->estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
            })
            ->addColumn('acciones', function ($proveedor) {
                $estado = '';

                if ($proveedor->estado == 1) {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->idProveedor . '/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                } else {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->idProveedor . '/1" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                }
                return '<a href="/proveedor/editar/'.$proveedor->idProveedor.'" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.'<a href="/proveedor/detalle/' . $proveedor->idProveedor . '" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }




    public function save(Request $request)
    {
        $input =  $request->all();

     

        try {

            Proveedor::create([
                "nombre" => $input["nombre"],
                "correo" => $input["correo"],
                "telefono" => $input["telefono"],
                "direccion" => $input["direccion"],
                "estado" => 1
            ]);


            alert()->success('Proveedor creado Exitosamente');
            return redirect("/proveedor");
        } catch (\Exception $e) {
            alert()->warning('error', 'Error al crear proveedor');
            return redirect("/proveedor");
        }
    }



    public function edit($id)
    {
        $proveedor = Proveedor::select("proveedor.*")->where("proveedor.idProveedor", "=", $id)->get();

        if ($proveedor == null) {
            return redirect("/proveedor");
        }

        return  view("proveedor.edit", compact("proveedor"));
    }


    public function update(Request $request)
    {
        $input = $request->all();

        try {

            $proveedor = Proveedor::where("proveedor.idProveedor", $input["idProveedor"]);

            if ($proveedor == null) {
                return redirect("/proveedor");
            }

            $proveedor->update([
                "nombre" => $input["nombre"],
                "telefono" => $input["telefono"],
                "correo" => $input["correo"],
            ]);

            alert()->success('Proveedor modificado exitosamente');
            return redirect("/proveedor");

        } catch (\Exception $e) {
            alert()->warning('ereror', 'Erro al modificar el proveedor');
            return redirect("/proveedor");
        }
    }

    public function updateState($id, $estado)
    {
        

        $proveedor = Proveedor::where("proveedor.idProveedor", "=", $id);

        if ($proveedor == null) {
          
            return redirect("/proveedor");
        }


        try {
            // example:


            $proveedor->update(["estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/proveedor")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar estado');
            return redirect("/proveedor")->with('error', 'Error al modifcar estado');
        }
    }

}
