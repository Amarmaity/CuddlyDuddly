<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration\RegistrationController;


Route::post('/register', [RegistrationController::class, 'register']);
