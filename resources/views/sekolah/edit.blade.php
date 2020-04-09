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
                    <label for="nama" class="col-sm-2 col-form-label">Nama Sekolah:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">{{$sekolah->alamat}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{$sekolah->email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No. Telepon:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{$sekolah->no_telepon}}">
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