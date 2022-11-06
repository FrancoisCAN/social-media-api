<?php

use App\Http\Controllers\Api\v1\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::fallback(function () {
    return response()->json([
        'status' => [
            'error' => 'Route not found. Please check the documentation: https://github.com/FrancoisCAN/social-media-api.',
            'state' => false,
        ], Response::HTTP_NOT_FOUND
    ]);
});

Route::middleware('auth.api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::controller(AuthenticationController::class)->group(function () {
                Route::post('/register', 'register');
                Route::post('/login', 'login');
                Route::middleware('auth:sanctum')->group(function () {
                    Route::post('/signout', 'signout');
                });
            });
        });
    });
});
