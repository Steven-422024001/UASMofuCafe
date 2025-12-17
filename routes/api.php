<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/lihat', [ProductController::class, 'lihat']);
    Route::get('/lihat/{id}', [ProductController::class, 'lihat_by_id']);
});

Route::prefix('promos')->group(function () {
    Route::get('/lihat', [PromoController::class, 'lihat']);
    Route::get('/lihat/{id}', [PromoController::class, 'lihat_by_id']);
});
Route::prefix('categories')->group(function () {
    Route::get('/lihat', [CategoryController::class, 'lihat']);
    Route::get('/lihat/{id}', [CategoryController::class, 'lihat_by_id']);
});

Route::apiResource('users', UserController::class );
Route::post('login ', [UserController::class, 'login']);

Route::get('test', function(){
    return response()->json(['message' => 'API is working!']);
});   

$router->post('products/lihat', 'ProductController@storeAPI');
$router->put('products/lihat/{id}', 'ProductController@updateAPI');
$router->delete('products/lihat/{id}', 'ProductController@destroyAPI');