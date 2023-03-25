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

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- preloadder styling --}}
    <style>
        .router-link-active {
            color: rgb(137 74 10);
        }
    </style>
    @if (request('category'))
        
    @endif
    {{-- preloader --}}
    <style type="text/css">
        .bgfulwrep {
            width:100vw;
            height:100vw;
            background-color: rgba(176, 179, 176, 0.3);
            position: absolute;
            left:50%;
            top:50%;
            transform: translate(-50%, -50%);
        }
        .wrapperanimate{
            width:200px;
            height:60px;
            position: absolute;
            left:50%;
            top:50%;
            transform: translate(-50%, -50%);
        }
        .circle{
            width:20px;
            height:20px;
            position: absolute;
            border-radius: 50%;
            background-color: #fff;
            left:15%;
            transform-origin: 50%;
            animation: circle .5s alternate infinite ease;
        }
        
        @keyframes circle{
            0%{
                top:60px;
                height:5px;
                border-radius: 50px 50px 25px 25px;
                transform: scaleX(1.7);
            }
            40%{
                height:20px;
                border-radius: 50%;
                transform: scaleX(1);
            }
            100%{
                top:0%;
            }
        }
        .circle:nth-child(2){
            left:45%;
            animation-delay: .2s;
        }
        .circle:nth-child(3){
            left:auto;
            right:15%;
            animation-delay: .3s;
        }
        .shadow{
            width:20px;
            height:4px;
            border-radius: 50%;
            background-color: rgba(0,0,0,.5);
            position: absolute;
            top:62px;
            transform-origin: 50%;
            z-index: -1;
            left:15%;
            filter: blur(1px);
            animation: shadow .5s alternate infinite ease;
        }
        
        @keyframes shadow{
            0%{
                transform: scaleX(1.5);
            }
            40%{
                transform: scaleX(1);
                opacity: .7;
            }
            100%{
                transform: scaleX(.2);
                opacity: .4;
            }
        }
        .shadow:nth-child(4){
            left: 45%;
            animation-delay: .2s
        }
        .shadow:nth-child(5){
            left:auto;
            right:15%;
            animation-delay: .3s;
        }
        .wrapperanimate span{
            position: absolute;
            top:75px;
            font-family: 'Lato';
            font-size: 20px;
            letter-spacing: 12px;
            color: #fff;
            left:15%;
        }
    </style>
</head>
<body>
    {{-- preloader --}}
    <div class="bgfulwrep" id="preloader">
        <div class="wrapperanimate">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
            <span>Sabar...</span>
        </div>
    </div>
    {{-- end preloader --}}
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link" aria-current="page">Dashboard</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Main</a>
                            <ul class="dropdown-menu">
                              <li><router-link to="/category" class="dropdown-item" aria-current="page">category</router-link></li>
                              <li><router-link to="/product" class="dropdown-item" aria-current="page">product</router-link></li>
                              <li><router-link to="/member" class="dropdown-item" aria-current="page">member</router-link></li>
                              <li><router-link to="/supplier" class="dropdown-item" aria-current="page">supplier</router-link></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Transaction</a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/purchasing" class="dropdown-item" aria-current="page">Purchase</router-link></li>
                            </ul>
                            {{-- <li><router-link to="/product" class="dropdown-item" aria-current="page">product</router-link></li> --}}
                        </li>
                        <router-link to="/purchasingDetail" class="nav-link" aria-current="page">Sample</router-link>
                    </ul>

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
                </div>
            </div>
        </nav>

        <main class="py-4 mt-5">
            <router-view></router-view>
        </main>
    </div>

    {{-- datatables --}}
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    
    <!-- form validator -->
    <script src="{{ asset('addition/validator.min.js') }}"></script>

    {{-- preloader --}}
    <script>
        // preloader
        $(document).ready(function(){
            $("#preloader").fadeOut();
            // $(".preloader").css("display", "none");
        })
    </script>
</body>
</html>
