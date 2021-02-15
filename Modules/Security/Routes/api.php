<?php

use Illuminate\Http\Request;
use Modules\Security\Http\Controllers\ForgotPasswordController;
use Modules\Security\Http\Controllers\ResetPasswordController;
use Modules\Security\Http\Controllers\SecurityController;
use Modules\Security\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [SecurityController::class, 'logout']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [SecurityController::class, 'login']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
});
