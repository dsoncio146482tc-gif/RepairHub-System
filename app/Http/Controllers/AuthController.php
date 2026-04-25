<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Kani para sa Registration
    public function register(Request $request)
    {
        $request->validate([
            'email' => [
                'required', 
                'email', 
                'ends_with:umindanao.edu.ph', 
                'unique:users'
            ],
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => 'User', 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole($user);
    }

    //  Para sa Login
    public function login(Request $request)
    {
        // 1. I-validate ang login input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Sulayan og login ang user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return $this->redirectBasedOnRole(Auth::user());
        }

        // 3. Kung mali ang email o password, balik sa login page nga naay error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Helper function para sa redirect logic para dili balik-balik ang code
    private function redirectBasedOnRole($user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
}