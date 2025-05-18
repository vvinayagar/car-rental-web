<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something grepat!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Route::get('rental', [App\Http\Controllers\RentalItemController::class , "index"])->name('rental');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin|branch'])->group(function () {
        Route::resource('rental', App\Http\Controllers\RentalItemController::class);
        Route::resource('brand', App\Http\Controllers\BrandController::class);
        Route::resource('category', App\Http\Controllers\CategoryController::class);
        Route::resource('plan', App\Http\Controllers\PlanController::class);
        Route::resource('rent', App\Http\Controllers\RentController::class);

        Route::resource('type', App\Http\Controllers\TypeController::class);
        Route::resource('transmission', App\Http\Controllers\TransmissionController::class);

        Route::resource('shop', App\Http\Controllers\ShopController::class);
        Route::resource('purchase', App\Http\Controllers\PurchaseController::class);
        Route::get('/purchase/approve/{purchase}', [App\Http\Controllers\PurchaseController::class, 'approve'])->name('purchase.approve');
        Route::get('/purchase/reject/{purchase}', [App\Http\Controllers\PurchaseController::class, 'reject'])->name('purchase.reject');


    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', App\Http\Controllers\AdminUserManageController::class);
    });

    Route::middleware(['role:user'])->group(function () {
        Route::resource('customer_purchase', App\Http\Controllers\CustomerBookingController::class);
    });

    Route::middleware(['role:user|branch|admin'])->group(function () {
        Route::resource('profile', App\Http\Controllers\ProfileController::class);
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('cart')->name('cart.')->group(function () {

        Route::get('/all', [App\Http\Controllers\CartController::class, 'view'])->name('view');
        Route::get('/product/{rental}', [App\Http\Controllers\CartController::class, 'index'])->name('product');
        Route::post('/add/{rental}', [App\Http\Controllers\CartController::class, 'add'])->name('add');
        Route::get('/remove/{rental}', [App\Http\Controllers\CartController::class, 'remove'])->name('remove');
        Route::put('/update/{rental}', [App\Http\Controllers\CartController::class, 'update'])->name('update');
        Route::get('/detail', [App\Http\Controllers\CartController::class, 'detail'])->name('detail');


    });

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
    });
});


