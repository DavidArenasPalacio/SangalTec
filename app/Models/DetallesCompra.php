<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCompra extends Model
{
    protected $table = 'DetallesCompra'; 
    
    protected $fillable = ['idCompra', 'idProducto', 'idProveedor', 'cantidad', 'precioCompra']; 


    public $timestamps = false;
}
