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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Email</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>CV</th>
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
                                                     document.getElementById('{{$lam->id}}').submit();">{{$lam->cv}}</a>
                                <form action="/cv/{{$lam->id}}" method="post" id="{{$lam->id}}" style="display:none;">
                                    @csrf
                                </form>
                            </td>
                            <td>
                                @if($lam->acc == 0)
                                    @if(Auth::check() && Auth()->User()->level == 'admin')
                                        <a href="/postAccount/{{$lam->id}}" onclick="event.preventDefault();
                                                                document.getElementById('delete').submit();" title="accept"
                                            style='float:left; margin-left:10px;'>
                                            <i class="fas fa-user-check" style="color:green;"></i>
                                        </a>
                                        <form action="/postAccount/{{$lam->id}}" method="POST" id="delete">
                                            @csrf
                                        </form>

                                        <a href="#" lamaran_id="{{$lam->id}}" title="delete" style='float:left; margin-left:10px;'
                                            class="delete">
                                            <i class="fas fa-trash-alt" style="color:red;"></i>
                                        </a>
                                        <form action="/lamaran/delete/{{$lam->id}}" method="post" id="delete">
                                            @csrf
                                        </form>
                                    @else
                                    <a href="/lamaran/delete/{{$lam->id}}" onclick="event.preventDefault();
                                                            document.getElementById('delete').submit();" title="delete"
                                        style='float:left; margin-left:20px;'>
                                        <i class="fas fa-trash-alt" style="color:red;"></i>
                                    </a>
                                    <form action="/lamaran/delete/{{$lam->id}}" method="POST" id="delete">
                                        @csrf
                                    </form>
                                    @endif
                                @else
                                    <p>acc</p>
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
                    document.getElementById('delete').submit();
                }
            });
    });

</script>
@endsection

