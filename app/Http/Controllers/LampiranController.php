<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
use Validator;
use Session;
use Storage;
use Auth;
use App\Cv;
use App\sekolah;

class LampiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaman = "lampiran";
        if(Auth()->User()->level == 'guru'){
            $id = Auth()->User()->id;
            $sekolah = sekolah::where('user_id',$id)->firstOrFail();
            $lampiran = lampiran::where('asal_sekolah', $sekolah->nama_sekolah)->get();
            return view('lampiran.lamaran', compact('halaman','lampiran'));
        }else{
            $lampiran = lampiran::all();
            return view('lampiran.lamaran', compact('halaman', 'lampiran'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $halaman = 'lampiran';
        if(Auth::check() && Auth()->user()->level == 'guru'){
            return view('lampiran.tambah', compact('halaman'));
        }

        return view('lampiran.daftar');
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
                'nama_peserta' => 'required|string|max:30',
                'email_peserta' => 'required|email|unique:lampiran',
                'mulai' => 'required|date',
                'selesai' => 'required|date',
                'cv' => 'required',
            ]);
        }else{
            $validator = Validator::make($input, [
                'nama_peserta' => 'required|string|max:30',
                'asal_sekolah' => 'required|string',
                'email_peserta' => 'required|email|unique:lampiran',
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
                $lampiran->nama_peserta = $request->nama_peserta;
                if(Auth::check() && Auth()->user()->level == 'guru'){
                    $user_login = Auth()->User()->email;
                    $sekolah = sekolah::where('email_guru', $user_login)->first();
                    $lampiran->asal_sekolah = $sekolah->nama_sekolah;
                }else{
                    $lampiran->asal_sekolah = $request->asal_sekolah;
                }
                $lampiran->email_peserta = $request->email_peserta;
                $lampiran->mulai = $request->mulai;
                $lampiran->selesai = $request->selesai;  
                $lampiran->acc = 'waiting';
                $lampiran->save();

                $cv = new Cv;
                $name = $request->file('cv')->getClientOriginalName();
                $path = $request->file('cv')->storeAs('cv',$name);
                $cv->cv = $name;
                $lampiran->cv()->save($cv);
                if(Auth::check()){
                    if(Auth::user()->level == 'guru'){
                        Session::flash('sukses_tambah', 'Pendaftaran Berhasil');
                        return redirect('/lamaran'); 
                    }
                }else{
                    Session::flash('berhasil_daftar', 'Pendaftaran Berhasil Komfirmasi Akan Dikirim Via Email'); 
                    return redirect('/daftar');
                }
        }
        
    }

    public function download($id)
    {   
        $lampirans = lampiran::all();
        $lampiran = $lampirans->find($id);
        return Storage::download('cv/'.$lampiran->cv->cv);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolak($id)
    {
        $lampiran = lampiran::findOrFail($id);
        $lampiran->acc = 'tolak';
        $lampiran->save();
        Session::flash('sukses_hapus', 'lamaran di tolak');
        return redirect('/lamaran');
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
        $lampiran = lampiran::find($id);
        Storage::delete('cv/'.$lampiran->cv->cv);
        $lampiran->delete();
        Session::flash('sukses_hapus', 'data berhasil di hapus');
        return redirect('/lamaran');
    }
}
