<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::group(['middleware' => 'auth:api'], function (){
    //mostramos todos los jugadores
    Route::get('/players',[UserController::class, 'DisplayAllPlayers']);
    //crear jugador
    Route::post('/players',[UserController::class, 'CreatePlayer']);
    //mostrar un jugador
    Route::get('/players{id}',[UserController::class, 'DisplayPlayer']);
    //Editar jugado
    Route::put('/players{id}',[UserController::class, 'UpdatePlayer']);
    //Eliminar Jugador
    Route::delete('/players{id}',[UserController::class, 'DeletePlayer']);
});

