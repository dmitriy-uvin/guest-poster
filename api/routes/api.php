<?php

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

//Route::middleware('user:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
    Route::get('/me', [\App\Http\Controllers\Api\Auth\AuthController::class, 'me'])->middleware('auth:api');
    Route::post('/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/email-verification', [\App\Http\Controllers\Api\Auth\EmailVerificationController::class, 'sendEmailVerification'])->middleware('auth:api');
    Route::post('/email/verify', [\App\Http\Controllers\Api\Auth\EmailVerificationController::class, 'verifyEmail']);
    Route::post('/forgot-password', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'resetPassword']);
});

Route::group([
    'prefix' => 'platforms',
], function () {
    Route::post('/store', [\App\Http\Controllers\Api\PlatformController::class, 'savePlatform'])->middleware('admin');
    Route::get('/', [\App\Http\Controllers\Api\PlatformController::class, 'getPlatformCollection'])->middleware('auth:api');
});

