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
        $lampiran = lampiran::all();
        $user = User::all();
        $halaman = 'peserta';
        $now = date('Y-m-d');
        $lampiran_keluar = $lampiran->where('selesai','<=' , $now);
        foreach ($lampiran_keluar as $l) {
            $peserta_keluar = $peserta->where('lampiran_id', $l->id);
            foreach($peserta_keluar as $p){
                $p->delete();
            }

            $user_off = $user->where('peserta_id', $l->id);
            foreach($user_off as $u){
                $u->delete();
            }
            
        }

        return view('/peserta', compact('peserta', 'halaman'));
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

        $peserta = new peserta;
        $peserta->lampiran_id = $lampiran->id;
        $peserta->save();

        $user = new User;
        $user->peserta_id = $lampiran->id;
        $user->email = $lampiran->email_peserta;
        $user->password = bcrypt('12345');
        $user->level = 'peserta';
        $user->save();

        return redirect('/peserta');
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
