<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\lampiran;
use App\peserta;

class loginController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
