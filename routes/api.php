<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CityAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\HomeAPIController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\SearchAPIController;
use App\Http\Controllers\API\WashRequestAPIController;

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
        Route::post('social_login', [AuthAPIController::class, 'social_login']);
        Route::post('forget_password', [AuthAPIController::class, 'forget_password']);
        Route::post('code_check', [AuthAPIController::class, 'code_check']);
        Route::post('reset_password', [AuthAPIController::class, 'reset_password']);
        Route::post('logout', [AuthAPIController::class, 'logout'])->middleware('JwtApiAuth');

    });
        
    Route::get('cities', [CityAPIController::class, 'get_cities']);

    Route::middleware(['JwtApiAuth'])->group(function () {
                     
        Route::get('my_profile', [UserAPIController::class, 'my_profile']);
        Route::post('update_profile', [UserAPIController::class, 'update_profile']);
        Route::post('change_password', [UserAPIController::class, 'change_password']);

        Route::get('home', [HomeAPIController::class, 'home']);
        Route::get('products', [ProductAPIController::class, 'get_all_products']);
        Route::get('products/{id}/details', [ProductAPIController::class, 'product_details']);
        Route::get('offers', [ProductAPIController::class, 'get_all_offers']);
        Route::get('search_filters', [SearchAPIController::class, 'search_filters']);
        Route::get('search', [SearchAPIController::class, 'search']);

                
        Route::post('make_request', [WashRequestAPIController::class, 'make_request']);

    });

});

