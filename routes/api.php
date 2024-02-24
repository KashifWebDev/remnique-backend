<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['cors-mw'])->group(function () {

    require_once 'admin_routes.php';
    Route::group(['prefix' => 'store'], function (){
        require_once 'frontend_site_routes.php';
    });
});
