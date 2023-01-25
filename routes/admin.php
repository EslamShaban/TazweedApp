<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CaptainController;

Route::group(
    [
        'prefix'        => 'admin',
        'as'            => 'admin.',
        'middleware'    => ['auth']
    ], function(){

        //home
        Route::get('/', [HomeController::class,'index'])->name('index');
        
        //roles
        Route::resource('roles', RoleController::class)->name('*','roles');
        
        //cities
        Route::resource('cities', CityController::class)->name('*','cities');

        //admins
        Route::resource('admins', AdminController::class)->name('*','admins');
        
        //clients
        Route::resource('clients', ClientController::class)->name('*','clients');

        //captains
        Route::resource('captains', CaptainController::class)->name('*','captains');
});

// Auth admins
Route::group(['prefix' => 'admin'] , function(){
    // Authentication Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});
