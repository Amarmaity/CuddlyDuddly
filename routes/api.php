<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration\RegistrationController;


Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [RegistrationController::class, 'apiLogin']);
Route::post('/logout', [RegistrationController::class, 'apiLogout']);
