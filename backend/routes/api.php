<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::group(["prefix"=> "v1"], function(){

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/Admin', [AdminController::class, 'Adminlogin']);

});