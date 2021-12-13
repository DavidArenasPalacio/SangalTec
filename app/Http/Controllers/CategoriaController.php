<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Yajra\Datatables\Datatables; 
class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view("categoria.index");
    }

     

    public function listar(){
        $categoria = Categoria::select("categoria.*")->get();

        //return response()->json($categoria);
        return DataTables::of($categoria)
        ->editColumn('estado', function($categoria){
            return $categoria->estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
        })
        ->addColumn('acciones', function($categoria) {
            $estado = ''; 
              
            if($categoria->estado == 1) {
                $estado = '<a href="/categoria/cambiar/estado/'.$categoria->idCategoria.'/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
            }
            else {
                $estado = '<a href="/categoria/cambiar/estado/'.$categoria->idCategoria.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
            }

            return '<a href="/categoria/editar/'.$categoria->idCategoria.'" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>'.' '.$estado;
        })
        ->rawColumns(['estado','acciones'])
        ->make(true);
    }

    public function save(Request $request){
        $request->validate(Categoria::$rules);
        $input = $request->all(); 

        try {

            Categoria::create([
                "nombre"=> $input["nombre"],
                "estado"=>1
            ]);

            return redirect("/categoria")->with('success', 'Categoría creado con exito!');

        } catch (\exception $e) {
            return redirect("/categoria")->with('erro', 'Error al crear Categoría');
        }
    }
    

    public function edit($id){
        $categoria = Categoria::select("categoria.*")->where("categoria.idCategoria", $id)->get();

        if ($categoria == null) {
            
            return redirect("/categoria");
        }
        return view("categoria.edit", compact("categoria"));
       
    }

    public function update(Request $request)
    {

        $request->validate(Categoria::$rules);

        $input = $request->all();

        

        try {
            $categoria = Categoria::where("categoria.idCategoria", "=", $input["idCategoria"]);

           
/*             return response()->json($categoria); */
            if ($categoria == null) {
                
                return redirect("/categoria")->with('error', 'Error al modificar categoría');
            }

            $categoria->update([
                "nombre" => $input["nombre"],
            ]);

          
            
            return redirect("/categoria")->with('success', 'Categoría modificado con exito!');
        } catch (\Exception $e) {
            return redirect("/categoria")->with('error', 'Error al modificar categoría');
        }
    }

    public function updateState($id, $estado)
    {
        

        $categoria = Categoria::where("categoria.idCategoria", "=", $id);
        
     
        if ($categoria == null) {
          
            return redirect("/categoria");
        }


        try {
            // example:


            $categoria->update(["estado" => $estado]);
        
            return redirect("/categoria")->with('success', 'Estado modificado con exito!');
        } catch (\Exception $e) {
          

            return redirect("/categoria")->with('error', 'Error al modifcar estado');
        }
    }
}
