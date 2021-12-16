<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Alert;

class Producto extends Model
{
    protected $table = 'producto'; 
    
    protected $fillable = ['categoria_id', 'nombre', 'cantidad', 'precio', 'estado']; 
    
    public static $rules = [ 
        'categoria_id' =>  'required|exists:categoria,idCategoria',
        'nombre'  => 'required|min:2',
        'cantidad' => 'numeric|min:0',
        'precio' => 'required',
        'estado' => 'in:1,0'
    ];

<<<<<<< HEAD
    protected $primaryKey = 'idProducto';
=======
    public $primaryKey  = 'idProducto';
>>>>>>> 1563701f5c86341491b4fb7c17c921b0525b1894

    public $timestamps = false;
}
