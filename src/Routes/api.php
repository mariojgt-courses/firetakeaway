<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Firetakeaway\Controllers\Api\AuthApiControler;
use Mariojgt\Firetakeaway\Controllers\Api\UserApiController;
use Mariojgt\Firetakeaway\Controllers\Api\OrderApiController;
use Mariojgt\Firetakeaway\Controllers\Api\ProductApiController;

// Check url
Route::group([
    'prefix' => 'api'
], function () {
    // Api example to Login
    Route::get('/check-url', [AuthApiControler::class, 'checkUrl'])->name('check-url');
});

// Boot token required
Route::group([
    //'middleware' => ['boot_token'],
    'prefix' => 'api'
], function () {
    // Api example to Login
    Route::post('/firetakeaway/api/login', [AuthApiControler::class, 'login'])
        ->name('firetakeaway.api.login');
    // Api Example to Register
    Route::post('/firetakeaway/api/register', [AuthApiControler::class, 'register'])
        ->name('firetakeaway.api.register');
    // Api connection test
    Route::post('/firetakeaway/api/check-boot-tooken', [AuthApiControler::class, 'checkConnection'])
        ->name('firetakeaway.api.check-boot-tooken');
});

// Auth Route
Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'api'
], function () {
    // Check valid token
    Route::post('/firetakeaway/api/check-token', [UserApiController::class, 'checkToken'])->name('firetakeaway.api.check-token');

    // Load user info
    Route::post('/firetakeaway/api/user', [UserApiController::class, 'userProfile'])->name('firetakeaway.api.user');
    Route::post('/firetakeaway/api/user-update', [UserApiController::class, 'userUpdateProfile'])->name('firetakeaway.api.user-update');

    // Api Order Stuff
    // Api Product Search
    Route::post('/mobile/product/search', [ProductApiController::class, 'productSearch'])
        ->name('api.product.seach');
    // Order Store
    Route::post('/mobile/order/create', [OrderApiController::class, 'orderCreate'])
        ->name('api.order.create');
    // New Orders
    Route::get('/mobile/order/new', [OrderApiController::class, 'newOrders'])
        ->name('api.order.new');
    // User Orders
    Route::get('/mobile/user/orders', [OrderApiController::class, 'userOrders'])
        ->name('api.user.orders');
    // Order Orders
    Route::get('/mobile/order/old', [OrderApiController::class, 'oldOrders'])
        ->name('api.order.old');
    // Api Order Delete
    Route::post('/mobile/order/delete/{id}', [OrderApiController::class, 'destroy'])
        ->name('api.order.delete');
    // Read for collection Order
    Route::post('/mobile/order/complete', [OrderApiController::class, 'confirmOrder'])
        ->name('api.order.complete');
});
