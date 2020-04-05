<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pendaftaran Program Magang PT.Garuda Cyber Indonesia</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('sb/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sb/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                @include('flash_message')
                @include('errors')
                <form class="user" method="POST" action="/postlamaran" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group">
                                    <label for="nama[]">Nama</label>
                                    <input type="text" class="form-control form-control-user" id="nama[]" name="nama[]"
                                        value="{{ old('nama[]') }}">
                                </div>
                                <div class="form-group">
                                    <label for="asal_sekolah[]">Asal Sekolah</label>
                                    <input type="text" class="form-control form-control-user" id="asal_sekolah[]"
                                        name="asal_sekolah[]" value="{{ old('asal_sekolah[]') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email[]">Email</label>
                                    <input type="email" class="form-control form-control-user" id="email[]" name="email[]"
                                        value="{{ old('email[]') }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="mulai[]">Tanggal Mulai</label>
                                        <input type="date" class="form-control form-control-user" id="mulai[]"
                                            name="mulai[]" value="{{ old('mulai[]') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="selesai">Tanggal Selesai</label>
                                        <input type="date" class="form-control form-control-user" id="selesai[]"
                                            name="selesai[]" value="{{ old('selesai[]') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cv[]">CV:</label>
                                    <input type="file" class="form-control form-control-user" id="cv[]" name="cv[]"
                                        value="{{ old('cv[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group">
                                    <label for="nama[]">Nama</label>
                                    <input type="text" class="form-control form-control-user" id="nama[]" name="nama[]"
                                        value="{{ old('nama[]') }}">
                                </div>
                                <div class="form-group">
                                    <label for="asal_sekolah[]">Asal Sekolah</label>
                                    <input type="text" class="form-control form-control-user" id="asal_sekolah[]"
                                        name="asal_sekolah[]" value="{{ old('asal_sekolah[]') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email[]">Email</label>
                                    <input type="email" class="form-control form-control-user" id="email[]" name="email[]"
                                        value="{{ old('email[]') }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="mulai[]">Tanggal Mulai</label>
                                        <input type="date" class="form-control form-control-user" id="mulai[]"
                                            name="mulai[]" value="{{ old('mulai[]') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="selesai[]">Tanggal Selesai</label>
                                        <input type="date" class="form-control form-control-user" id="selesai[]"
                                            name="selesai[]" value="{{ old('selesai[]') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cv[]">CV:</label>
                                    <input type="file" class="form-control form-control-user" id="cv[]" name="cv[]"
                                        value="{{ old('cv[]') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="p-5" style="margin-left:auto;margin-right:auto;">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sb/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('sb/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sb/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sb/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
