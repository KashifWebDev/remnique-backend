<?php

use App\Http\Controllers\store\StoreMenuController;
use Illuminate\Support\Facades\Route;




//Menus
Route::group(['prefix' => 'menus'], function (){
    Route::get('/listing', [StoreMenuController::class, 'index']);
});
