<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CaptainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddressTypeController;
use App\Http\Controllers\Admin\CouponController;

Route::get('language/{locale}', function ($locale) {

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');

Route::group(
    [
        'prefix'        => 'admin',
        'as'            => 'admin.',
        'middleware'    => ['localization', 'auth']
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

        //categories
        Route::resource('categories', CategoryController::class)->name('*','categories');

        //services
        Route::resource('services', ServiceController::class)->name('*','services');

        //car types
        Route::resource('car_types', CarTypeController::class)->name('*','car_types');

        //car models
        Route::resource('car_models', CarModelController::class)->name('*','car_models');
                
        //products
        Route::resource('products', ProductController::class)->name('*','products');
                
        //address types
        Route::resource('address_types', AddressTypeController::class)->name('*','address_types');

        //coupons
        Route::resource('coupons', CouponController::class)->name('*','coupons');
});

// Auth admins
Route::group(['prefix' => 'admin'] , function(){
    // Authentication Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});
