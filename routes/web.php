<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\productController;
use App\Http\Controllers\providerController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\saleController;

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

Route::get('/', function () {
    return view('panel.index');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resources([
    'category' => categoryController::class,
    'brand'=> brandController::class,
    'product' => productController::class,
    'client' => clientController::class,
    'provider' => providerController::class,
    'purchase' => purchaseController::class,
    'sale' => saleController::class,
]);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});
Route::get('/404', function () {
    return view('pages.404');

});Route::get('/500', function () {
    return view('pages.500');
});

