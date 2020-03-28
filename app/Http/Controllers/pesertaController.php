<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lampiran;
use App\peserta;

class pesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peserta = peserta::all();
        $halaman = 'peserta';
        $now = date('Y-m=d');
        $peserta_keluar = peserta::where('selesai', $now)->get();
        foreach ($peserta_keluar as $p) {
            $p->delete();
            User::where('id', $p->user_id)->delete();
        }
        return view('peserta', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post($id)
    {
        $lampirans = lampiran::all();
        $lampiran = $lampirans->find($id);
        $lampiran->acc = 1;
        $lampiran->save();

        $user = new \App\User;
        $user->name = $lampiran->nama;
        $user->email = $lampiran->email;
        $user->password = bcrypt('12345');
        $user->level = 'admin';
        $user->save();

        peserta::create([
            'user_id' => $user->id,
            'nama' => $lampiran->nama,
            'asal_sekolah' => $lampiran->asal_sekolah,
            'email' => $lampiran->email,
            'mulai' => $lampiran->mulai,
            'selesai' => $lampiran->selesai,
            'lampiran_id' => $lampiran->id
        ]);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
