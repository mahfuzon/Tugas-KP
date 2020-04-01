@extends('template.template')

@section('title')
    <title>Edit Sekolah</title>
@endsection

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Sekolah:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No. Telepon:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection