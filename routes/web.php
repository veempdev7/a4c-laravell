<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAppController;

Route::get('login', [LoginAppController::class, 'showLoginForm'])->name('loginapp.show');  // Shows the login form
Route::post('login', [LoginAppController::class, 'login'])->name('loginapp.login');  // Processes the login
Route::post('logout', [LoginAppController::class, 'logout'])->name('loginapp.logout');  // Handles logout


Route::get('/', function () {
    // Check if the user is authenticated using the 'loginapp' guard
    if (Auth::guard('loginapp')->check()) {
        return view('welcome');  // Show the welcome page if the user is logged in
    }

    // Redirect to the login page if the user is not authenticated
    return redirect()->route('loginapp.show');  // Redirect to login page
})->name('home');