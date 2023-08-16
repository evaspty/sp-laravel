<?php

use App\Http\Controllers\API\ProductController;
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

//panggil ProductController sebagai object
use App\Http\Controllers\ProductContorller;

//panggil UserController sebagai object
use App\Http\Controllers\UserController;

//route untuk log in
Route::post('/login',[UserController::class,'login']);

Route::middleware(['jwt-auth'])->group(function(){
    //Buat route untuk menemukan Produk
    Route::post('/product',[ProductContorller::class, 'store']);
    Route::get('/product',[ProductContorller::class, 'showAll']);
    Route::get('/product/{id}',[ProductContorller::class, 'showById']);
    Route::get('/product/search/product_name={product_name}',[ProductContorller::class, 'showByName']);
    Route::put('/product/{id}',[ProductContorller::class, 'update']);
    Route::put('/product/{id}',[ProductContorller::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

