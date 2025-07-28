<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Memberitahu Laravel untuk menggunakan 'username' saat login.
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Mencoba login ke kedua guard.
     */
    protected function attemptLogin(Request $request)
    {
        if (Auth::guard('web')->attempt($this->credentials($request))) {
            return true;
        }

        if (Auth::guard('pelanggan')->attempt($this->credentials($request))) {
            return true;
        }

        return false;
    }

    /**
     * Mengarahkan setelah login berhasil.
     */
    protected $redirectTo = '/home';

    /**
     * Memastikan logout dari semua guard.
     */
    public function logout(Request $request)
    {
        if(Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif(Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}