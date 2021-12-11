<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'Compras'; 
    
    protected $fillable = ['idEmpleado']; 
    
    public $timestamps = false;
}
