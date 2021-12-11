<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriaController extends Controller
{
    public function index(){
        return view("categoria.index");
    }


    public function create(){
        return view("categoria.create");
    }


    public function save(Request $request){
        $input = $request->all(); 

        try {

            Categoria::create([
                "nombre"=> $input["nombre"],
                "estado"=>1
            ]);

            return redirect("/categoria");

        } catch (\exception $e) {
            return redirect("/categoria/crear");
        }
    }
    

    public function edit($id){
        $categoria = Categoria::find($id);

        if ($categoria == null) {
            
            return redirect("/categoria");
        }

       
    }
}
