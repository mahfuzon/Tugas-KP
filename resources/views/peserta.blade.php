@extends('template.template')

@section('title')
<title>Lamaran</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if(isset($user))
                    <tbody>
                        @foreach($user as $u)
                        <tr>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->asal_sekolah}}</td>
                            <td>{{$u->mulai->format('d-M-Y')}}</td>
                            <td>{{$u->selesai->format('d-M-Y')}}</td>
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
