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

    public $primaryKey  = 'idProducto';

    public $timestamps = false;
}
