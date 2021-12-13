<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';


    protected $fillable = ['nombre', 'estado'];


    public static $rules = [ 
        'nombre' => 'required',
        'estado' => 'in:1,0'
    ];

    public $timestamps = false;
}