<?php

use App\Http\Controllers\AbastecimientosController;
use App\Http\Controllers\mensajesController;
use App\Http\Controllers\productosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_datauser' , [usersController::class, 'dataUser']);

Route::get('/create', [usersController::class, 'create']);

Route::get('get_dataproduc' , [productosController::class, 'dataproduc']);


 //productos
Route::get('productos',[productosController::class,'index'])->name('product.index');
 Route::get('/productos/create', [productosController::class, 'create'])->name('productos.create');
 Route::post('/productos/store', [productosController::class, 'store'])->name('productos.store');

 Route::get('/productos/show', [productosController::class, 'show'])->name('productos.show');

 //editar
 Route::get('/productos/edit/{id}', [productosController::class, 'edit'])->name('productos.edit');
 Route::put('/productos/update/{producto}', [productosController::class, 'update'])->name('productos.update');
 //eliminar
 Route::delete('/productos/destroy/{producto}',[productosController::class, 'destroy'])->name('productos.destroy');


 //users
 Route::get('/users', [usersController::class, 'index'])->name('users.index');
 Route::get('/users/create', [usersController::class, 'create'])->name('users.create');
 Route::post('/users/store', [usersController::class, 'store'])->name('users.store'); // Cambiado a '/users'
 

 
 //editar 
 Route::get('/users/edit/{id}', [usersController::class, 'edit'])->name('users.edit');
 Route::put('/users/update/{users}', [usersController::class, 'update'])->name('users.update');


//eliminar
Route::delete('/users/destroy/{user}',[usersController::class, 'destroy'])->name('users.destroy');

Route::post('register', [usersController::class,'register'])->name('register');
Route::post('logins', [usersController::class,'logins'])->name('logins');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('logout', [usersController::class,'logout'])->name('logout');
   /*  route::get('catalogo',[ProductController::class,'catalogo'])->name('catalogo.index'); */
});








// abastecimiento
Route::get('abastecimientos', [AbastecimientosController::class, 'index'])->name('abastecimientos.index');

Route::get('abastecimientos/create', [AbastecimientosController::class, 'create'])->name('abastecimientos.create');
Route::post('abastecimientos', [AbastecimientosController::class, 'store'])->name('abastecimientos.store');


//editar
Route::get('abastecimientos/{abastecimiento}/edit', [AbastecimientosController::class, 'edit'])->name('abastecimientos.edit');
Route::put('abastecimientos/{abastecimiento}', [AbastecimientosController::class, 'update'])->name('abastecimientos.update');
//eliminar
Route::delete('abastecimientos/{abastecimiento}',[AbastecimientosController::class, 'destroy'])->name('abastecimientos.destroy');


//mensajes

Route::get('mensajes', [mensajesController::class, 'index'])->name('mensajes.index');



