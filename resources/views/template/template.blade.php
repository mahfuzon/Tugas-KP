<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')

    <!-- Custom fonts for this template-->
    <link href="{{asset('sb/vendor/fontawesome/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sb/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{asset('logo.png')}}" style="width:70%; height:30%;">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if(Auth::check())
                @if(isset($halaman) && $halaman == 'home')
                    <li class="nav-item active">
                        <a class="nav-link" href="/home">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                @endif
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::check())
                @if(Auth()->User()->level == 'guru' || Auth()->User()->level == 'admin')
                    @if(isset($halaman) && $halaman == 'peserta')
                        <li class="nav-item active">
                            <a class="nav-link" href="/peserta">
                                <i class="fas fa-users"></i>
                                <span>Peserta</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/peserta">
                                <i class="fas fa-users"></i>
                                <span>Peserta</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif

            <!-- Nav Item - Utilities Collapse Menu -->
            @if(Auth::check())
                @if(Auth()->User()->level == 'guru' || Auth()->User()->level == 'admin')
                    @if(isset($halaman) && $halaman == 'lampiran')
                        <li class="nav-item active">
                            <a class="nav-link" href="/lamaran">
                                <i class="fas fa-envelope"></i>
                                <span>Data Lamaran</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/lamaran">
                                <i class="fas fa-envelope"></i>
                                <span>Data Lamaran</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif

            @if(Auth::check())
                @if(Auth()->User()->level == 'admin')
                    @if(isset($halaman) && $halaman == 'sekolah')
                        <li class="nav-item active">
                            <a class="nav-link" href="/sekolah">
                                <i class="fas fa-school"></i>
                                <span>Sekolah</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/sekolah">
                                <i class="fas fa-school"></i>
                                <span>Sekolah</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif

            @if(Auth::check())
                @if(Auth()->User()->level == 'admin')
                    @if(isset($halaman) && $halaman == 'user')
                        <li class="nav-item active">
                            <a class="nav-link" href="/user">
                                <i class="fas fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/user">
                                <i class="fas fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                @if(Auth::check())
                                    @if(Auth::User()->level == 'admin')
                                        {{Auth::User()->level}}
                                    @else
                                        {{Auth::User()->nama}}
                                    @endif
                                @endif
                                </span>
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/change-password/@if(Auth::check()){{Auth::user()->id}}@endif">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                @yield('content')
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Garuda Cyber 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih logout jika ingin keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
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

    <!-- Page level plugins -->
    <script src="{{asset('sb/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('sb/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('sb/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('#logout').click(function () {
            swal({
                    title: "Yakin?",
                    text: "Anda Akan Keluar dari Sistem",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    }
                });
        });

        @if(Session::has('sukses_tambah'))
        toastr.success("{{Session::get('sukses_tambah')}}", "Sukses");
        @endif

        @if(Session::has('sukses_edit'))
        toastr.success("{{Session::get('sukses_edit')}}", "Sukses");
        @endif

        @if(Session::has('sukses_hapus'))
        swal("{{Session::get('sukses_hapus')}}", {
            icon: "success",
        });
        @endif

    </script>
    @yield('footer')
</body>

</html>
