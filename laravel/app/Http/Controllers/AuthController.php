<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('authenticated')) {
            return redirect()->route('products.index');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['authenticated' => true, 'username' => 'admin']);
            
            return redirect()->route('products.index')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['login' => 'Credenciais inválidas.'])->withInput();
    }

    public function logout(Request $request)
    {
        session()->forget(['authenticated', 'username']);
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }
}
