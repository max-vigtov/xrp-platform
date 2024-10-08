<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\productController;
use App\Http\Controllers\providerController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\roleController;

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
Route::get('/',[homeController::class,'index'])->name('panel');

Route::resources([
    'category' => categoryController::class,
    'brand'=> brandController::class,
    'product' => productController::class,
    'client' => clientController::class,
    'provider' => providerController::class,
    'purchase' => purchaseController::class,
    'sale' => saleController::class,
    'user' =>userController::class,
    'role' =>roleController::class,
]);

Route::post('/login', [loginController::class,'login']);
Route::get('/login', [loginController::class,'index'])->name('login');
Route::get('/logout', [logoutController::class,'logout'])->name('logout');

Route::get('/401', function () {
    return view('pages.401');
});
Route::get('/404', function () {
    return view('pages.404');

});Route::get('/500', function () {
    return view('pages.500');
});

