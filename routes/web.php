<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Landing.landing');
//    return view('admin.auth.login');
});
Route::get('/cart', function () {
    return view('Landing.cart');
//    return view('admin.auth.login');
});
Route::prefix('admin')->group(function () {
//    Route::resource('admin', AdminController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrdersController::class);
    Route::resource('payment', PaymentsController::class);
});
Route::get('/clear', function() {

    Artisan::call('optimize');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "Cleared!";
});

Route::group(['prefix'=> 'admin','name'=>'Admin_Login'], function () {
    Route::get('/main', [AdminController::class,'index'])->name('login');
    Route::post('/main/checklogin', [AdminController::class,'checklogin'])->name('checklogin');
    Route::get('main/successlogin', [AdminController::class,'successlogin'])->name('home');
    Route::resource('categories', AdminCategoryController::class);
    Route::get('/', [AdminController::class,'successlogin']);
    Route::post('main/logout', [AdminController::class,'logout'])->name('logout');
    Route::get('/download-db', [AdminController::class,'downloadDb'])->name('download-db');
});
Route::group(['name'=>'Category','middleware' => 'web',], function () {
    Route::get('/add-category', [CategoryController::class,'addCategory'])->name('add.category');
    Route::post('/new-category', [CategoryController::class,'createCategory'])->name('new.category');
    Route::get('/all-category', [CategoryController::class,'categoryList'])->name('all.category');
    Route::get('/edit-category/{id}', [CategoryController::class,'editCategory'])->name('edit.category');
    Route::post('/update-category/{id}', [CategoryController::class,'updateCategory'])->name('update.category');
    Route::get('/delete-category/{id}', [CategoryController::class,'deleteCategory'])->name('delete.category');

    Route::get('/res-search', [CategoryController::class, 'searchUrl'])->name('category.url.search');
});
Route::group(['name'=>'Users','middleware' => 'web',], function () {
    Route::get('/all-user', [UserController::class,'allUser'])->name('all-user');
    Route::get('/user-status-update/{id}', [UserController::class,'statusUpdate'])->name('user-status-update');
    Route::get('/user-delete/{id}', [UserController::class,'destroy'])->name('user-delete');
    Route::get('/export-users-data', [UserController::class, 'exportUsersData'])->name('export-users-data');
    Route::get('/all-admin-user', [UserController::class,'allAdminUser'])->name('all-admin-user');
});
Route::view('forgot-pass', 'reset-pass')->name('password.reset');


