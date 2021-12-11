<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\DetallesCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetallesCompraController extends Controller
{
    public function index(){
        $proveedor = Proveedor::all(); 
        return view("detalleCompra.index", compact("proveedor"));
    }


    public function save(Request $request) {
        
        $input = $request->all(); 
         

        try {
            DB::beginTransaction();
            $producto = Producto::create([
                "nombre"=>$input["nombre"],
                "cantidad"=>$input["cantidad"],
                "idProveedor"=>$input["idProveedor"],
                "precio"=>$this->calcularPrecio($input["insumo_id"], $input["cantidades"]),
            ]);

            foreach($input["insumo_id"] as $key => $value){
                DetallesCompra::create([
                    "idCompra"=>$value,
                    "producto_id"=>$producto->id,
                    "cantidad"=>$input["cantidades"][$key]
                ]);
                $ins = Insumo::find($value);
                $ins->update(["cantidad" => $ins->cantidad - $input["cantidades"][$key]]);
            }

            DB::commit();
            return redirect("/producto/listar")->with('status', '1');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect("/producto/listar")->with('status', $e->getMessage());
        }

       
    } 

}
