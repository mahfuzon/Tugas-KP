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
                                        style='float:left; margin-left:20px;'>
                                        <i class="fas fa-user-check" style="color:green;"></i>
                                    </a>
                                    <form action="/postAccount/{{$lam->id}}" method="POST" id="delete">
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
