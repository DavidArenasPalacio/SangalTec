<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $users = Users::all();
        return view("user.index", compact("users"));
    }  


    public function listar(){
        $users = Users::select("users.*", "users.nombre as users")
        ->join("rol", "rol.idRol", "=", "rol.rol_id")
        ->get();
        return DataTables::of($users)
        ->editColumn('estado', function($users){
            return $users->estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
        })
        ->addColumn('acciones', function($users) {
            $estado = ''; 
              
            if($users->estado == 1) {
                $estado = '<a href="/users/cambiar/estado/'.$users->id.'/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
            }
            else {
                $estado = '<a href="/users/cambiar/estado/'.$users->id.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
            }
            
            return '<a href="/users/editar/'.$users->id.'" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.$estado;
        })
        ->rawColumns(['estado', 'acciones'])
        ->make(true);
    }






    public function save(Request $request)
    {
        $request->validate(Users::$rules);

        $input = $request->all();
        try {
            Users::create([   
                "rol_id" => $input["rol_id"],
                "name" => $input["name"], 
                "documento" => $input["documento"], 
                "direccion" => $input["direccion"], 
                "email" => $input["email"],    
                "estado" => 1
            ]);
            alert()->success('Producto creado Exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al crear Producto');
            return redirect("/producto")->with('error', 'Error al crear producto');;
        }
    }


    public function edit($id)
    {
        $producto = Producto::select("producto.*")->where("producto.idProducto", "=", $id)->get();
        $categorias = Categoria::all();
        /* return response()->json($producto[0]["idProducto"]); */
        if ($producto == null) {
            
            return redirect("/producto");
        }

     



        return view("producto.edit", compact("producto", "categorias"));
    }

    public function update(Request $request)
    {

       $request->validate(Producto::$rules);

        $input = $request->all();

        try {
            $producto = Producto::where("producto.idProducto", "=", $input["idProducto"]);

            

            if ($producto == null) {
                
                return redirect("/producto")->with('error', 'Error al modificar producto');
            }

            $producto->update([
                "categoria_id" => $input["categoria_id"],
                "nombre" => $input["nombre"],
                "precio" => $input["precio"]
            ]);

          
            alert()->success('Producto modificado Exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar Producto');
            return redirect("/producto");
        }
    }

    public function updateState($id, $estado)
    {
        

        $producto = Producto::where("producto.idProducto", "=", $id);

        if ($producto == null) {
          
            return redirect("/producto");
        }


        try {
            // example:


            $producto->update(["estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/producto")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar estado');
            return redirect("/producto")->with('error', 'Error al modifcar estado');
        }
    }
}
