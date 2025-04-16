<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerCliente;
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
Route::put('/usuario/{id}', [ControllerCliente::class, 'updateApi'])->name('usuario.update');
Route::delete('/usuario/{id}', [ControllerCliente::class, 'destroyApi'])->name('usuario.detroy');