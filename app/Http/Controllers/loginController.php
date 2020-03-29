<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
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
