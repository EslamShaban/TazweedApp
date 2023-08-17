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
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\AddressTypeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\WashRequestController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController;
use App\Models\Offer;

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
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('update-profile', [AdminController::class,'updateProfile'])->name('update_profile');


        //clients
        Route::resource('clients', ClientController::class)->name('*','clients');

        //captains
        Route::resource('captains', CaptainController::class)->name('*','captains');

        //categories
        Route::resource('categories', CategoryController::class)->name('*','categories');

        //offers
        Route::resource('offers', OfferController::class)->name('*','offers')->except([
            'show'
        ]);

        Route::get('/offers/all-products', [OfferController::class, 'getAllProducts'])->name('offers.getAllProducts');
        Route::get('/offers/all-categories', [OfferController::class, 'getAllCategories'])->name('offers.getAllCategories');

        //services
        Route::resource('services', ServiceController::class)->name('*','services');

        //car types
        Route::resource('car_types', CarTypeController::class)->name('*','car_types');

        //car models
        Route::resource('car_models', CarModelController::class)->name('*','car_models');

        //products
        Route::resource('products', ProductController::class)->name('*','products');

        Route::get('product_attributes', [ProductController::class, 'products_attributes'])->name('product_attributes');
        Route::post('product_attributes', [ProductController::class, 'store_product_attributes'])->name('store_product_attributes');
        Route::get('delete_product_variant/{id}', [ProductController::class, 'delete_product_variant'])->name('delete_product_variant');
        Route::get('product_variants/{id}', [ProductController::class, 'product_variants'])->name('product_variants');
        Route::post('product_variants', [ProductController::class, 'store_product_variants'])->name('store_product_variants');

        //attributes
        Route::resource('attributes', AttributeController::class)->name('*','attributes');

        //brands
        Route::resource('brands', BrandController::class)->name('*','brands');

        //attribute_values
        Route::resource('attribute_values', AttributeValueController::class)->name('*','attribute_values');

        //address types
        Route::resource('address_types', AddressTypeController::class)->name('*','address_types');

        //coupons
        Route::resource('coupons', CouponController::class)->name('*','coupons');

        //orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');

        //questions
        Route::resource('questions', QuestionController::class)->name('*','questions');

        //wash requests
        Route::get('wash_requests', [WashRequestController::class, 'index'])->name('wash_requests.index');
        Route::get('wash_requests/{id}', [WashRequestController::class, 'show'])->name('wash_requests.show');

        //settings
        Route::put('settings/update', [SettingController::class, 'update'])->name('settings.update');
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');

        //reports

        Route::get('reports',[ReportController::class,'index'])->name('reports.index');
        Route::get('reports/bw_dates_report',[ReportController::class,'bw_dates_report'])->name('reports.bw_dates_report');
        Route::get('reports/captain_reports',[ReportController::class,'captain_reports'])->name('reports.captain_reports');
        Route::get('reports/captain_requests_statistics',[ReportController::class,'captain_requests_statistics'])->name('reports.captain_requests_statistics');
        Route::get('reports/bw_dates_orders_report',[ReportController::class,'bw_dates_orders_report'])->name('reports.bw_dates_orders_report');

});

// Auth admins
Route::group(['prefix' => 'admin'] , function(){
    // Authentication Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});
