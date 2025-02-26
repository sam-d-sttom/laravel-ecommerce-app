<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * SShow user login form
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * login logic
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate user credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get validated credentials
        $credentials = $validator->validated();

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Determine guard based on role
            $guard = $user->role === 'admin' ? 'admin' : 'web';

            // Attempt login using guard
            if (Auth::guard($guard)->attempt($credentials)) {
                $request->session()->regenerate(); // Secure the session

                return redirect()->intended($user->role === 'admin' ? '/dashboard' : '/');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }


    /**
     * Summary of logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout Admin
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }

        // Logout normal user
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    /**
     * show user registration form
     * @return \Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    /**
     * Registration logic
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get validated data
        $validatedData = $validator->validated();

        // Create a new user with default "user" role
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'user',
        ]);

        // Auto login user after registration
        Auth::login($user);

        return redirect('/');
    }
}
