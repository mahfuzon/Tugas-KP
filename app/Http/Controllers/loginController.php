<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class loginController extends Controller
{
    public function logout(){
        Auth::logout();
    }
}
