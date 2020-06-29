@extends('template.template')

@section('title')
<title>Lamaran</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if(Auth()->user()->level == 'guru')
            <div>
                <a href="/daftar" class="btn btn-success btn-md" style="float:right;margin-bottom:20px;">+
                    Tambah Data</a>
            </div>
            @endif
            <div class="table-responsive">
            @include('flash_message')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Email</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lampiran as $lam)
                        <tr>
                            <td>{{$lam->nama_peserta}}</td>
                            <td>{{$lam->asal_sekolah}}</td>
                            <td>{{$lam->email_peserta}}</td>
                            <td>{{$lam->mulai->format('d-M-Y')}}</td>
                            <td>{{$lam->selesai->format('d-M-Y')}}</td>
                            <td>
                                <a href="/cv/{{$lam->id}}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('{{$lam->id}}').submit();">{{$lam->cv->cv}}</a>
                                <form action="/cv/{{$lam->id}}" method="post" id="{{$lam->id}}" style="display:none;">
                                    @csrf
                                </form>
                            </td>
                            <td>{{$lam->acc}}</td>
                            <td>
                                @if($lam->acc == 'waiting')
                                    @if(Auth::check() && Auth()->User()->level == 'admin')
                                        <a href="#"title="accept" lamaran_id="{{$lam->id}}"
                                            style='float:left; margin-left:0px;' class = "accept">
                                            <i class="fas fa-user-check" style="color:green;"></i>
                                        </a>
                                        <form action="/postAccount/{{$lam->id}}" method="POST" id="accept_{{$lam->id}}">
                                            @csrf
                                        </form>

                                        <a href="#" lamaran_id="{{$lam->id}}" title="reject" style='float:left; margin-left:5px;'
                                            class="reject">
                                            <i class="fas fa-times-circle" style="color:red;"></i>
                                        </a>
                                        <form action="/lamaran/tolak/{{$lam->id}}" method="post" id="tolak_{{$lam->id}}">
                                            @csrf
                                        </form>
                                    @else
                                    <a href="#"  lamaran_id="{{$lam->id}}" title="delete" style='float:left; margin-left:20px;' class="delete">
                                        <i class="fas fa-trash-alt" style="color:red;"></i>
                                    </a>
                                    <form action="/lamaran/delete/{{$lam->id}}" method="POST" id="delete_{{$lam->id}}">
                                        @csrf
                                    </form>
                                    @endif
                                @else
                                    <a href="#"  lamaran_id="{{$lam->id}}" title="delete" style='float:left; margin-left:15px;' class="delete">
                                        <i class="fas fa-trash-alt" style="color:grey;"></i>
                                    </a>
                                    <form action="/lamaran/delete/{{$lam->id}}" method="POST" id="delete_{{$lam->id}}">
                                        @csrf
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('footer')
<script>
    $('.delete').click(function () {
        const lamaran_id = $(this).attr('lamaran_id');
        swal({
                title: "Yakin?",
                text: "Kamu menghapus data dengan id "+lamaran_id+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.preventDefault();
                    document.getElementById('delete_'+lamaran_id).submit();
                }
            });
    });
    $('.accept').click(function () {
        const lamaran_id = $(this).attr('lamaran_id');
        swal({
                title: "Yakin?",
                text: "Kamu Akan Menyetujui Lamaran dengan Id "+lamaran_id+"!",
                icon: "success",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.preventDefault();
                    document.getElementById('accept_'+lamaran_id).submit();
                }
            });
    });
    $('.reject').click(function () {
        const lamaran_id = $(this).attr('lamaran_id');
        swal({
                title: "Yakin?",
                text: "Kamu Akan Menolak Lamaran dengan Id "+lamaran_id+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.preventDefault();
                    document.getElementById('tolak_'+lamaran_id).submit();
                }
            });
    });
</script>
@endsection

