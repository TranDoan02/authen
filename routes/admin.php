<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Reviews
    Route::get('reviews/bulk-create', [ReviewController::class, 'bulkCreate'])->name('reviews.bulk-create');
    Route::post('reviews/bulk-store', [ReviewController::class, 'bulkStore'])->name('reviews.bulk-store');
    Route::patch('reviews/{review}/toggle-approval', [ReviewController::class, 'toggleApproval'])->name('reviews.toggle-approval');
    Route::resource('reviews', ReviewController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Posts
    Route::resource('posts', PostController::class);

    // Banners
    Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
});

