<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Erp\Megasoft\ManufacturersController;
use App\Http\Controllers\Erp\Megasoft\CategoriesController;
use App\Http\Controllers\Dashboard\ManufacturersDashboardController;
use App\Http\Controllers\Dashboard\CategoriesDashboardController;

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

Route::get('/dashboard/manufacturers', [ManufacturersDashboardController::class, 'index'])
        ->name('dashboard.manufacturer.index')
        ->middleware('auth:sanctum')
;

Route::get('/dashboard/categories', [CategoriesDashboardController::class, 'index'])
        ->name('dashboard.category.index')
        ->middleware('auth:sanctum')
;

Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index')
        ->middleware('auth:sanctum')
;

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

Route::post('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.index');


Route::get('/erp/megasoft/manufacturers',[ManufacturersController::class, 'getData'])->name('manufacturers.index');
Route::get('/erp/megasoft/categories',[CategoriesController::class, 'index'])->name('categories.index');