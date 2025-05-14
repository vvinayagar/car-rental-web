<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\TransientTokenController;


Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])
    ->middleware(['throttle']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user/tokens', [AuthorizedAccessTokenController::class, 'forUser']);
    Route::delete('/user/tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);
});


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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('/rentals', [App\Http\Controllers\API\RentalController::class, 'rentals']);
    Route::get('/plans/{id}', [App\Http\Controllers\API\RentalController::class, 'plans']);

    Route::post('/payment', [App\Http\Controllers\API\RentalController::class, 'payment']);
    Route::get('/rental-details', [App\Http\Controllers\API\RentalController::class, 'rentalDetails']);
    Route::get('/user-details', [App\Http\Controllers\API\RentalController::class, 'userDetails']);
    Route::post('/user-updates', [App\Http\Controllers\API\RentalController::class, 'userUpdates']);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
