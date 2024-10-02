<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
//crear jugador
Route::post('/register',[UserController::class, 'register']);
//loguearse
Route::post('/login',[UserController::class, 'login']);
//Salir


Route::middleware('auth:api')->group(function() {
    Route::post('/logout',[UserController::class, 'logout']);
    Route::post('/players/{id}/games', [GameController::class, 'createGame']); 
    Route::delete('/players/{id}/games', [GameController::class, 'destroy']); 

});
Route::group(['middleware' => 'auth:api', 'role:admin'], function (){
    //mostramos todos los jugadores
    Route::get('/players',[UserController::class, 'DisplayAllPlayers']);
    //mostrar un jugador
    Route::get('/players/{id}',[UserController::class, 'DisplayPlayer']);
    //Editar jugado
    Route::put('/players/{id}',[UserController::class, 'UpdatePlayer']);
    //Eliminar Jugador
    Route::delete('/players/{id}',[UserController::class, 'DeletePlayer']);

// Rutas para gestionar los juegos

});