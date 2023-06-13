<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\CategoriesDashboardController;
use App\Http\Controllers\Dashboard\ManufacturersDashboardController;
use App\Http\Controllers\Dashboard\ProductsDashboardController;
use App\Http\Controllers\Dashboard\SettingsDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Erp\Megasoft\CategoriesController;
use App\Http\Controllers\Erp\Megasoft\ManufacturersController;
use App\Http\Controllers\Erp\Megasoft\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard', 301);

Route::get('/dashboard/manufacturers', [ManufacturersDashboardController::class, 'index'])
    ->name('dashboard.manufacturer.index')
    ->middleware('auth:sanctum');

Route::get('/dashboard/products', [ProductsDashboardController::class, 'index'])
    ->name('dashboard.product.index')
    ->middleware('auth:sanctum');

Route::get('/dashboard/products/{id}', [ProductsDashboardController::class, 'show'])
    ->name('dashboard.product.show')
    ->middleware('auth:sanctum');

Route::get('/products/runErpJob', [ProductsDashboardController::class, 'runProductsJob'])
    ->name('dashboard.product.run.erp.job')
    ->middleware('auth:sanctum');

Route::get('/dashboard/categories', [CategoriesDashboardController::class, 'index'])
    ->name('dashboard.category.index')
    ->middleware('auth:sanctum');

Route::get('/dashboard/settings', [SettingsDashboardController::class, 'index'])
    ->name('dashboard.settings.index')
    ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/dashboard/settings/general', [SettingsDashboardController::class, 'storeGeneralSettings'])
        ->name('dashboard.settings.general.store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware('auth:sanctum');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

Route::post('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.index');

Route::get('/erp/megasoft/manufacturers', [ManufacturersController::class, 'getData'])->name('manufacturers.index');
Route::get('/erp/megasoft/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/erp/megasoft/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/erp/megasoft/products/imagesInfo', [ProductsController::class, 'imagesInfo'])->name('products.images');
