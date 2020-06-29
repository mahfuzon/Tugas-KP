<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pendaftaran Program Magang PT.Garuda Cyber Indonesia</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('sb/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sb/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>

<body style="background-color: green;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5"><center><img src="{{asset('logo.png')}}" style="width: 70%; height: 700%;"></center>
                        <div class="container">
                            <h1>Syarat dan Ketentuan</h1>
                            <ol>
                                <li>Magang dilakukan minimal 2 bulan</li>
                                <li>Diwajibkan membuat project akhir</li>
                                <li>Diwajibkan membuat artikel setiap harinya</li>
                                <li>Tidak mendapatkan insentif selama magang</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Isikan Data Diri</h1>
                            </div>
                            @include('flash_message')
                            @include('errors')
                            <form class="user" method = "POST" action = "/postlamaran" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="nama_peserta">Nama</label>
                                    <input type="text" class="form-control " id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta') }}">
                                </div>
                                <div class="form-group">
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" class="form-control " id="asal_sekolah"
                                        name="asal_sekolah" value="{{ old('asal_sekolah') }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="email_peserta">Email</label>
                                    <input type="email" class="form-control " id="email_peserta" name="email_peserta" value="{{ old('email_peserta') }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="mulai">Rencana Mulai</label>
                                        <input type="date" class="form-control " id="mulai"
                                            name="mulai" value="{{ old('mulai') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="selesai">Rencana Selesai</label>
                                        <input type="date" class="form-control " id="selesai"
                                            name="selesai" value="{{ old('selesai') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cv">CV:</label>
                                    <input type="file" class="form-control" id="cv" name="cv" value="{{ old('cv') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sb/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('sb/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sb/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <!-- Custom scripts for all pages-->
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#asal_sekolah" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                    $.ajax({
                    url:"{{route('employees.getEmployees')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#asal_sekolah').val(ui.item.label); // display the selected text
                return false;
                        }
                    });
                });
    </script>
</body>
</html>
