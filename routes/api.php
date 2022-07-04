<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('check_token', [AuthController::class, 'check_token']);
});

Route::group(['middleware' => 'sanctum'], function() {
    Route::group(['prefix' => 'product'], function() {
        Route::get('get', [BarangController::class, 'index']);
        Route::post('store', [BarangController::class, 'store']);
        Route::get('show/{id}', [BarangController::class, 'show']);
        Route::get('edit/{id}', [Barangcontroller::class, 'edit']);
        Route::put('update/{id}', [BarangController::class, 'update']);
        Route::delete('delete/{id}', [BarangController::class, 'destroy']);
    });
});

// Route::group(['prefix' => 'product'], function() {
//     Route::get('get', [BarangController::class, 'index']);
//     Route::post('store', [BarangController::class, 'store']);
//     Route::get('show/{id}', [BarangController::class, 'show']);
//     Route::get('edit/{id}', [Barangcontroller::class, 'edit']);
//     Route::put('update/{id}', [BarangController::class, 'update']);
//     Route::delete('delete/{id}', [BarangController::class, 'destroy']);
// });



Route::group(['prefix' => 'public/product'], function() {
    Route::get('get', [BarangController::class, 'index']);
});
