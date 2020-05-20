<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lampiran;
use App\peserta;
use App\Exports\pesertaExport;
use App\Mail\NotifPendaftaranPeserta;
use Excel;
use App\sekolah;
use Session;

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

            if(Auth::check() && Auth::User()->level() == 'guru'){
                $user_login = Auth()->User()->id;
                $sekolah = sekolah::where('user_id', $user_login)->firstOrFail();
                $peserta_sekolah = $peserta->where('sekolah_id', $sekolah->id);
                return view('peserta.peserta', compact('peserta_sekolah', 'halaman'));
            }
            
        }
        return view('peserta.peserta', compact('peserta', 'halaman'));
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

    public function export(){
        $peserta = peserta::all();
        return Excel::download(new pesertaExport, 'peserta.xls');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post($id)
    {
        $lampiran = lampiran::findOrFail($id);
        $lampiran->acc = 'terima';
        $lampiran->save();

        $peserta = new peserta;
        $peserta->lampiran_id = $lampiran->id;
        $peserta->save();

        \Mail::to('mahfuzon0@gmail.com')->send(new NotifPendaftaranPeserta);

        Session::flash('sukses_tambah', 'User berhasil dibuat');
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
        $peserta = peserta::findOrFail($id);
        $mulai = date('Y-m-d');
        $halaman = 'peserta';
        return view('peserta.edit', compact('halaman', 'peserta', 'mulai'));
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
    
        $peserta = peserta::findOrFail($id);
        $lampiran = lampiran::where('id', $peserta->lampiran_id)->firstOrFail();
        $lampiran->nama_peserta = $request->nama_peserta;
        $lampiran->email_peserta = $request->email_peserta;
        $lampiran->mulai = $request->mulai;
        $lampiran->selesai = $request->selesai;
        $lampiran->save();

        Session::flash('sukses_edit', 'Data berhasil di update');
        return redirect('/peserta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peserta = peserta::findOrFail($id);
        $peserta->delete();
        Session::flash('sukses_hapus', 'Peserta Berhasil di Hapus');
        return redirect('/peserta');
    }
}
