<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerRequestController;
use App\Http\Controllers\HotelController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trip routes
Route::resource('trips', TripController::class);

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Owner request routes
    Route::post('/owner-requests', [OwnerRequestController::class, 'store'])->name('owner-requests.store');

    // Contact host route
    Route::post('/hotels/{hotel}/contact', [HotelController::class, 'contact'])->name('hotels.contact');
    Route::post('/messages/{message}/reply', [HotelController::class, 'reply'])->name('messages.reply');
});

// Comment routes
Route::post('/trips/{trip}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Hotel routes
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/owner-dashboard', [HotelController::class, 'ownerDashboard'])->name('hotels.owner-dashboard');
Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::get('/admin/owner-requests/{ownerRequest}', [OwnerRequestController::class, 'show'])->name('owner-requests.show');
    Route::post('/owner-requests/{ownerRequest}/approve', [OwnerRequestController::class, 'approve'])->name('owner-requests.approve');
    Route::delete('/owner-requests/{ownerRequest}', [OwnerRequestController::class, 'reject'])->name('owner-requests.reject');
});
