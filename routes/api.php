<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Api\FetchDataController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/clear', function() {

    Artisan::call('optimize');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "Cleared!";
});
Route::get('/migrate', function() {
    Artisan::call('migrate');
    return "Migration Successful!";
});
Route::get('/seed', function() {
    Artisan::call('db:seed');
    return "Seeding Successful!";
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/send-otp', [JwtAuthController::class, 'generateOTP'])->name('user.otp');
    Route::post('/send-otp/pass-reset', [JwtAuthController::class, 'passResetOTP'])->name('user.otp.pass.reset');
    Route::post('/verify-otp', [JwtAuthController::class, 'verifyOTP'])->name('user.verify');
    Route::post('/register', [JwtAuthController::class, 'register'])->name('user.register');
    Route::post('/set-new-pass', [JwtAuthController::class, 'setNewPass'])->name('user.register.new.pass');
    Route::post('/login', [JwtAuthController::class, 'login'])->name('user.login');
    Route::get('/user', [JwtAuthController::class, 'user'])->name('user.profile');
    Route::post('/token-refresh', [JwtAuthController::class, 'refresh'])->name('user.refresh');
    Route::post('/logout', [JwtAuthController::class, 'signout'])->name('user.logout');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot'])->name('user.forgot');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('user.reset');

});
Route::group(['middleware' => 'api', 'prefix' => 'user'], function () {
    Route::post('/get-users', [FetchDataController::class, 'getAllUsers'])->name('user.get.users');
    Route::post('/get-user', [FetchDataController::class, 'getUser'])->name('user.get.user');
    Route::post('/update-user', [FetchDataController::class, 'updateUser'])->name('user.update.user');
    Route::get('/get-category', [FetchDataController::class, 'getCategory'])->name('user.get.category');
});
Route::group(['name'=>'User','middleware' => 'api', 'prefix' => 'user'], function () {
    Route::post('/user/update', [JwtAuthController::class, 'updateUser'])->name('user.user.update');
});


