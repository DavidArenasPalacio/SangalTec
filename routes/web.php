<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/producto', [ProductoController::class, 'index']);
Route::post('/producto/guardar', [ProductoController::class, 'save']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
Route::post('/producto/actualizar', [ProductoController::class, 'update']);
Route::get('/producto/cambiar/estado/{idProducto}/{estado}', [ProductoController::class, 'updateState']);