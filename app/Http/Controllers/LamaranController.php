<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lampiran;
use Validator;

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
            'selesai' => 'required|date'
        ]);

        if($validator->fails()){
            return redirect ('/daftar')->withInput()->withErrors($validator);
        }

        $now = time();
        $mulai = strtotime($request->mulai);
        $selesai = strtotime($request->selesai);
        $selisih = ($selesai - $mulai)/86400;
        if($mulai < $now || $selesai < $now){
            return redirect('/daftar');
        }else if($selisih < 60){  
            return redirect('/daftar');
        }else{
            lampiran::create($input);
        }
        return redirect('/lamaran');
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
