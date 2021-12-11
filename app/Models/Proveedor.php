<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'Proveedor'; 
    
    protected $fillable = ['nombre', 'telefono', 'correo', 'estado']; 
    
    public $timestamps = false;
}
