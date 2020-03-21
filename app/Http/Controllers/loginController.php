<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use User;

class loginController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function postAccount(Request $request){
    $input = $request->all();
    return User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make('12345'),
    ]);

    }
}
