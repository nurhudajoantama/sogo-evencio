<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RajaOngkirController;

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

Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvince'])->name('rajaongkir.provinces');
Route::get('/rajaongkir/cities', [RajaOngkirController::class, 'getCity'])->name('rajaongkir.cities');
Route::post('/rajaongkir/cost', [RajaOngkirController::class, 'getCost'])->name('rajaongkir.cost');
