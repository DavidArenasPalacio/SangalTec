<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Validation\ValidationException ;
Use Alert;
use Yajra\Datatables\Datatables; 
class ProductoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $categorias = Categoria::where("categoria.estado", 1)->get();
        return view("producto.index", compact("categorias"));
    }  


    public function listar(){
        $productos = Producto::select("producto.*", "categoria.nombre as categoria")
        ->join("categoria", "categoria.idCategoria", "=", "producto.categoria_id")
        ->where("categoria.estado", 1)
        ->get();
        return DataTables::of($productos)
        ->editColumn('estado', function($producto){
            return $producto->estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
        })
        ->addColumn('acciones', function($producto) {
            $estado = ''; 
              
            if($producto->estado == 1) {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->idProducto.'/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
            }
            else {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->idProducto.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
            }
            
            return '<a href="/producto/editar/'.$producto->idProducto.'" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.$estado;
        })
        ->rawColumns(['estado', 'acciones'])
        ->make(true);
    }






    public function save(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();
        try {
            Producto::create([   
                "categoria_id" => $input["categoria_id"],
                "nombre" => $input["nombre"],
                "cantidad" => $input["cantidad"],  
                "precio" => $input["precio"],    
                "estado" => 1
            ]);

            return redirect("/producto")->with('success', 'Producto creado satisfactoriamente!');
        } catch (\Exception $e) {

            return redirect("/producto")->with('error', 'Error al crear producto');;
        }
    }


    public function edit($id)
    {
        $producto = Producto::select("producto.*")->where("producto.idProducto", "=", $id)->get();
        $categorias = Categoria::where("categoria.estado", 1)->get();
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
                "cantidad" => $input["cantidad"],
                "precio" => $input["precio"]
            ]);

          

            return redirect("/producto")->with('success', 'Producto modificado satisfactoriamente!');
        } catch (\Exception $e) {
            return redirect("/producto")->with('error', 'Error al modificar producto');
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
        
            return redirect("/producto")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
          

            return redirect("/producto")->with('error', 'Error al modifcar estado');
        }
    }
}
 