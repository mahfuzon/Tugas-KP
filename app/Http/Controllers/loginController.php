<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class loginController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
