<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ParcelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'name' => 'v1'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth')->group(function () {
        Route::group(['prefix' => 'parcel', 'name' => 'parcel', 'controller' => ParcelController::class], function () {
            Route::post('/', 'store');
            Route::put('/{parcel}', 'update');
        });
    });
});
