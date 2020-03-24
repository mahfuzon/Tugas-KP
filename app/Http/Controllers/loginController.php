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
        $lampiran->acc = 1;
        $lampiran->save();
        User::create([
            'name' => $lampiran->nama,
            'email' => $lampiran->email,
            'password' => Hash::make('12345'),
            'level' => 'siswa'
        ]);
        return redirect('/home');
    }

    public function index(){
        $user = User::all();
        $halaman = 'peserta';
        $now = date('Y-m=d');
        $keluar = User::where('selesai', $now)->get();
        foreach($keluar as $kel){
            $kel->delete();
        }

        // return view('/peserta');
        return view('peserta', compact('user'));
    }
}
