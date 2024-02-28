<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\store\StoreMenuController;
use Illuminate\Support\Facades\Route;




//Menus
Route::group(['prefix' => 'menus'], function (){
    Route::get('/listing', [StoreMenuController::class, 'index']);
});

//Products
Route::group(['prefix' => 'products'], function (){
    Route::get('{product}', [ProductController::class, 'showSingle']);
    Route::get('slug/{slug}', [ProductController::class, 'showBySlug']);
});


