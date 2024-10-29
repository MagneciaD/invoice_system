<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Assuming the login form is stored in 'auth.login'
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user with email and password
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerate the session to avoid session fixation attacks
            $request->session()->regenerate();

            // Redirect to the intended page or dashboard
            return redirect()->intended('dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate the token to prevent CSRF attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
