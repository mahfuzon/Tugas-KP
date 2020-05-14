@extends('template.template')

@section('title')
    <title>Tambah Siswa</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Siswa</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
        @include('errors')
        @include('flash_message')
            <form action="/postlamaran" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group row">
                    <label for="nama_peserta" class="col-sm-2 col-form-label">Nama Siswa:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{old('nama_peserta')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_peserta" class="col-sm-2 col-form-label">Email Peserta:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_peserta" name="email_peserta" value="{{old('email_peserta')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mulai" class="col-sm-2 col-form-label">Tanggal Mulai:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="mulai" name="mulai" value="{{old('mulai')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="selesai" class="col-sm-2 col-form-label">Tanggal Selesai:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="selesai" name="selesai" value="{{old('selesai')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cv" class="col-sm-2 col-form-label">Curiculum Vitae:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="cv" name="cv" value="{{old('cv')}}">
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