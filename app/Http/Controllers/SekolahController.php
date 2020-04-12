<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sekolah;
use Session;
use Validator;
class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sekolah = sekolah::all();
        $halaman = 'sekolah';
        return view('sekolah.sekolah', compact('sekolah', 'halaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $halaman = 'sekolah';
        return view('sekolah.tambah', compact('halaman'));
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

          // validasi
          $validator = Validator::make($input, [
            'nama_sekolah' => 'required|string',
            'nama_guru' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'email_guru' => 'required|email|unique:sekolah',
            'no_telepon_sekolah' => 'required|numeric|unique:sekolah'
        ]);

        if($validator->fails()){
            return redirect('/sekolah/create/')->withInput()->withErrors($validator);
        }


        sekolah::create($input);
        Session::flash('sukses_tambah', 'data berhasil di tambahkan');
        return redirect('/sekolah');
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
        $sekolah = sekolah::findOrFail($id);
        $halaman = 'sekolah';
        return view('sekolah.edit', compact('sekolah', 'halaman'));
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
        $input = $request->all();
        // validasi
        $validator = Validator::make($input, [
            'nama_sekolah' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'email_sekolah' => 'required|email|unique:sekolah,email_sekolah,'.$id,
            'no_telepon_sekolah' => 'required|numeric|unique:sekolah,no_telepon_sekolah,'.$id
        ]);

        if($validator->fails()){
            return redirect('/sekolah/edit/'.$id)->withInput()->withErrors($validator);
        }

        $sekolah = sekolah::findOrFail($id);
        $sekolah->update($request->all());
        Session::flash('sukses_edit', 'Data Berhasil di Update');
        return redirect('/sekolah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = sekolah::findOrFail($id);
        $sekolah->delete();
        Session::flash('sukses_hapus', 'data berhasil di hapus');
        return redirect('/sekolah');
    }
}
