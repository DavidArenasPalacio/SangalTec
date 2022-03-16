<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor'; 
    
    protected $fillable = ['nombre', 'correo', 'telefono', 'direccion', 'estado'];
    
    public $timestamps = false;
}
