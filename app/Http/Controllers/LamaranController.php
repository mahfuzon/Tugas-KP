<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
use App\cv;
use Validator;
use Session;
use Storege;
use Auth;
use App\sekolah;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cv = cv::all();
        $lampiran = lampiran::all();
        $halaman = "lamaran";
        return view('lamaran', compact('halaman','lampiran','cv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sekolah = sekolah::pluck('nama', 'id');
        if(Auth::check() && Auth::user()->level == 'guru'){
            return view('daftar_guru', compact('sekolah'));
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
        if(Auth::check() && Auth::user()->level == 'guru'){
            $validator = Validator::make($input, [
                'nama.*' => 'required|string|max:30',
                'asal_sekolah.*' => 'required|string',
                'email.*' => 'required|email',
                'mulai.*' => 'required|date',
                'selesai.*' => 'required|date',
                'cv.*' => 'required',
            ]);
        }else{
            $validator = Validator::make($input, [
                'nama' => 'required|string|max:30',
                'asal_sekolah' => 'required|string',
                'email' => 'required|email',
                'mulai' => 'required|date',
                'selesai' => 'required|date',
                'cv' => 'required',
            ]);
        }

        if($validator->fails()){
            return redirect ('/daftar')->withInput()->withErrors($validator);
        }

           // lampiran
            $date = date('Y-m-d');
            $mulai_daftar = $request->mulai;
            $selesai_kp = $request->selesai;
            $now = time();
            for($i=0; $i<count($mulai_daftar);$i++){
                $mulai = strtotime($request->mulai[$i]);
                $selesai = strtotime($request->selesai[$i]);
            }
            $selisih = ($selesai - $mulai)/86400;
            if($mulai_daftar < $date || $selesai_kp < $date){
                Session::flash('flash_message', 'inputkan tanggal yang sesuai');
                return redirect('/daftar')->withInput();
            }else if($selisih < 60){  
                Session::flash('flash_message', 'Magang minimal 2 bulan');
                return redirect('/daftar')->withInput();
            }else{
                if(Auth::check() && Auth::user()->level == 'guru'){
                    $lampiran = new lampiran;
                    $nama = $request->nama;
                    $asal_sekolah = $request->asal_sekolah;
                    $email = $request->email;
                    $mulai = $request->mulai;
                    $selesai = $request->selesai;  

                    for($i = 0; $i<count($nama); $i++){
                        $data = array(
                            'nama' => $nama[$i],
                            'asal_sekolah' => $asal_sekolah[$i],
                            'email' => $email[$i],
                            'mulai' => $mulai[$i],
                            'selesai' => $selesai[$i],
                            'acc' => 0
                        );
                        $insert[] = $data;
                    }
                    lampiran::insert($insert);

        // cv
        if($request->hasfile('cv'))
        {
            $cv = $request->file('cv');
            for($i=0; $i<count($cv); $i++)
            {
                $extensi = $cv[$i]->getClientOriginalExtension();
                $nama_cv = date('Y-M-d-H-i-s'). ".$extensi";
                $penyimpanan = 'cv_peserta';
                $cv[$i]->move($penyimpanan, $nama_cv);
                $f = new cv;
                $f->cv = $nama_cv;
                $f->save();
            } 
        }  
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
