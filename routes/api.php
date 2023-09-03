<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Leaderboard\Controller\v1\LeaderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'middleware' => []], function () {
    Route::post('/leader/store', [LeaderController::class, 'store']);
    Route::put('/leader/update', [LeaderController::class, 'update']);
    Route::get('/leaders/{orderBy}/{sortBy}', [LeaderController::class, 'all']);
    Route::get('/leader/search/{key}', [LeaderController::class, 'search']);
    Route::get('/leader/{id}', [LeaderController::class, 'one']);
    Route::delete('/leader/{id}', [LeaderController::class, 'delete']);
});
