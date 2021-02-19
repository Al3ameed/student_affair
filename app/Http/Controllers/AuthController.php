<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index () {
        return view('login');
    }

    public function login (Request $request) {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('home');
        }
        return redirect()->back()->withErrors(['error' => 'invalid email or password']);
    }

    public function logout () {
        Auth::logout();
        return view('login');
    }

}
