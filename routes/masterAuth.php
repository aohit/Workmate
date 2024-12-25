<?php

use App\Http\Controllers\Master\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Master\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Master\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Master\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Master\Auth\NewPasswordController;
use App\Http\Controllers\Master\Auth\PasswordController;
use App\Http\Controllers\Master\Auth\PasswordResetLinkController;
use App\Http\Controllers\Master\Auth\RegisteredUserController;
use App\Http\Controllers\Master\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

 
    // Route::group(['middleware' => ['guest:master'], 'prefix' => 'master', 'as' => 'master'], function(){

Route::middleware('guest:master')->group(function () {
    Route::get('master/register', [RegisteredUserController::class, 'create'])
                ->name('master.register');

    Route::post('master/register', [RegisteredUserController::class, 'store']);

    Route::get('master/login', [AuthenticatedSessionController::class, 'create'])
                ->name('master.login');

    Route::post('master/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('master/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('master.password.request');

    Route::post('master/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('master.password.email');

    Route::get('master/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('master.password.reset');

    Route::post('master/reset-password', [NewPasswordController::class, 'store'])
                ->name('master.password.store');
});

// Route::group(['middleware' => ['auth:master'], 'prefix' => 'master', 'as' => 'master'], function(){/
    Route::middleware('auth:master')->group(function () {

        
    Route::get('master/verify-email', EmailVerificationPromptController::class)
                ->name('master.verification.notice');

    Route::get('master/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('master.verification.verify');

    Route::post('master/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('master.verification.send');

    Route::get('master/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('master.password.confirm');

    Route::post('master/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('master/password', [PasswordController::class, 'update'])->name('master.password.update');

    Route::post('master/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('master.logout');
});
