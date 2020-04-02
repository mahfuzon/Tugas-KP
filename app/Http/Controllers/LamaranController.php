<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
use Validator;
use Session;
use Storege;
use Auth;

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
        if(Auth::check() && Auth::user()->level == 'guru'){
            return Auth::user()->level;
        }
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
            if(Auth::check() && Auth::user()->level == 'guru'){
                $lampiran1 = new lampiran;
                $cv1 = $request->file('cv1');
                $extensi1 = $cv1->getClientOriginalExtension();
                $nama1 = date('Y-M-d-H-i-s'). " $request->nama1". ".$extensi1";
                $penyimpanan1 = 'cv_peserta';
                $cv1->move($penyimpanan1, $nama1);
                $lampiran1->cv = $nama1;

                $lampiran1->nama = $request->nama1;
                $lampiran1->asal_sekolah = $request->asal_sekolah;
                $lampiran1->email = $request->email1;
                $lampiran1->mulai = $request->mulai;
                $lampiran1->selesai = $request->selesai;  
                $lampiran1->acc = 0;
                $lampiran1->save();

                $lampiran2 = new lampiran;
                // cv
                $cv2 = $request->file('cv2');
                $extensi2 = $cv->getClientOriginalExtension();
                $nama2 = date('Y-M-d-H-i-s'). " $request->nama2". ".$extensi2";
                $penyimpanan2 = 'cv_peserta';
                $cv2->move($penyimpanan2, $nama2);
                $lampiran2->cv = $nama2;

                $lampiran2->nama = $request->nama2;
                $lampiran2->asal_sekolah = $request->asal_sekolah;
                $lampiran2->email = $request->email2;
                $lampiran2->mulai = $request->mulai;
                $lampiran2->selesai = $request->selesai;  
                $lampiran2->acc = 0;
                $lampiran2->save();
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
