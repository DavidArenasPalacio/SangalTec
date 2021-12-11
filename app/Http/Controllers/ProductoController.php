<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Validation\ValidationException ;
Use Alert;
use DataTables;
class ProductoController extends Controller
{
    // 
    public function index(){
        $productos = Producto::select("producto.*", "categoria.nombre as categoria")
        ->join("categoria", "categoria.idCategoria", "=", "producto.categoria_id")
        ->get();
        $categorias = Categoria::all();
        return view("producto.index", compact("productos","categorias"));
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
         

            return redirect("/producto")->with('status', '1');
        } catch (\Exception $e) {
            
         


            return redirect("/producto")->with('status', $e->getMessage());;
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

       // $request->validate(Producto::$rules);

        $input = $request->all();

        try {
            $producto = Producto::where("producto.idProducto", "=", $input["idProducto"]);

            

            if ($producto == null) {
                
                return redirect("/producto")->with('error', 'Error no se a podido crear el producto');
            }

            $producto->update([
                "categoria_id" => $input["categoria_id"],
                "nombre" => $input["nombre"],
                "cantidad" => $input["cantidad"],
                "precio" => $input["precio"]
            ]);

          

            return redirect("/producto");
        } catch (\Exception $e) {
           ;

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
        
            return redirect("/producto");
        } catch (\Exception $e) {
          

            return redirect("/producto");
        }
    }
}
 