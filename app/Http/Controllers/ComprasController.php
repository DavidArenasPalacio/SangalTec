<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\DetallesCompra;
use App\Models\Compra;
use App\Models\ControlExistencia;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proveedor = Proveedor::all();
        $productos = Producto::all();

        return view("compra.index", compact("proveedor", "productos"));
    }


    public function listar()
    {
        $compra = Compra::select("compra.*", "users.name as users", "proveedor.nombre as proveedor")->join("users", "users.id", "=", "compra.usuario_id")->join("proveedor", "proveedor.idProveedor", "=", "compra.proveedor_id")->get();


        return DataTables::of($compra)
            ->editColumn('estado', function ($compra) {
                return $compra->estado == 1 ? '<span class="bg-primary p-1 rounded">Anular</span>' : '<span class="bg-danger p-1 rounded">Anulado</span>';
            })
            ->addColumn('acciones', function ($compra) {
                $estado = '';

                if ($compra->estado == 1) {
                    $estado = '<a href="/compra/cambiar/estado/' . $compra->idCompra . '/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                } else {
                    $estado = '<a  class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
                }

                return '<a href="/compra/detalle/' . $compra->idCompra . '" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }


    public function detalle($id)
    {
        $detal = DetallesCompra::select("detalleCompra.*", "producto.nombre as producto")
            ->join("producto", "producto.idProducto", "=", "detalleCompra.producto_id")
            ->where("detalleCompra.compra_id", $id)->get();

        return view("compra.detalle", compact("detal"));
    }

    public function save(Request $requet)
    {
        $input = $requet->all();

      
        try {
            DB::beginTransaction();

             

           $compra = Compra::create([
                "usuario_id" => auth()->user()->id,
                "proveedor_id" => $input['proveedor_id'],
                "precioCompra" =>  $input["total"],
                "estado" => 1
            ]); 






            foreach ($input["nombreProducto"] as $key => $value) {


                $producto = Producto::where("producto.nombre", "=", $value)->first();



/*                 $productoUpdate->update(["cantidad" => $productoUpdate["cantidad"] + $input["cantidad"][$key]]);
 */
                /* $producto = Producto::create([
                    "categoria_id" => $input["categoria_id"][$key],
                    "nombre" => $value,
                    "precio" => $input["precio"][$key],
                    "cantidad" => $input["cantidad"][$key],
                    "estado" => 1
                ]);  */

                
              /*   $controlExistencia = ControlExistencia::select("controlexistencia.*","producto.idProducto as producto")
                ->join("producto", "producto.idProducto", "=", "controlexistencia.producto_id")
                ->where( "controlexistencia.producto_id", $producto ["idProducto"])
                ->first();
                    
                if($controlExistencia != null){
                    $controlExistencia->update(["cantidad" => $controlExistencia["cantidad"] + 10]);
                }
                else {
                   
                } */
                ControlExistencia::create([
                    "producto_id" =>  $producto ["idProducto"],
                    "cantidad" => $input["cantidad"][$key]
                ]);
               

                DetallesCompra::create([
                    "producto_id" => $producto ["idProducto"],
                    "compra_id" => $compra->id,
                    "cantidad" => $input["cantidad"][$key]
                ]);

        
            }

            DB::commit();
            alert()->success('Compra creado Exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->warning('Error', 'Error al crear compra');
            return $e;
        }
    }



    public function updateState($id, $estado)
    {
        $compra = Compra::where("compra.idCompra", "=", $id);

        if ($compra == null) {
            return redirect("/compra");
        }


        try {

            if ($estado == 0) {
                $detal = DetallesCompra::select("detalleCompra.*", "producto.idProducto as producto")
                    ->join("producto", "producto.idProducto", "=", "detalleCompra.producto_id")
                    ->where("detalleCompra.compra_id", $id)->get();

                /* foreach ($detal as $value) {
                    $producto = Producto::find($value->producto);

   

                    $producto->update(["cantidad" => $producto->cantidad - $value->cantidad]);
                } */
            }



            $compra->update(["estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al modificar estado');
            return redirect("/compra");
        }
    }
}
