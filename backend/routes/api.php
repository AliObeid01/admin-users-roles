<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::group(["prefix"=> "v1"], function(){

    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(["prefix"=> "admin"], function(){
            Route::get('/users', [AdminController::class, 'getUsers']);
            Route::post('/approve_user', [AdminController::class, 'approveUser']);
            Route::post('/add_certificate', [AdminController::class, 'addCertificate']);
            Route::get('/certificates_report', [AdminController::class, 'certificatesReport']);
            Route::get('/logout', [AdminController::class, 'logout']);
        });
        
        Route::group(["prefix"=> "user"], function(){
            Route::post('/update_profile', [UserController::class, 'updateProfile']);
            Route::post('/attach_certificate', [UserController::class, 'attachCertificate']);
            Route::post('/remove_certificate', [UserController::class, 'removeCertificate']);
            Route::get('/user_certificates', [UserController::class, 'getCertificates']);
            Route::get('/logout', [UserController::class, 'logout']);
        });
        
    });

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get("/not_found", [AuthController::class, "notFound"])->name("not-found");

});