<html lang="en" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin GPT Aps</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <style type="text/css">
        /* Chart.js */
        @keyframes chartjs-render-animation {
            from {
                opacity: .99
            }

            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            animation: chartjs-render-animation 1ms
        }

        .chartjs-size-monitor,
        .chartjs-size-monitor-expand,
        .chartjs-size-monitor-shrink {
            position: absolute;
            direction: ltr;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
            visibility: hidden;
            z-index: -1
        }

        .chartjs-size-monitor-expand>div {
            position: absolute;
            width: 1000000px;
            height: 1000000px;
            left: 0;
            top: 0
        }

        .chartjs-size-monitor-shrink>div {
            position: absolute;
            width: 200%;
            height: 200%;
            left: 0;
            top: 0
        }

    </style>
</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        @include('sweetalert::alert')

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="height: 0px;">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"
                style="display: none;">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block" style="display: none;">
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
        </div>
      </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <p>

                <!-- Sidebar -->
                <div
                    class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
                    <div class="os-resize-observer-host observed">
                        <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                    </div>
                    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                        <div class="os-resize-observer"></div>
                    </div>
                    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 259px;"></div>
                    <div class="os-padding">
                        <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                            <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">

                                <!-- Sidebar Menu -->
                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                        data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                                        <!-- menu Home -->
                                        <li class="nav-item">
                                            <a href="{{ route('home') }}" class="nav-link">
                                                <i class="nav-icon fas fa-house-user text-primary"></i>
                                                <p>
                                                    Beranda
                                                </p>
                                            </a>
                                        </li>
                                        <!-- menu Produk -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-video"></i>
                                                <p>
                                                    Semua produk
                                                    <i class="fas fa-angle-down right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Dahua</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Hikvision</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- menu SN -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-barcode"></i>
                                                <p>
                                                    Serial Number
                                                    <i class="fas fa-angle-down right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Semua SN</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>SN Aktif</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- menu Customer -->
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}" class="nav-link">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p>
                                                    Customer
                                                </p>
                                            </a>
                                        </li>
                                        <!-- menu Redeem Voucher -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-gift"></i>
                                                <p>
                                                    Redeem Point
                                                    <i class="fas fa-angle-down right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                                        <i class="fas fa-gifts nav-icon"></i>
                                                        <p>Daftar Hadiah</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                                        <i class="far fa-clock nav-icon"></i>
                                                        <p>Transaksi Terakhir</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- menu Trasaksi -->
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i class="nav-icon fas fa-list"></i>
                                                <p>
                                                    Daftar Transaksi
                                                </p>
                                            </a>
                                        </li>
                                        <!-- menu Content -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-photo-video"></i>
                                                <p>
                                                    Content Aps
                                                    <i class="fas fa-angle-down right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                                        <i class="fas fa-sliders-h nav-icon"></i>
                                                        <p>Slider</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                                        <i class="far fa-newspaper nav-icon"></i>
                                                        <p>Article</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                                        <i class="fas fa-photo-video nav-icon"></i>
                                                        <p>Tutorial</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- menu Logout -->
                                        <li class="nav-item">
                                            <a href="" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                                <i class="nav-icon fas fa-power-off text-danger"></i>
                                                <p>
                                                    {{ __('Logout') }}
                                                </p>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- /.sidebar-menu -->
                            </div>
                        </div>
                    </div>
                    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                        <div class="os-scrollbar-track">
                            <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                        </div>
                    </div>
                    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                        <div class="os-scrollbar-track">
                            <div class="os-scrollbar-handle" style="height: 19.1317%; transform: translate(0px, 0px);">
                            </div>
                        </div>
                    </div>
                    <div class="os-scrollbar-corner"></div>
                </div>
                <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 203px;">

            <!-- Main Content -->
            @yield('content')
            <!-- end Main COntent -->

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright © 2022 <a href="https://cctvbandung.co.id">CV. Global Prima Teknologi</a></strong>
            </footer>
            <div id="sidebar-overlay"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)

        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <!-- Page specific script -->
        <script>
            $(function () {
                bsCustomFileInput.init();
            });

        </script>

        
        <div class="daterangepicker ltr show-ranges opensright">
            <div class="ranges">
                <ul>
                    <li data-range-key="Today">Today</li>
                    <li data-range-key="Yesterday">Yesterday</li>
                    <li data-range-key="Last 7 Days">Last 7 Days</li>
                    <li data-range-key="Last 30 Days">Last 30 Days</li>
                    <li data-range-key="This Month">This Month</li>
                    <li data-range-key="Last Month">Last Month</li>
                    <li data-range-key="Custom Range">Custom Range</li>
                </ul>
            </div>
            <div class="drp-calendar left">
                <div class="calendar-table"></div>
                <div class="calendar-time" style="display: none;"></div>
            </div>
            <div class="drp-calendar right">
                <div class="calendar-table"></div>
                <div class="calendar-time" style="display: none;"></div>
            </div>
            <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default"
                    type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled"
                    type="button">Apply</button> </div>
        </div>
        <div class="jqvmap-label" style="display: none;"></div>
</body>

</html>
