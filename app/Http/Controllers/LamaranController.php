<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
use Validator;
use Session;
use Storege;

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
        $input = $request->all();

        // Validator
        $validator = Validator::make($input, [
            'nama' => 'required|string|max:30',
            'asal_sekolah' => 'required|string',
            'email' => 'required|email',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'cv' => 'required'
        ]);

        if($validator->fails()){
            return redirect ('/daftar')->withInput()->withErrors($validator);
        }

        $date = date('Y-m-d');
        $mulai_daftar = $request->mulai;
        $selesai_kp = $request->selesai;
        $now = time();
        $mulai = strtotime($request->mulai);
        $selesai = strtotime($request->selesai);
        $selisih = ($selesai - $mulai)/86400;
        if($mulai_daftar < $date || $selesai_kp < $date){
            Session::flash('flash_message', 'inputkan tanggal yang sesuai');
            return redirect('/daftar')->withInput();
        }else if($selisih < 60){  
            Session::flash('flash_message', 'Magang minimal 2 bulan');
            return redirect('/daftar')->withInput();
        }else{
            $lampiran = new lampiran;

            // cv
            $cv = $request->file('cv');
            $extensi = $cv->getClientOriginalExtension();
            $nama = date('Y-M-d-H-i-s'). " $request->nama". ".$extensi";
            $penyimpanan = 'cv_peserta';
            $cv->move($penyimpanan, $nama);
            $lampiran->cv = $nama;


            $lampiran->nama = $request->nama;
            $lampiran->asal_sekolah = $request->asal_sekolah;
            $lampiran->email = $request->email;
            $lampiran->mulai = $request->mulai;
            $lampiran->selesai = $request->selesai;  
            $lampiran->acc = 0;
            $lampiran->save();
        }
        return redirect('/login');
    }

    public function download($id)
    {   
        $lampirans = lampiran::all();
        $lampiran = $lampirans->find($id);
        $file = public_path(). '/cv_peserta/' . $lampiran->cv;
        return response()->download($file, $lampiran->cv);
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
