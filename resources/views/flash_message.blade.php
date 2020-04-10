@if(Session::has('sukses_hapus'))
    swal("{{Session::get('sukses_hapus')}}", {
        icon: "success",
    });
@endif

@if(Session::has('flash_message'))
<div class="alert alert-danger">
    {{Session::get('flash_message')}}
</div>
@endif

@if(Session::has('sukses_tambah'))
    swal("{{Session::get('sukses_tambah')}}", {
        icon: "success",
    });
@endif
