@extends('template.template')

@section('title')
<title>Peserta</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
        <!-- Tobol eksport excell -->
        <a class="btn btn-success btn-md" href="/peserta/export" onclick="event.preventDefault();
                                                     document.getElementById('export').submit();" title="export"
                                    style="float:right;margin-bottom:20px;">
                                    Export
                                </a>
                                <form action="/peserta/export" method="GET" id="export">
                                    @csrf
                                </form>
        <!-- End -->

        <!-- Pencarian -->
        <form action="/peserta/cari" method="post">
        @csrf
            <div class="form-row">
                <div class="col-3">
                    <input type="text" name="cari" id="cari" placeholder="Search" class="form-control" style="margin-left:0px;">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-secondary">GO</button>
                </div>
            </div>
        </form>
        <!-- Akhir Pencarian -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Email</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if(isset($peserta))
                    <tbody>
                        @foreach($peserta as $p)
                        <tr>
                            <td>{{$p->nama_peserta}}</td>
                            <td>{{$p->asal_sekolah}}</td>
                            <td>{{$p->email_peserta}}</td>
                            <td>{{$p->mulai->format('d M Y')}}</td>
                            <td>{{$p->selesai->format('d M Y')}}</td>
                            <td>
                                <a href="/peserta/edit/{{$p->id}}" onclick="event.preventDefault();
                                                     document.getElementById('edit_{{$p->id}}').submit();" title="edit"
                                    style="float:left;margin-left:10px;">
                                    <i class="fas fa-edit" style="color:blue;"></i>
                                </a>
                                <form action="/peserta/edit/{{$p->id}}" method="GET" id="edit_{{$p->id}}">
                                    @csrf
                                </form>
                                <a href="#" peserta_id="{{$p->id}}" title="delete" style='float:left; margin-left:20px;'
                                    class="delete">
                                    <i class="fas fa-trash-alt" style="color:red;"></i>
                                </a>
                                <form action="/peserta/delete/{{$p->id}}" method="post" id="delete_{{$p->id}}">
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
<!-- /.container-fluid -->
@endsection

@section('footer')
<script>
      $('.delete').click(function () {
        const peserta_id = $(this).attr('peserta_id');
        swal({
                title: "Yakin?",
                text: "Kamu menghapus data dengan id "+peserta_id+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.preventDefault();
                    document.getElementById('delete_'+peserta_id).submit();
                }
            });
    });
</script>
@endsection
