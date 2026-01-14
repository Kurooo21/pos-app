<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Cart Actions
    Route::post('/cart/add/{id}', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/decrease/{id}', [OrderController::class, 'decreaseCart'])->name('cart.decrease');
    Route::get('/cart/print', [OrderController::class, 'printCart'])->name('cart.print');
    Route::post('/orders/clear', [OrderController::class, 'clearSession'])->name('orders.clear');
    Route::get('/cart/remove/{id}', [OrderController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');

    // Resources
    Route::resource('menus', MenuController::class);
    Route::resource('notes', NoteController::class)->except(['create', 'edit', 'show']); // Notes now acts as Sales Report
    Route::resource('stocks', StockController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/avatar', [SettingController::class, 'removeAvatar'])->name('settings.remove_avatar');
});
