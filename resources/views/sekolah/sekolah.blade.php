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
                <a href="/sekolah/create" class="btn btn-success btn-md" style="float:right;margin-bottom:20px;">+
                    Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Nama Guru Pembimbing</th>
                            <th>No. Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if(isset($sekolah))
                    <tbody>
                        @foreach($sekolah as $s)
                        <tr>
                            <td>{{$s->nama_sekolah}}</td>
                            <td>{{$s->alamat}}</td>
                            <td>{{$s->email_guru}}</td>
                            <td>{{$s->guru_pembimbing}}</td>
                            <td>{{$s->hp_guru}}</td>
                            <td>
                                <a href="/sekolah/edit/{{$s->user_id}}" onclick="event.preventDefault();
                                                     document.getElementById('edit').submit();" title="edit"
                                    style="float:left;margin-left:10px;">
                                    <i class="fas fa-edit" style="color:blue;"></i>
                                </a>
                                <form action="/sekolah/edit/{{$s->user_id}}" method="GET" id="edit">
                                    @csrf
                                </form>
                                <a href="#" sekolah_id="{{$s->user_id}}" title="delete" style='float:left; margin-left:20px;'
                                    class="delete">
                                    <i class="fas fa-trash-alt" style="color:red;"></i>
                                </a>
                                <form action="/sekolah/delete/{{$s->user_id}}" method="post" id="delete">
                                    @csrf
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

