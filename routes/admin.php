<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;

Route::group(
    [
        'prefix'        => LaravelLocalization::setLocale(),
        'middleware'    => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){


        Route::name('admin.')->prefix('admin')->group(function(){

            //home
            Route::get('/', [HomeController::class,'index'])->name('index');


        });

});

// Auth admins
Route::group(['prefix' => 'admin'] , function(){
    // Authentication Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});
