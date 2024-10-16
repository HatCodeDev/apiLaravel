<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TostadoController;  
use App\Http\Controllers\BebidaController;   
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function(){
	Route::resource('tostados',TostadoController::class);
    Route::resource('bebidas',BebidaController::class);
    Route::get('bebidasall',[BebidaController::class,'all']);
    Route::get('bebidasbytostado',[BebidaController::class,'BebidasByTostado']);

    Route::get('auth/logout',[AuthController::class, 'logout']);
});

