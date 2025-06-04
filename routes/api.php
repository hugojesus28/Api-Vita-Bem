<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerCliente;
use App\Http\Controllers\RemedioController;

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

Route::get('/usuario', [ControllerCliente::class, 'indexApi'])->name('usuario.index');
Route::post('/usuario', [ControllerCliente::class, 'storeApi'])->name('usuario.store');
Route::post('/usuario/{id}', [ControllerCliente::class, 'updateApi'])->name('usuario.update');
Route::delete('/usuario/{id}', [ControllerCliente::class, 'destroyApi'])->name('usuario.destroy');
Route::get('/usuario/{idUser}', [ControllerCliente::class, 'showApi'])->name('usuario.show');
Route::get('/usuario/login/{email}', [ControllerCliente::class, 'selectUserLogin'])->name('usuario.login');

Route::post('/remedio', action: [remedioController::class, 'store'])->name('remedio.store');
Route::get('/remedio', action: [remedioController::class, 'index'])->name('remedio.index');
Route::get('/remedio/{id}', action: [remedioController::class, 'show'])->name('remedio.index');
Route::post('/remedio/{id}', action: [remedioController::class, 'edit'])->name('remedio.edit');
Route::delete('/remedio/{id}', action: [remedioController::class, 'destroy'])->name('remedio.destroy');


Route::get('/remedioa/{pesquisa}/{id}', action: [remedioController::class, 'pesquisar'])->name('remedio.pesquisar');

