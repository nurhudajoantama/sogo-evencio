<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\InformationController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PaymentMethodController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');


Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/information')->controller(InformationController::class)->name('information.')->group(function () {
    Route::get('/{information:slug}', [InformationController::class, 'show'])->name('show');
});


Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/', [InformationController::class, 'index'])->name('index');
    Route::resource('/information', InformationController::class)->except(['show']);
    Route::prefix('/information')->controller(InformationController::class)->name('information.')->group(function () {
        Route::get('/active/{id}', [InformationController::class, 'active'])->name('active');
        Route::get('/nonactive/{id}', [InformationController::class, 'nonactive'])->name('nonactive');
    });
    

    Route::prefix('/users')->controller(UserController::class)->name('users.')->group(function () {
        Route::get('/',  'index')->name('index');
    });

    Route::resource('/products', ProductController::class)->except(['show']);
    Route::resource('paymentmethods', PaymentMethodController::class)->except('show');

    Route::resource('user', UserController::class)->except('show', 'create', 'store');
    Route::resource('admin', AdminController::class)->except('show');
});
