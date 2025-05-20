<?php

use App\Http\Controllers\LandingController;
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

Route::get('/', [LandingController::class,'landing'])->name('landing');
Route::get('/product_detail/{id}', [ProductController::class,'productDetail'])->name('product.detail');
Route::get('/cart-product-add/{id}', [ProductController::class,'cartAddProduct'])->name('cart.add.product');
Route::post('/cart-buy_now/{id}', [ProductController::class,'cartBuyNowProduct'])->name('cart-buy_now');
Route::get('/single-buy_now/{id}', [ProductController::class,'cartBuyNowProduct'])->name('single-buy_now');
Route::get('/checkout', function () {
    $products1 = session('products', []);
    $subtotal = session('subtotal', 0);
    return view('product.checkout', compact(['products1', 'subtotal']));
})->name('checkout.page');
Route::post('/place-order', [OrdersController::class,'store'])->name('place.order');
Route::get('/products/load-more', [LandingController::class, 'loadMore'])->name('products.load-more');
Route::get('/cart', function () {
    return view('Landing.cart');
});
Route::prefix('admin')->group(function () {
//    Route::resource('admin', AdminController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrdersController::class);
    Route::put('order/{order}/status', [OrdersController::class, 'updateStatus'])->name('order.updateStatus');
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
Route::get('/admin/main', [AdminController::class,'index'])->name('login');
Route::post('/admin/main/checklogin', [AdminController::class,'checklogin'])->name('checklogin');
Route::post('/orders/slug', [OrdersController::class,'getOrdersBySlug'])->name('orders.slug');
Route::get('/orders/{slug}', [OrdersController::class,'getOrdersBySlugsss'])->name('orders.by.slug');

Route::group(['prefix'=> 'admin','name'=>'Admin_Login', 'middleware' => 'auth'], function () {

    Route::get('main/successlogin', [AdminController::class,'successlogin'])->name('home');
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


// Cart routes
//Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/remove/{key}', [ProductController::class, 'cartRemoveProduct'])->name('cart.remove');
Route::get('/cart/update/{key}', [ProductController::class, 'cartUpdateProduct'])->name('cart.update');

// Checkout routes
//Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
//Route::post('/place-order', [ProductController::class, 'placeOrder'])->name('place.order');
Route::get('/order-confirmation/{id}', [ProductController::class, 'orderConfirmation'])->name('order.confirmation');
