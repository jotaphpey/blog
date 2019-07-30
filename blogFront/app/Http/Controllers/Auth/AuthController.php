<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(){

        return view('auth.login');
    }

    public function register(){

        return view('auth.register');
    }
}
