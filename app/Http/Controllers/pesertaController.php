<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lampiran;
use App\peserta;
use App\Exports\pesertaExport;
use App\Mail\NotifikasiPendaftaranPeserta;
use Excel;
use App\sekolah;
use Session;
use Auth;

class pesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaman = 'peserta';
        if(Auth::check() && Auth::User()->level == 'guru'){
            $login = Auth()->User()->id;
            $sekolah = sekolah::where('user_id', $login)->firstOrFail();
            $peserta = peserta::where('sekolah_id', $sekolah->id)->get();
        }else{
            $peserta = peserta::all();
        }
        return view('peserta.peserta', compact('halaman', 'peserta'));
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
        if(Auth::check() && Auth::user()->level == 'guru'){
            $sekolah = sekolah::where('user_id', Auth()->user()->id)->firstOrFail();
            $peserta->sekolah_id = $sekolah->id;
        }
        $peserta->nama_peserta = $lampiran->nama_peserta;
        $peserta->asal_sekolah = $lampiran->asal_sekolah;
        $peserta->email_peserta = $lampiran->email_peserta;
        $peserta->mulai = $lampiran->mulai;
        $peserta->selesai = $lampiran->selesai;
        $peserta->save();
        $terima = 1;
        \Mail::to($peserta->lampiran->email_peserta)->send(new NotifikasiPendaftaranPeserta($terima));

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

    public function cari(Request $request){
        $cari = $request->cari;
        $halaman  = 'peserta';
        $peserta = peserta::where("nama_peserta", "LIKE", "%".$cari."%")
                            ->orWhere('asal_sekolah', 'LIKE', '%'.$cari.'%')
                            ->orWhere('email_peserta', 'LIKE', '%'.$cari.'%')
                            ->orWhere('mulai', 'LIKE', '%'.$cari.'%')
                            ->orWhere('selesai', 'LIKE', '%'.$cari.'%')
                            ->get();
        return view('peserta.peserta', compact('halaman', 'peserta'));
    }
}
