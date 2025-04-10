<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Check if the user is authenticated using the 'loginapp' guard
        if (Auth::guard('loginapp')->check()) {
            // Show the welcome page if the user is logged in
            return view('welcome');
        }

        // Redirect to the login page if the user is not authenticated
        return redirect()->route('login');
    }
}
