<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAPIController;


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

Route::middleware(['APIAuth','api'])->group(function(){

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthAPIController::class, 'login']);
        Route::post('register', [AuthAPIController::class, 'register']);
        Route::post('logout', [AuthAPIController::class, 'logout'])->middleware('JwtApiAuth');

    });

    Route::middleware(['JwtApiAuth'])->group(function () {
             
 
    });

});

