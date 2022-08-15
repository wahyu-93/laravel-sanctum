<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Posts\PostController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('me', MeController::class);

    Route::prefix('posts')->group(function() {
        Route::get('', [PostController::class, 'index'])->withoutMiddleware('auth:sanctum');
    });
});
