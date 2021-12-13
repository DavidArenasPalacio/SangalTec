<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table  = 'compra';

    protected $fillable = ['idEmpleado', 'idProveedor', 'total','estado'];

    public $timestamps = false;
} 
