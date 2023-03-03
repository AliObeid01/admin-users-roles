<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::group(["prefix"=> "user"], function(){

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/users', [AdminController::class, 'getUsers']);
        Route::post('/approve_user', [AdminController::class, 'approveUser']);
        Route::post('/add_certificate', [AdminController::class, 'addCertificate']);
        Route::get('/logout', [UserController::class, 'logout']);
    });

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

});