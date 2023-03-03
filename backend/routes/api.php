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
        Route::post('/update_profile', [UserController::class, 'updateProfile']);
        Route::post('/attach_certificate', [UserController::class, 'attachCertificate']);
        Route::post('/remove_certificate', [UserController::class, 'removeCertificate']);
        Route::get('/user_certificates', [UserController::class, 'getCertificates']);
        Route::get('/certificates_report', [AdminController::class, 'certificatesReport']);
        Route::get('/logout', [UserController::class, 'logout']);
    });

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

});