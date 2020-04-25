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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Email</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    @if(isset($peserta))
                    <tbody>
                        @foreach($peserta as $p)
                        <tr>
                            <td>{{$p->lampiran->nama_peserta}}</td>
                            <td>{{$p->lampiran->asal_sekolah}}</td>
                            <td>{{$p->lampiran->email_peserta}}</td>
                            <td>{{$p->lampiran->mulai->format('d-M-Y')}}</td>
                            <td>{{$p->lampiran->selesai->format('d-M-Y')}}</td>
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
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New Account ')
        modal.find('.modal-body input')
    })

</script>
@endsection
