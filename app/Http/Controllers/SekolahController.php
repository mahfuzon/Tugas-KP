<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sekolah;
use Session;
use Validator;
use App\User;
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
            'guru_pembimbing' => 'required|string',
            'alamat' => 'required|string',
            'email_guru' => 'required|email|unique:sekolah',
            'hp_guru' => 'required|numeric|unique:sekolah'
        ]);

        if($validator->fails()){
            return redirect('/sekolah/create/')->withInput()->withErrors($validator);
        }

        $user = new User;
        $user->email = $request->email_guru;
        $user->password = bcrypt('guru');
        $user->level = 'guru';
        $user->save();

        $sekolah = sekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'guru_pembimbing' => $request->guru_pembimbing,
            'alamat' => $request->alamat,
            'email_guru' => $request->email_guru,
            'hp_guru' => $request->hp_guru,
            'user_id' => $user->id,]);

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
            'alamat' => 'required|string',
            'email_guru' => 'required|email|unique:sekolah,email_guru,'.$id,
            'hp_guru' => 'required|numeric|unique:sekolah,hp_guru,'.$id
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $sekolah = sekolah::find($id);
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
