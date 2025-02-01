<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'OK!';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::get('/facebook', [AuthController::class, 'redirectToFacebook']);
    Route::get('/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
    Route::get('/github', [AuthController::class, 'redirectToGithub']);
    Route::get('/github/callback', [AuthController::class, 'handleGithubCallback']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'getProfile']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);
        Route::post('/change-email', [AuthController::class, 'changeEmail']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);

        Route::get('/author/{id}', [AuthController::class, 'getAuthor']);
    });

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verified'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verify/resend', [VerifyEmailController::class, 'resend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.resend');

    Route::post('/forgot-password', [ChangePasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ChangePasswordController::class, 'resetPassword']);
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'getAll']);
});