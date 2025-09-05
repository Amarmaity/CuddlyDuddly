<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\Vendor\VendorController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [RegistrationController::class, 'index'])->name('home.landing');
Route::get('/view-register', [RegistrationController::class, 'viewRegister'])->name('register');
Route::get('/view-login', [RegistrationController::class, 'viewLogin'])->name('login');
Route::get('/seller-register', [RegistrationController::class, 'sellerRegister'])->name('seller');
// Route::get('/admin/{id}/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/vendor/{id}/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
// Route::get('/customer/{id}/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
