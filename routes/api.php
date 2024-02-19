<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['cors-mw'])->group(function () {
    //Auth
    Route::group(['prefix' => 'auth'], function (){
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

//Blogs
    Route::apiResource('blogs', BlogController::class)->middleware('auth:sanctum');
    Route::apiResource('blog-categories', BlogCategoryController::class)->middleware('auth:sanctum');
    Route::group(['prefix' => 'blog-comments', 'middleware' => 'auth:sanctum'], function (){
        Route::post('post', [BlogCommentController::class, 'store']);
        Route::post('update', [BlogCommentController::class, 'store']);
    });

//Dashboard
    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function (){
        Route::get('my-blogs', [UserDashboardController::class, 'myBlogs']);

    });

//Products
    Route::group(['middleware' => 'auth:sanctum'], function (){
        Route::apiResource('products', ProductController::class);
    });

//Menus
    Route::group(['prefix' => 'menus', 'middleware' => 'auth:sanctum'], function (){
        Route::get('/all', [MenuController::class, 'index']);
        Route::get('/parent', [MenuController::class, 'parent']);
        Route::get('/complete', [MenuController::class, 'completeSingleMenu']);
        Route::get('/{menu}', [MenuController::class, 'getById']);
        Route::post('/store', [MenuController::class, 'store']);
        Route::put('/update/{menu}', [MenuController::class, 'update']);
        Route::get('/activeMenu/child', [MenuController::class, 'activeChildMenus']);
    });



});
