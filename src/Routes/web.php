<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Firetakeaway\Controllers\HomeContoller;
use Mariojgt\Firetakeaway\Controllers\OrderController;
use Mariojgt\Firetakeaway\Controllers\StatusController;
use Mariojgt\Firetakeaway\Controllers\ProductController;
use Mariojgt\Firetakeaway\Controllers\DashboardController;
use Mariojgt\Firetakeaway\Controllers\Auth\LoginController;
use Mariojgt\Firetakeaway\Controllers\Api\OrderApiController;
use Mariojgt\Firetakeaway\Controllers\Api\ProductApiController;

// Standard
Route::group([
    'middleware' => ['web']
], function () {
    // Example page not required to be login
    Route::get('/firetakeaway', [HomeContoller::class, 'index'])->name('firetakeaway');
});

// Auth Route
Route::group([
    'middleware' => ['web', 'auth', 'verified'],
], function () {
    // Logout function
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Example page required to be login
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Products Crud
    Route::resource('product', ProductController::class)->except('destroy');
    Route::get('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');

    // Status Crud
    Route::resource('status', StatusController::class)->except('destroy');
    Route::get('/status/delete/{status}', [StatusController::class, 'destroy'])->name('status.delete');

    // Order Crud
    Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/delete/{order}', [OrderController::class, 'destroy'])->name('order.delete');

    // Api Order Stuff
    // Api Product Search
    Route::post('/api/product/search', [ProductApiController::class, 'productSearch'])
        ->name('api.product.seach');
    // Order Store
    Route::post('/api/order/create', [OrderApiController::class, 'orderCreate'])
        ->name('api.order.create');
    // New Orders
    Route::get('/api/order/new', [OrderApiController::class, 'newOrders'])
        ->name('api.order.new');
    // Order Orders
    Route::get('/api/order/old', [OrderApiController::class, 'oldOrders'])
        ->name('api.order.old');
    // Api Order Delete
    Route::post('/api/order/delete/{id}', [OrderApiController::class, 'destroy'])
        ->name('api.order.delete');
    // Read for collection Order
    Route::post('/api/order/complete', [OrderApiController::class, 'confirmOrder'])
        ->name('api.order.complete');
});
