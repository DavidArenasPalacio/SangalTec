<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Yajra\Datatables\Datatables; 
class RolController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view("rol.index");
    }

     

    public function listar(){
        $rol = Rol::select("rol.*")->get();

        //return response()->json($categoria);
        return DataTables::of($rol)
        ->addColumn('acciones', function($rol) {
            return '<a href="/rol/editar/'.$rol->idRol.'" class="btn btn-success btn-sm"><i class="fas fa-edit""></i></a>';
        })
        ->rawColumns(['acciones'])
        ->make(true);
    }

    public function save(Request $request){
        $request->validate(Rol::$rules);
        $input = $request->all(); 

        try {

            Rol::create([
                "nombre"=> $input["nombre"],
            ]);

            alert()->success('Rol creado Exitosamente');
            return redirect("/rol");

        } catch (\exception $e) {
            alert()->warning('Error', 'Error al crear Rol');
            return redirect("/rol");
        }
    }
    

    public function edit($id){
        $rol = Rol::select("rol.*")->where("rol.idRol", $id)->get();

        if ($rol == null) {
            
            return redirect("/rol");
        }
        return view("rol.edit", compact("rol"));
       
    }

    public function update(Request $request)
    {

        $request->validate(Rol::$rules);

        $input = $request->all();

        

        try {
            $rol = Rol::where("rol.idRol", "=", $input["idRol"]);

           
/*             return response()->json($categoria); */
            if ($rol == null) {
                
                return redirect("/rol")->with('error', 'Error al modificar rol');
            }

            $rol->update([
                "nombre" => $input["nombre"],
            ]);

          
            alert()->success('Rol modificado Exitosamente');
            return redirect("/rol");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al modificar rol');;
            return redirect("/rol");
        }
    }




}
