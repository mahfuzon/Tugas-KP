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

    public function postAccount($id){
        $lampirans = lampiran::all();
        $lampiran = $lampirans->find($id);
        $lampiran->acc = 1;
        $lampiran->save();
        peserta::create([
            'lampiran_id' => $lampiran->id,
        ]);
        return redirect('/home');
    }

    public function index(){
        
    }
}
