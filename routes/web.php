<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/items/search-ajax', [ItemController::class, 'searchAjax'])->name('items.search-ajax');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('items', ItemController::class);
    Route::post('/items/{item}/claim', [ItemController::class, 'claim'])->name('items.claim');
    Route::post('/items/{item}/admin-action', [ItemController::class, 'adminAction'])->name('items.admin-action');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/items', [AdminController::class, 'items'])->name('admin.items');
    Route::post('/users/{user}/suspend', [AdminController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{user}/restore', [AdminController::class, 'restore'])->name('admin.users.restore');
    Route::delete('/items/{item}', [AdminController::class, 'deleteItem'])->name('admin.items.delete');
    Route::post('/claims/{claim}', [AdminController::class, 'claimDecision'])->name('admin.claims.update');
});

require __DIR__.'/auth.php';
