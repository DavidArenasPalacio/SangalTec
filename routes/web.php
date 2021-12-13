<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComprasController;
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


Route::get('/categoria', [CategoriaController::class, 'index']);
Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
Route::post('/categoria/guardar', [CategoriaController::class, 'save']);
Route::get('/categoria/editar/{id}', [CategoriaController::class, 'edit']);
Route::post('/categoria/actualizar', [CategoriaController::class, 'update']);
Route::get('/categoria/cambiar/estado/{idCategoria}/{estado}', [CategoriaController::class, 'updateState']);

Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/listar', [ProductoController::class, 'listar']);
Route::post('/producto/guardar', [ProductoController::class, 'save']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
Route::post('/producto/actualizar', [ProductoController::class, 'update']);
Route::get('/producto/cambiar/estado/{idProducto}/{estado}', [ProductoController::class, 'updateState']);


Route::get('/compra', [ComprasController::class, 'index']);
Route::get('/compra/listar', [ComprasController::class, 'listar']);
Route::post('/compra/guardar', [ComprasController::class, 'save']);
Route::get('/compra/detalle/{id}', [ComprasController::class, 'detalle']);
Route::get('/compra/cambiar/estado/{idCompra}/{estado}', [ComprasController::class, 'updateState']);


