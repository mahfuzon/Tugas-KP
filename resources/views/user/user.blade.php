@extends('template.template')

@section('title')
<title>User</title>
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
                            <th>Email</th>
                            <th>Level</th>
                            <th>Created at</>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if(isset($user))
                    <tbody>
                        @foreach($user as $u)
                        <tr>
                            <td>{{$u->email}}</td>
                            <td>{{$u->level}}</td>
                            <td>{{$u->created_at->format('d-M-Y')}}</td>
                            <td>
                                <a href="#" user_id="{{$u->id}}" title="delete" style='float:left; margin-left:20px;'
                                    class="delete">
                                    <i class="fas fa-trash-alt" style="color:grey;"></i>
                                </a>
                                <form action="/user/delete/{{$u->id}}" method="post" id="delete_{{$u->id}}">
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

@section('footer')
<script>
      $('.delete').click(function () {
        const user_id = $(this).attr('user_id');
        swal({
                title: "Yakin?",
                text: "Kamu menghapus data dengan id "+user_id+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.preventDefault();
                    document.getElementById('delete_'+user_id).submit();
                }
            });
    });
</script>
@endsection

