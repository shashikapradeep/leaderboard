<?php

use Illuminate\Support\Facades\Route;
use Leaderboard\Controller\v1\LeaderController;

Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'middleware' => []], function () {
    Route::post('/leader/store', [LeaderController::class, 'store'])->name('api.leader.store');
    Route::put('/leader/update/{id}', [LeaderController::class, 'update'])->name('api.leader.update');
    Route::get('/leader/search/{text}/{column?}', [LeaderController::class, 'search'])->name('api.leader.search');
    Route::get('/leaders/{orderBy}/{sortBy}', [LeaderController::class, 'all'])->name('api.leader.all');
    Route::get('/leader/update_score/{id}/{context}', [LeaderController::class, 'updateScore'])->name('api.leader.update.score');
    Route::get('/leader/{id}', [LeaderController::class, 'one'])->name('api.leader.one');
    Route::delete('/leader/{id}', [LeaderController::class, 'delete'])->name('api.leader.delete');
});
