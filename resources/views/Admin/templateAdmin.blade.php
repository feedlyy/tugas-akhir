<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Penjadwalan Acara Sekolah Vokasi</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('fonts/font-awesome/css/font-awesome.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('fonts/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
    {{--custom css--}}
    <link rel="stylesheet" href="{{ url('style.css') }}">
    <link rel="stylesheet" href="{{ url('dataTables/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('dataTables/css/dataTables.responsive.css') }}">
    {{--select2--}}
    <link rel="stylesheet" href="{{ url('../../bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ url('../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ url('../../plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{--datetime picker bootstrap--}}
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap-datetimepicker.css') }}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ url('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="{{ url('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <!-- jQuery 2.2.3 -->
    <script src="{{ url('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ url('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('dist/js/demo.js') }}"></script>
    {{--Custom JS--}}
    <script src="{{ url('script.js') }}"></script>
    {{--sweet alert js--}}
    <script src="{{ url('sweetalert/sweetalert.min.js') }}"></script>
    {{--promise js--}}
    <script src="{{ url('promise/promise.min.js') }}"></script>
    {{--moment js--}}
    <script src="{{ url('moment/moment.min.js') }}"></script>
    {{--date range picker js and css--}}
    <script src="{{ url('daterangepicker/daterangepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ url('daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap time picker -->
    <script src="{{ url('../../plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{--select2--}}
    <script src="{{ url('../../bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    {{--transition bootstrap--}}
    <script src="{{ url('bootstrap/js/transition.js') }}"></script>
    {{--collapse bootstrap--}}
    <script src="{{ url('bootstrap/js/collapse.js') }}"></script>
    {{--bootstrap datepicker--}}
    <script src="{{ url('bootstrap/js/bootstrap-datetimepicker.min.js') }}"></script>



    {{--ini buat table view nya di gedung maupun ruangan--}}
    <script src="{{ url('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('dataTables/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('dataTables/js/dataTables.responsive.js') }}"></script>
<!-- DataTables -->
    <script src="{{ url('../../bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('tampilan') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>V</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Admin&nbsp<b>Dashboard</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu" style="margin-right: 4%;">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ \Illuminate\Support\Facades\Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url('image/ugm.png') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    @auth
                        {{ ucfirst(\Illuminate\Support\Facades\Auth::user()->username) }}
                    @endauth


                    {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null && \Illuminate\Support\Facades\Auth::user()->id_departemen == null && \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                        <li class="treeview">
                            <a href="{{ url('admin/admin') }}">
                                <i class="fa fa-user-plus"></i> <span>Admin</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/staff') }}">
                                <i class="fa fa-user"></i> <span>Staff</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/acara') }}">
                                <i class="fa fa-calendar-plus-o"></i> <span>Acara</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/gedung') }}">
                                <i class="fa fa-building-o"></i> <span>Gedung</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/ruangan') }}">
                                <i class="fa fa-building-o"></i> <span>Ruangan</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user-circle"></i>
                                <span>User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('admin/fakultas') }}"><i class="fa fa-circle-o"></i> Fakultas</a></li>
                                <li><a href="{{ url('admin/departemen') }}"><i class="fa fa-circle-o"></i> Departemen</a></li>
                                <li><a href="{{ url('admin/prodi') }}"><i class="fa fa-circle-o"></i> Prodi</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{ route('kalender') }}">
                                <i class="fa fa-calendar"></i> <span>Kalender Vokasi</span>
                            </a>
                        </li>
                    @elseif(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null && \Illuminate\Support\Facades\Auth::user()->id_departemen != null && \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                        <li class="treeview">
                            <a href="{{ url('admin/admin') }}">
                                <i class="fa fa-user-plus"></i> <span>Admin</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/staff') }}">
                                <i class="fa fa-user-o"></i> <span>Staff</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/acara') }}">
                                <i class="fa fa-calendar-plus-o"></i> <span>Acara</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/gedung') }}">
                                <i class="fa fa-building-o"></i> <span>Gedung</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/ruangan') }}">
                                <i class="fa fa-building-o"></i> <span>Ruangan</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user-circle"></i>
                                <span>User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('admin/fakultas') }}"><i class="fa fa-circle-o"></i> Fakultas</a></li>
                                <li><a href="{{ url('admin/departemen') }}"><i class="fa fa-circle-o"></i> Departemen</a></li>
                                <li><a href="{{ url('admin/prodi') }}"><i class="fa fa-circle-o"></i> Prodi</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{ route('kalender') }}">
                                <i class="fa fa-calendar"></i> <span>Kalender Vokasi</span>
                            </a>
                        </li>
                        @else
                        <li class="treeview">
                            <a href="{{ url('admin/staff') }}">
                                <i class="fa fa-user"></i> <span>Staff</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/acara') }}">
                                <i class="fa fa-calendar-plus-o"></i> <span>Acara</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/gedung') }}">
                                <i class="fa fa-building-o"></i> <span>Gedung</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ url('admin/ruangan') }}">
                                <i class="fa fa-building-o"></i> <span>Ruangan</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user-circle"></i>
                                <span>User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('admin/fakultas') }}"><i class="fa fa-circle-o"></i> Fakultas</a></li>
                                <li><a href="{{ url('admin/departemen') }}"><i class="fa fa-circle-o"></i> Departemen</a></li>
                                <li><a href="{{ url('admin/prodi') }}"><i class="fa fa-circle-o"></i> Prodi</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{ route('kalender') }}">
                                <i class="fa fa-calendar"></i> <span>Kalender Vokasi</span>
                            </a>
                        </li>
                    @endif
                    @endauth
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @section('isi')
        <!-- Content Header (Page header) -->
        {{--<section class="content-header">
            <h1>
                @auth
                    Selamat Datang Admin {{ ucfirst(\Illuminate\Support\Facades\Auth::user()->nama_admin) }}
                @endauth
            </h1>
        </section>--}}

        <!-- Main content -->
        <section class="content">

            <!-- Profile Image -->
            <div class="box" style="width: 50%; height: 140%; margin-left: 25%; margin-top: 4%;">
                <div class="box-body box-profile">


                    <h3 class="profile-username text-center">Selamat Datang {{ ucfirst(\Illuminate\Support\Facades\Auth::user()->username) }}</h3>
                    <br>
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('image/ugm.png') }}" alt="User profile picture">
                    <br>
                    <h3 class="text-muted text-center">Sistem Penjadwalan Acara Sekolah Vokasi Integrasi Google Calendar</h3>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
            @show
    </div>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
    //ini untuk kalau side tree nya di click bakal nambahin class active
    var url = window.location;
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

    // untuk bagian tree view nya
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).closest('.treeview').addClass('active');



</script>
</body>
</html>
