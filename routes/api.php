<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Admin\Showcase\ShowcaseController;
use App\Http\Controllers\UserFavorite\UserFavoriteController;
use App\Http\Helpers\RedirectHelper;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('register-admin', [AuthController::class, 'registerAdmin'])->name('register-admin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::post('/add-to-favorites', [UserFavoriteController::class, 'addToFavorites'])->name('add-to-favorites');
        Route::delete('/remove-from-favorites', [UserFavoriteController::class, 'removeFromFavorites'])->name('remove-from-favorites');
    });    

    Route::group(['prefix' => 'carts', 'as' => 'cart.'], function () {
        Route::get('/{id}', [CartController::class, 'list'])->name('list');
        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
        Route::delete('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/complete', [CartController::class, 'complete'])->name('complete');
    }); 

    Route::get('/showcases/{id}/list', [ShowcaseController::class, 'list'])->name('showcases.list');
});

Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['auth:api', 'admin']], function () {
    Route::resource('/categories', CategoryController::class)->except('show');

    Route::resource('/products', ProductController::class)->except('show');

    Route::resource('/showcases', ShowcaseController::class)->only(['create', 'store']);
});

Route::any('*', function () {
    return RedirectHelper::error([], 'Route not found', 404);
});