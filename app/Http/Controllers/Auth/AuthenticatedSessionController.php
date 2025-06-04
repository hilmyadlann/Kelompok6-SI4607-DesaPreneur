<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'identifier' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $field = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

    $user = Auth::attempt([$field => $credentials['identifier'], 'password' => $credentials['password']]);

    if ($user) {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return redirect()->intended('/admin');
        } elseif ($role == 'pengurus') {
            return redirect()->intended('/pengurus');
        } else {
            return redirect()->intended('/dashboard');
        }
    }
    
    return back()->withErrors([
        'identifier' => 'The provided credentials do not match our records.',
    ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
    
