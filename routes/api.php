<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\GiphyController;
use App\Http\Controllers\Api\UserGifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('gifs')->group(function () {
        Route::get('/search', [GiphyController::class, 'search']);
        Route::get('/{id}', [GiphyController::class, 'findById']);
    });
    Route::prefix('user-gifs')->group(function () {
        Route::post('/', [UserGifController::class, 'store']);
    });
});