<?php

use App\Http\Controllers\Api\Opencart\CategoryOpencartController;
use App\Http\Controllers\Api\Opencart\ManufacturerOpencartController;
use App\Http\Controllers\Api\Opencart\ProductOpencartController;
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

Route::get('/opencart/manufacturers', [ManufacturerOpencartController::class, 'index'])
    ->name('api.opencart.manufacturers.index');

Route::get('/opencart/categories', [CategoryOpencartController::class, 'index'])
    ->name('api.opencart.category.index');

    Route::get('/opencart/products', [ProductOpencartController::class, 'index'])
    ->name('api.opencart.product.index');