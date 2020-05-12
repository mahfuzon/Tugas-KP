<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
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
        $halaman = "lamaran";
        if(Auth()->User()->level == 'guru'){
            $id = Auth()->User()->id;
            $sekolah = sekolah::findOrFail($id);
            $lampiran = lampiran::where('asal_sekolah', $sekolah->nama_sekolah)->get();
            return view('lamaran', compact('halaman','lampiran'));
        }
        $lampiran = lampiran::all();
        return view('lamaran', compact('halaman', 'lampiran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
                'nama_peserta.*' => 'required|string|max:30',
                // 'asal_sekolah.*' => 'required|string',
                'email_peserta.*' => 'required|email',
                'mulai.*' => 'required|date',
                'selesai.*' => 'required|date',
                'cv.*' => 'required',
            ]);
        }else{
            $validator = Validator::make($input, [
                'nama_peserta' => 'required|string|max:30',
                // 'asal_sekolah' => 'required|string',
                'email_peserta' => 'required|email',
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
            if(Auth::check() && Auth()->User()->level == 'guru'){
                for($i=0; $i<count($mulai_daftar);$i++){
                    $mulai = strtotime($request->mulai[$i]);
                    $selesai = strtotime($request->selesai[$i]);
                }
            }else{
                $mulai = strtotime($request->mulai);
                $selesai = strtotime($request->selesai);
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
                    $user_login = Auth()->User()->email;
                    $sekolah = sekolah::where('email_guru', $user_login)->first();

                    $nama_peserta = $request->nama_peserta;
                    // $asal_sekolah = $request->asal_sekolah;
                    $email_peserta = $request->email_peserta;
                    $mulai = $request->mulai;
                    $selesai = $request->selesai;
                    $input = $request->file('cv');

                    for($i = 0; $i<count($nama_peserta); $i++){
                        $lampiran = new lampiran;
                        $lampiran->nama_peserta = $nama_peserta[$i];
                        $lampiran->asal_sekolah = $sekolah->nama_sekolah;
                        $lampiran->email_peserta = $email_peserta[$i];
                        $lampiran->mulai = $mulai[$i];
                        $lampiran->selesai = $selesai[$i];
                        $lampiran->acc = 0;
                        $extensi = $input[$i]->getClientOriginalExtension();
                        $nama_cv = date('Y-M-d-H-i-s'). ".$extensi";
                        $penyimpanan = 'cv_peserta';
                        $input[$i]->move($penyimpanan, $nama_cv);
                        $lampiran->cv = $nama_cv;
                        $lampiran->save();
                    }
                Session::flash('berhasil_daftar', 'Pendaftaran Berhasil Komfirmasi Akan Dikirim Via Email');
                return redirect('/daftar');
        }else{
            $lampiran = new lampiran;

                // cv
                $cv = $request->file('cv');
                $extensi = $cv->getClientOriginalExtension();
                $nama = date('Y-M-d-H-i-s'). " $request->nama". ".$extensi";
                $penyimpanan = 'cv_peserta';
                $cv->move($penyimpanan, $nama);
                $lampiran->cv = $nama;


                $lampiran->nama_peserta = $request->nama_peserta;
                $lampiran->asal_sekolah = $request->asal_sekolah;
                $lampiran->email_peserta = $request->email_peserta;
                $lampiran->mulai = $request->mulai;
                $lampiran->selesai = $request->selesai;  
                $lampiran->acc = 0;
                $lampiran->save();
            }
        Session::flash('berhasil_daftar', 'Pendaftaran Berhasil Komfirmasi Akan Dikirim Via Email');    
        return redirect('/daftar');
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
        $lampiran = lampiran::findOrFail($id);
        $lampiran->delete();
        Session::flash('sukses_hapus', 'data berhasil di hapus');
        return redirect('/lamaran');
    }
}
