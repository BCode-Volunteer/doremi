<?php

use App\Http\Controllers\API\ContributionController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'Hello world!');

//TODO: Criar rotas dentro de middleware de autenticação

// Route::middleware('')
//     ->prefix('/v1')
//     ->group(function () {
//         //Route::controllers...
//     });

Route::controller(ContributionController::class)
    ->prefix('/v1/contributions')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::prefix('/history')->group(function () {
            Route::get('/', 'indexHistory');
            Route::get('/export', 'exportHistory');
        });
    });
