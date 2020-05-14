@extends('template.template')

@section('title')
    <title>Edit Sekolah</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Sekolah</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @include('errors')
            <form action="/sekolah/update/{{$sekolah->id}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="@if($errors->any()){{old('nama_sekolah')}}@else{{$sekolah->nama_sekolah}}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat Sekolah:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">@if($errors->any()){{old('alamat')}}@else{{$sekolah->alamat}}@endif</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_guru" class="col-sm-2 col-form-label">Email Guru:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_guru" name="email_guru" value="@if($errors->any()){{old('email_guru')}}@else{{$sekolah->email_guru}}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hp_guru" class="col-sm-2 col-form-label">No. Hp Guru</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="hp_guru" name="hp_guru" value="@if($errors->any()){{old('hp_guru')}}@else{{$sekolah->hp_guru}}@endif">
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