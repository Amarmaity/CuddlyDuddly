<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration\RegistrationController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [RegistrationController::class, 'index'])->name('home.landing');
Route::get('/view-register', [RegistrationController::class, 'viewRegister'])->name('register');
Route::get('/view-login', [RegistrationController::class, 'viewLogin'])->name('login');
Route::get('/seller-register', [RegistrationController::class, 'sellerRegister'])->name('seller');
