<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;

// Landing Page / Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// --- AUTHENTICATION ROUTES ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- PROTECTED ROUTES (Dapat naka-login ang user) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Page Route
    Route::get('/profile', function() { return view('profile'); })->name('profile');

    // Transaction Routes
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // Category Routes (Inayos ang pangalan para maging 'categories' para tugma sa navbar.blade.php mo)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::post('/profile/update-picture', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update_picture');

});