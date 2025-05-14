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
        Route::resource('user', App\Http\Controllers\AdminUserManageController::class);
        Route::resource('shop', App\Http\Controllers\ShopController::class);

    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('cart')->name('cart.')->group(function () {

        Route::get('/product', [App\Http\Controllers\CartController::class, 'index'])->name('product');

    });
});


