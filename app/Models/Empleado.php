<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado'; 

    protected $fillable = ['nombre', 'telefono', 'documento']; 

    public $timestamps = false;
}
