<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // COMMENT: This function handles the Registration logic
    public function register(Request $request)
    {
        // 1. Validation: Checks if the input is correct
        $request->validate([
            'email' => [
                'required',
                'email',
                'ends_with:umindanao.edu.ph', // Only UM emails are allowed
                'unique:users' // Email must not be already registered
            ],
            'password' => 'required|min:6', // Password must be at least 6 characters
        ]);

        // 2. Creation: Saves the new user to the 'users' table
        $user = User::create([
            'name' => 'User', // Default name
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypts the password for security
            'role' => 'user', // Default role for new sign-ups
        ]);

        // 3. Login: Automatically log in the user after registering
        Auth::login($user);

        // 4. Redirect: Send the user to their respective dashboard
        return $this->redirectBasedOnRole($user);
    }

    // COMMENT: This function handles the Login logic
    public function login(Request $request)
    {
        // 1. Validate: Ensure the user provided email and password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Attempt: Check if the email and password match our database records
        if (Auth::attempt($credentials)) {
            // Success: Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to dashboard based on their role (Admin or User)
            return $this->redirectBasedOnRole(Auth::user());
        }

        // 3. Fail: If credentials don't match, send back an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // Keeps the email in the input box for convenience
    }

    // COMMENT: Helper function to determine where the user goes after logging in
    private function redirectBasedOnRole($user)
    {
        // If the user's role is 'admin', send to admin dashboard
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Otherwise, send to regular user dashboard
        return redirect()->route('dashboard');
    }
}