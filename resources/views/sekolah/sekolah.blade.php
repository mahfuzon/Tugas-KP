@extends('template.template')

@section('title')
<title>Sekolah</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div>
                <a href="/sekolah/create" class="btn btn-success btn-md" style="background:#32CD32; float:right;color:white;margin-bottom:20px;">+ Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if(isset($sekolah))
                    <tbody>
                        @foreach($sekolah as $s)
                        <tr>
                            <td>{{$s->nama}}</td>
                            <td>{{$s->alamat}}</td>
                            <td>{{$s->email}}</td>
                            <td>{{$s->no_telepon}}</td>
                            <td>
                                <form action="/sekolah/edit/{{$s->id}}" method="GET">
                                    @csrf
                                    <input type="submit" value="edit" class="btn btn-primary btn-md" style="float:left">
                                </form>

                                <form action="/sekolah/delete/{{$s->id}}" method="post">
                                    @csrf
                                    <input type="submit" value="Hapus" class="btn btn-danger btn-md" style="float:left; margin-left: 10px;">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p>Data Not Found</p>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
