<?php

use App\Http\Controllers\API\ContributionController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'Hello world!');

//TODO: Criar rotas dentro de middleware de autenticação

// Route::middleware('')
//     ->prefix('/v1')
//     ->group(function () {
//         Route::controller(ContributionController::class)
//             ->prefix('/contributions')
//             ->group(function () {
//                 Route::get('/', 'index');
//             });
//     });

Route::controller(ContributionController::class)
    ->prefix('/v1/contributions')
    ->group(function () {
        Route::get('/', 'index');
    });
