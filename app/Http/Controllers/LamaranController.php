<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lampiran = lampiran::all();
        $halaman = "lamaran";
        return view('lamaran', compact('halaman','lampiran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('daftar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = date('d-F-Y');
        $mulai = date('d-F-Y', strtotime($request->mulai));
        $selesai = date('d-F-Y', strtotime($request->selesai));
        $selisih = $mulai->diff($selesai);
        if($mulai < $now || $selesai < $now){
            return redirect('/daftar');
        }else if($selisih < 60){  
            return redirect('/daftar');
        }else{
            $lampiran = new lampiran;
            $lampiran->nama = $request->nama;
            $lampiran->asal_sekolah = $request->asal_sekolah;
            $lampiran->email = $request->email;
            $lampiran->mulai = $request->mulai;
            $lampiran->selesai = $request->selesai;  
            $lampiran->acc = 0;
            $lampiran->save();
        }
        return  redirect('/lamaran');
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
