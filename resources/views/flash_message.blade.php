@if(Session::has('flash_message'))
<div class="alert alert-danger">
    {{Session::get('flash_message')}}
</div>
@endif

@if(Session::has('berhasil_daftar'))
<div class="alert alert-success">
    {{Session::get('berhasil_daftar')}}
</div>
@endif

@if(Session::has('gagal'))
<div class="alert alert-danger">
    {{Session::get('gagal')}}
</div>
@endif

@if(Session::has('gagal_daftar'))
<div class="alert alert-danger">
    {{Session::get('gagal_daftar')}}
</div>
@endif