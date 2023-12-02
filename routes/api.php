<?php

use App\Http\Controllers\AbastecimientosController;
use App\Http\Controllers\mensajesController;
use App\Http\Controllers\pqrsController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\rolsController;
use App\Http\Controllers\usersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [usersController::class, 'index']);
    Route::get('/logout', [usersController::class,'logout']);
    Route::post('/users_update/{id}', [usersController::class, 'update']);
   /*  route::get('catalogo',ProductController::class,'catalogo')->name('catalogo.index'); */
});
/* Route::get('get_datauser' , usersController::class, 'dataUser');

Route::get('/create', usersController::class, 'create');

Route::get('get_dataproduc' , productosController::class, 'dataproduc'); */


 //productos
Route::get('/productos', [productosController::class,'index']);
 Route::get('/productos_create', [productosController::class, 'create']);

 Route::post('/productos_store', [productosController::class, 'store']);

 Route::get('productos/{producto}', [productosController::class, 'show']);
 
 //editar
 Route::get('/productos_edit/{id}', [productosController::class, 'edit']);
 Route::post('/productos_update/{producto}', [productosController::class, 'update']);
 //eliminar
 Route::delete('/productos_destroy/{producto}', [productosController::class, 'destroy'])->name('productos.destroy');


 //users
 Route::get('/users', [usersController::class, 'index']);
 Route::get('/users/create', [usersController::class, 'create']);
 Route::post('/users/store', [usersController::class, 'store']);

 
 //editar 
 Route::get('/users/edit/{id}', [usersController::class, 'edit']);

 


//eliminar
Route::delete('/users/destroy/{user}', [usersController::class, 'destroy']);

Route::post('/register', [usersController::class,'register']);
Route::post('/logins', [usersController::class,'logins']);


/* Route::middleware('auth:sanctum')->group(function(){
    Route::get('logout', usersController::class,'logout')->name('logout');
   // route::get('catalogo',ProductController::class,'catalogo')->name('catalogo.index'); 
}); */

// abastecimiento
Route::get('/abastecimientos', [AbastecimientosController::class, 'index']);

Route::get('/abastecimientos/create',[AbastecimientosController::class, 'create']);
Route::post('/abastecimientos', [AbastecimientosController::class, 'store']);


//editar
Route::get('/abastecimientos/{abastecimiento}/edit', [AbastecimientosController::class, 'edit']);
Route::put('/abastecimientos/{abastecimiento}', [AbastecimientosController::class, 'update']);
//eliminar
Route::delete('/abastecimientos/{abastecimiento}', [AbastecimientosController::class, 'destroy']);


//mensajes

Route::get('mensajes', [mensajesController::class, 'index']);
Route::get('/mensajes/create', [mensajesController::class, 'create']);
Route::post('/mensajes/store', [mensajesController::class, 'store']);

//pqrs
Route::get('pqrs', [pqrsController::class, 'index']);

Route::get('/pqrs/create', [pqrsController::class, 'create']);
Route::post('/pqrs/store', [pqrsController::class, 'store']);


//editar
Route::get('/pqrs/edit/{id}', [pqrsController::class, 'edit']);
Route::put('/pqrs/update/{pqr}', [pqrsController::class, 'update']);


//eliminar
Route::delete('/pqrs/destroy/{pqr}', [pqrsController::class, 'destroy']);


//rols
Route::get('/rols', [rolsController::class, 'index']);
