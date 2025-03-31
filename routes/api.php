<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContributionController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'Hello world!');

Route::prefix('/v1')->group(function (): void {
    //WITHOUT JWT MIDDLEWARE
    Route::controller(AuthController::class)
        ->prefix('/auth')
        ->group(function (): void {
            Route::post('/login', 'login');
        });

    //WITH JWT MIDDLEWARE
    Route::middleware(JwtMiddleware::class)->group(function (): void {
        Route::controller(ContributionController::class)
            ->prefix('/contributions')
            ->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::prefix('/history')->group(function () {
                    Route::get('/', 'indexHistory');
                    Route::get('/export', 'exportHistory');
                });
            });
    });
});
