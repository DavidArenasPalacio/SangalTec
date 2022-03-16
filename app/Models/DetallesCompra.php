<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCompra extends Model
{
    protected $table = 'detalleCompra'; 
    
    protected $fillable = ['compra_id', 'producto_id', 'cantidad']; 


    public $timestamps = false;
}
