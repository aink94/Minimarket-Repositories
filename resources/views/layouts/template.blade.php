<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.6 -->
    {{Html::style('assets/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css')}}
            <!-- Font Awesome -->
    {{Html::style('assets/bower_components/components-font-awesome/css/font-awesome.min.css')}}
            <!-- Ionicons -->
    {{Html::style('assets/bower_components/ionicons-min/css/ionicons.min.css')}}
            <!-- Theme style -->
    {{Html::style('assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css')}}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    {{Html::style('assets/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css')}}
            <!-- Notifikasi-->
    {{ Html::style('assets/bower_components/NotificationStyles/css/normalize.css') }}
    {{-- Html::style('assets/bower_components/NotificationStyles/css/demo.css') --}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-default.css')}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-style-growl.css')}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-style-bar.css')}}
    {{Html::script('assets/bower_components/NotificationStyles/js/modernizr.custom.js')}}
    @stack('css')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{config('app.name')}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{config('app.desc')}}</span>
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

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset(config('app.foto'))}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->nama}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset(config('app.foto'))}}" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::user()->nama}}
                                    <small>{{Auth::user()->status}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
                    <img src="{{asset(config('app.foto'))}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->nama}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->status}}</a>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <li><a href="{{route('main')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="{{route('transaksi')}}"><i class="fa fa-calculator"></i> <span>Mesin Kasir</span></a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Produk</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('produk')}}"><i class="fa fa-briefcase"></i>Data Item</a></li>
                        <li><a href="{{route('kategori')}}"><i class="fa fa-list-alt"></i>Kategori</a></li>
                        <li><a href="{{route('satuan')}}"><i class="fa fa-list"></i>Satuan</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-exchange"></i> <span>Stok</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('stok.masuk')}}"><i class="fa fa-sign-in"></i>Stok Masuk</a></li>
                        <li><a href="{{route('stok.keluar')}}"><i class="fa fa-sign-out"></i>Stok Keluar</a></li>
                    </ul>
                </li>
                <li><a href="{{route('pelanggan')}}"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
                <li><a href="{{route('supplier')}}"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-text"></i> <span>Laporan</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('laporan.penjualan')}}"><i class="fa fa-file-text"></i>Penjualan</a></li>
                        <li><a href="{{route('laporan.stok.masuk')}}"><i class="fa fa-file"></i>Stok Masuk</a></li>
                        <li><a href="{{route('laporan.stok.keluar')}}"><i class="fa fa-file-o"></i>Stok Keluar</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-gears"></i> <span>Pengaturan</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>

        <!-- Main content -->
        @yield('content')
                <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Version - {{config('app.version')}}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 - {{config('app.name', 'Minimart')}}.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<div class="loading">
    <img src="{{asset('img/loading.gif')}}">
</div>
<!-- ./wrapper -->
<style type="text/css">
    .loading{
        position: fixed;
        background: rgba(255, 255, 255, 0.7);
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1200;
        display: none;
    }
    .loading > img{
        top: 30%;
        left: 50%;
        position: absolute;
    }
</style>
<!-- jQuery 2.2.3 -->
{{Html::script('assets/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}
        <!-- Bootstrap 3.3.6 -->
{{Html::script('assets/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js')}}
        <!-- SlimScroll -->
{{Html::script('assets/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}
        <!-- FastClick -->
{{Html::script('assets/bower_components/AdminLTE/plugins/fastclick/fastclick.min.js')}}
        <!-- AdminLTE App -->
{{Html::script('assets/bower_components/AdminLTE/dist/js/app.min.js')}}
        <!-- AdminLTE for demo purposes -->
{{Html::script('assets/bower_components/AdminLTE/dist/js/demo.js')}}
        <!-- Notifikasi-->
{{ Html::script('assets/bower_components/NotificationStyles/js/classie.js')}}
{{ Html::script('assets/bower_components/NotificationStyles/js/notificationFx.js')}}

@stack('js')
</body>
</html>
