<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- bootsrap icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- from admin lte --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assetAdminLte/dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/assetAdminLte/plugins/summernote/summernote-bs4.min.css">
{{-- end --}}

    @yield('css')
</head>
<body>
    <div id="app">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
              <!-- Left navbar links -->
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                  <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}" style="{{ request()->is('home') ? 'font-weight: bold' : '' }}">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                  <a href="#" class="nav-link">Contact</a>
                </li>
              </ul>

              <!-- Right navbar links -->
              <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a> --}}
                    {{-- <div class="navbar-search-block">
                        <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        </form>
                    </div> --}}
                </li>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                      <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="bi bi-chat-dots-fill h4"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a> --}}
                    <a class="position-relative d-inline-block mt-2 me-3" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="bi bi-chat-dots-fill h4"></i>
                        <div id="jmlNotif"></div>
                    </a>
                </li>
              </ul>
            </nav>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/home') }}" class="brand-link">
                <img src="/assetAdminLte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}
                </span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        {{-- <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                        </div> --}}
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('books') }}" class="nav-link {{ request()->is('books') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buku</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('catalogs') }}" class="nav-link {{ request()->is('catalogs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Katalog</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('publishers') }}" class="nav-link {{ request()->is('publishers') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Publisher</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('authors') }}" class="nav-link {{ request()->is('authors') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penulis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('members') }}" class="nav-link {{ request()->is('members') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>member</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('transactions') }}" class="nav-link {{ request()->is('transactions') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pinjaman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Simple Link
                                <span class="right badge badge-danger">New</span>
                            </p>
                            </a>
                        </li>
                      </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Pesan</h5>
                    <ul id="notifikasi">
                        
                    </ul>
                </div>
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>


{{-- from admin lte --}}
    <!-- jQuery -->
        <script src="/assetAdminLte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/assetAdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="/assetAdminLte/plugins/chart.js/Chart.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/assetAdminLte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="/assetAdminLte/dist/js/demo.js"></script> --}}
{{-- end --}}
    @yield('scriptLink')
    @yield('js')

<script>
    // get notif lewat ajax
    let notifikasiKeterlambatan = [];

    $(document).ready(get_notif());
    function get_notif() {
        const _this = this;
        // data books
        $.ajax({
            url: '{{ url('notif') }}/api',
            method: 'GET',
            success: function (data) {
                _this.notifikasiKeterlambatan = data;
                // console.log(_this.notifikasiKeterlambatan);

                // buat pesan notif
                _this.pesanNotifikasi = '';
                _this.notifikasiKeterlambatan.forEach(element => {
                    // console.log('halo');
                    _this.pesanNotifikasi = _this.pesanNotifikasi+'<li>'+element+'</li>';
                });

                // jumlah notif
                // console.log(data.length);
                if (data.length == 0) {
                    
                } else {
                    $('#jmlNotif').html(
                        '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"'+'>'+
                            '<span>'+data.length+'</span>'+
                            '</span>'
                    );
                }
                
                // tampilkan notif
                $('#notifikasi').html(_this.pesanNotifikasi);
            },
            error: function (error) {
                console.log(error);
            }
       });

       
    }
</script>
</body>
</html>
