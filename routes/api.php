<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CityAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\HomeAPIController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\SearchAPIController;
use App\Http\Controllers\API\ShippingAddressesAPIController;
use App\Http\Controllers\API\CouponAPIController;
use App\Http\Controllers\API\OrderAPIController;
use App\Http\Controllers\API\CaptainAPIController;
use App\Http\Controllers\API\WashRequestAPIController;
use App\Http\Controllers\API\QuestionAPIController;

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

Route::middleware(['APIAuth','api', 'Lang'])->group(function(){

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
        Route::post('search', [SearchAPIController::class, 'search']);
        Route::resource('shipping_addresses', ShippingAddressesAPIController::class);
        Route::post('check_coupon', [CouponAPIController::class, 'check_coupon']);
        Route::post('make_order', [OrderAPIController::class, 'make_order']);
        Route::prefix('client')->group(function()
        {   
            Route::prefix('requests')->group(function(){
                Route::post('make_request', [WashRequestAPIController::class, 'make_request']);
                Route::post('{request_id}/captain/{captain_id}/approve', [WashRequestAPIController::class, 'client_approval']);
                Route::post('{request_id}/review', [WashRequestAPIController::class, 'review']);
                Route::post('{request_id}/clear', [WashRequestAPIController::class, 'clear_request']);

            });
        });
                
        Route::prefix('captain')->group(function()
        {   
            Route::post('update_location', [CaptainAPIController::class, 'update_location']);
            Route::get('toggle_status', [CaptainAPIController::class, 'toggle_status']);

            Route::prefix('requests')->group(function(){
                Route::post('{id}/approve', [WashRequestAPIController::class, 'captain_approval']);
                Route::post('{id}/reject', [WashRequestAPIController::class, 'captain_rejected']);
                Route::post('{id}/change_status', [WashRequestAPIController::class, 'change_status']);
            });
        });
        
        Route::get('questions', [QuestionAPIController::class, 'get_questions']);
        Route::post('questions_answer', [QuestionAPIController::class, 'questions_answer']);
    });

});

