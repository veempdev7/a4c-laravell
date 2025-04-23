<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            
            $posts = DB::table('posts')
            ->where('is_publish', 1)
            ->orderBy('date', 'desc')
            ->get(); 
            
            return view('welcome', compact('posts'));
        }

        // Redirect to the login page if the user is not authenticated
        return redirect()->route('/');
    }
}
