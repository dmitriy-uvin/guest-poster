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

Route::get('/topics', [\App\Http\Controllers\Api\TopicController::class, 'getTopicCollection'])
    ->middleware('auth');

Route::group([
    'prefix' => 'platforms',
], function () {
    Route::group(['middleware' => 'admin'], function() {
        Route::post('/update-all', [\App\Http\Controllers\Api\PlatformController::class, 'updateApiDataAll']);
        Route::post('/update-by-ids', [\App\Http\Controllers\Api\PlatformController::class, 'updateApiDataByIds']);
        Route::post('/import', [\App\Http\Controllers\Api\ImportPlatformsController::class, 'importPlatforms']);
        Route::get('/import-file', [\App\Http\Controllers\Api\ImportPlatformsController::class, 'downloadImportFileTemplate']);
        Route::get('/export-by-ids', [\App\Http\Controllers\Api\ExportPlatformsController::class, 'exportPlatformsByIds']);
        Route::get('/export-all', [\App\Http\Controllers\Api\ExportPlatformsController::class, 'exportPlatformsAll']);
        Route::post('/', [\App\Http\Controllers\Api\PlatformController::class, 'savePlatform']);
        Route::put('/trash-in', [\App\Http\Controllers\Api\PlatformController::class, 'moveInTrashByIds']);
        Route::put('/trash-from', [\App\Http\Controllers\Api\PlatformController::class, 'moveFromTrashByIds']);
        Route::put('/{id}', [\App\Http\Controllers\Api\PlatformController::class, 'updatePlatformById']);
        Route::get('/trash', [\App\Http\Controllers\Api\PlatformController::class, 'getPlatformsInTrashCollection']);
        Route::get('/{id}', [\App\Http\Controllers\Api\PlatformController::class, 'getPlatformById']);
        Route::delete('/', [\App\Http\Controllers\Api\PlatformController::class, 'deletePlatformsByIds']);
    });

    Route::get('/', [\App\Http\Controllers\Api\PlatformController::class, 'getPlatformCollection'])
        ->middleware('auth:api');
});

Route::group([
    'prefix' => 'seo-rank',
    'middleware' => 'admin'
], function () {
    Route::get('/moz-alexa-sr', [\App\Http\Controllers\Api\SeoRankApiController::class, 'fetchInformationByDomainMozAlexaSr']);
    Route::get('/majestic', [\App\Http\Controllers\Api\SeoRankApiController::class, 'fetchInformationByDomainMajestic']);
});

Route::group([
    'prefix' => 'check-trust',
    'middleware' => 'admin'
], function () {
    Route::get('/', [\App\Http\Controllers\Api\CheckTrustApiController::class, 'getCheckTrustData']);
});

Route::group([
    'prefix' => 'orders'
], function () {
    Route::group([
        'middleware' => 'user'
    ], function () {
        Route::post('/', [\App\Http\Controllers\Api\OrderController::class, 'createOrder']);
        Route::get('/users/me', [\App\Http\Controllers\Api\OrderController::class, 'getOrdersForAuthorizedUser']);
    });
    Route::get('/{id}', [\App\Http\Controllers\Api\OrderController::class, 'getOrderById']);

    Route::group([
        'middleware' => 'admin'
    ], function () {
        Route::get('/', [\App\Http\Controllers\Api\OrderController::class, 'getAllOrders']);
        Route::put('/{id}/status', [\App\Http\Controllers\Api\OrderController::class, 'changeStatus']);
    });
});
