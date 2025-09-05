<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Redis;

    //throttle 5|1
    Route::middleware('throttle:api')->group(function(){
        //register
        Route::post('/register', [AuthController::class, 'register']);
        //login
        Route::post('/login', [AuthController::class, 'login']);
    });

    
    Route::get('/email/verify', function () {
         return response()->json([
        'message' => 'Please verify your email from the verification link sent.'
    ]);
    })->middleware('auth:sanctum')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
 
        return response()->json(['message'=>'Email verified succesfully!']);
    })->middleware(['auth:sanctum','signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

    

    Route::middleware('auth:sanctum')->group(function(){

    Route::post('vacancy/store', [VacancyController::class, 'store']);

    Route::post('companies/store', [CompanyController::class, 'store']);

    Route::post('application/make', [ApplicationController::class, 'store']);
    });

    Route::get('companies', [CompanyController::class, 'index']);
    Route::get('company/{id}', [CompanyController::class, 'show']);

    