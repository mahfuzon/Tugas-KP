@extends('template.template')

@section('title')
    <title>Tambah Sekolah</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Sekolah</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
        @include('errors')
            <form action="/sekolah/store" method="POST">
            @csrf
                <div class="form-group row">
                    <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{old('nama_sekolah')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="guru_pembimbing" class="col-sm-2 col-form-label">Nama Guru Pembimbing:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="guru_pembimbing" name="guru_pembimbing" value="{{old('guru_pembimbing')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">{{old('alamat')}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_guru" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_guru" name="email_guru" value="{{old('email_guru')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon_sekolah" class="col-sm-2 col-form-label">No. Telepon Guru:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="hp_guru" name="hp_guru" value="{{old('hp_guru')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6" style="margin-left:auto; margin-right:auto;">
                        <input type="submit" class="form-control btn btn-success btn-md">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection