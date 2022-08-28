<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Subject\SubjectController;
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

        Route::post('create', [PostController::class, 'store']);
        Route::patch('{post:slug}/edit', [PostController::class, 'edit']);
        Route::delete('{post:slug}/delete', [PostController::class, 'destroy']);
        
        Route::get('subjects/{subject:slug}', [SubjectController::class, 'show'])->withoutMiddleware('auth:sanctum');
        Route::get('{subject:slug}/{post:slug}', [PostController::class, 'show'])->withoutMiddleware('auth:sanctum');
    });
});
