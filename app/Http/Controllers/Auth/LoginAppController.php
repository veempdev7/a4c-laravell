<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Helpers\OtpHelper;


class LoginAppController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
{
     if (Auth::guard('loginapp')->check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
}


    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    // Validate the incoming request data (username and password)
    $request->validate([
        'kt_login_user' => 'required|string',
        'kt_login_password' => 'required|string',
        'a4c_verify_otp' => 'nullable|string',
    ]);

    // Map the form fields to the database columns
    $username = $request->kt_login_user;
    $password = $request->kt_login_password;
    $otp = $request->a4c_verify_otp;

    if (!OtpHelper::isValidOtp($otp, $username)) {
        throw ValidationException::withMessages([
            'a4c_verify_otp' => ['Invalid or expired OTP.'],
        ]);
    }
    // Retrieve the user based on the username
    $user = LoginApp::where('login_username', $username)
                    ->where('is_website', 1)
                    ->where('is_deleted', '0')
                    ->whereIn('siteuser', [0, 2]) // Ensure the user is either 'siteuser' 0 or 2
                    ->whereNotIn('siteuser', [3, 4]) // Exclude 'siteuser' 3 or 4
                    ->where('block_website_user', 0)
                    ->first();

    // If the user does not exist
    if (!$user) {
        throw ValidationException::withMessages([
            'kt_login_user' => ['These credentials do not match our records or the account is not eligible to log in.'],
        ]);
    }

    // Optionally, check if the `end_date` is greater than the current date if applicable
    if (isset($user->end_date) && $user->end_date <= now()) {
        throw ValidationException::withMessages([
            'kt_login_user' => ['Your account has expired.'],
        ]);
    }

    // Directly compare the plain-text password with the stored one (without hashing)
    if ($password !== $user->login_password) {
        throw ValidationException::withMessages([
            'kt_login_password' => ['The provided password is incorrect.'],
        ]);
    }
    
    // If everything is okay, authenticate the user
    Auth::guard('loginapp')->login($user);

    return redirect()->route('home');
}


    /**
     * Handle logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Log out the user
        Auth::guard('loginapp')->logout(); 
        // Redirect to the login page
        return redirect('/login');
    }
}
