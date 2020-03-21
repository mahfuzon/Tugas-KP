<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\lampiran;

class loginController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function postAccount($id){
        $lampirans = lampiran::all();
        $lampiran = $lampirans->find($id);
        User::create([
            'name' => $lampiran->nama,
            'email' => $lampiran->email,
            'password' => Hash::make('12345'),
            'level' => 'siswa'
        ]);
        return redirect('/home');
    }
}
