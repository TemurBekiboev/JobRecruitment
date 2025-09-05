<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Redis;

    Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('auth')->group(function () {
        Route::middleware('throttle:5,1')->group(function () {
            Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
            Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
        });

        Route::middleware('auth:sanctum')->group(function () {
            // Email verification
            Route::get('/email/verify', function () {
                return response()->json([
                    'message' => 'Please verify your email from the verification link sent.'
                ]);
            })->name('verification.notice');

            Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
                $request->fulfill();
                return response()->json(['message' => 'Email verified successfully!']);
            })->middleware('signed')->name('verification.verify');

            Route::post('/email/verification-notification', function (Request $request) {
                $request->user()->sendEmailVerificationNotification();
                return response()->json(['message' => 'Verification link sent!']);
            })->middleware('throttle:6,1')->name('verification.send');

            // Logout
            Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Company Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        Route::get('/{id}', [CompanyController::class, 'show'])->name('companies.show');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Vacancy Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('vacancies')->middleware('auth:sanctum')->group(function () {
        Route::post('/store', [VacancyController::class, 'store'])->name('vacancies.store');
        // add more: update, delete, list by company, etc.
    });

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('applications')->middleware('auth:sanctum')->group(function () {
        Route::post('/store', [ApplicationController::class, 'store'])->name('applications.store');
        // recruiter could review applications here
    });
});

    