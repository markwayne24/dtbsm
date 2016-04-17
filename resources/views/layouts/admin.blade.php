<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/assets/plugins/morris/morris.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- TableTools -->
    <link rel = "stylesheet" type = "text/css" href="//cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css"/>
    <link rel = "stylesheet" type = "text/css" href="//cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.min.css"/>
    <!-- jvectormap -->
    <link rel="stylesheet" href="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/plugins/select2/select2.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!--dialogbox-->
    <link rel="stylesheet" href="/assets/plugins/promptbox/dialog-prompt.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
    <!-- preload -->
    <link rel="stylesheet" href="/assets/dist/css/preload.css">
    <link rel="stylesheet" href="/assets/dist/css/queryLoader.css">
    @yield('style')

            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="c">
    <header class="main-header">
        <!-- Logo -->
        <a href="" >
            <img src="/assets/dist/img/logo.png" class="logo" alt="Logo">
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(Auth::user()->userProfile->gender == "male")
                                <img src="/assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                            @elseif(Auth::user()->userProfile->gender == "female")
                                <img src="/assets/dist/img/avatar2.png" class="user-image" alt="User Image">
                            @endif
                                <span class="hidden-xs">{{ Auth::user()->userProfile->firstname  }}</span>
                        </a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{  Auth::user()->userProfile->firstname }}</p>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="{{ url('admin/dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ url('admin/dashboard/users') }}">
                        <i class="ion ion-person"></i>
                        <span>Users</span></i>
                        <span class="label label-primary pull-right"></span>
                    </a>

                </li>

                <li class="treeview">
                    <a href="">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <span>Supplies</span><i class="fa fa-angle-left pull-right"></i>
                        <span class="label label-primary pull-right"></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/dashboard/supplies/item-types') }}">Item Types</a></li>
                        <li><a href="{{ url('/admin/dashboard/supplies/items') }}">Items</a></li>
                        <li><a href="{{ url('/admin/dashboard/supplies/inventory') }}">Inventory</a></li>
                    </ul>

                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-plus-square"></i>
                        <span>Requests</span><i class="fa fa-angle-left pull-right"></i>
                        <span class="label label-primary pull-right"></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/dashboard/requests') }}">All</a></li>
                        <li><a href="{{ url('/admin/dashboard/requests/pending') }}">Pending</a></li>
                        <li><a href="{{ url('/admin/dashboard/requests/approved') }}">Approve</a></li>
                        <li><a href="{{ url('/admin/dashboard/requests/declined') }}">Decline</a></li>
                    </ul>

                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-bell-o"></i>
                        <span>Notification</span>
                        <span class="label label-primary pull-right">10</span>
                    </a>

                <li class="treeview">
                    <a href="{{url('/admin/dashboard/budget-histories')}}">
                        <i class="fa fa-history"></i>
                        <span>Budget History</span>
                        <span class="label label-primary pull-right">{{\App\Models\Requests::where('status','Pending')->count()}}</span>
                    </a>
                </li>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- main content -->
    @yield('content')

    @yield('footer')


</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
</script>
<!--preload-->
<script src="/assets/dist/js/preload.js"></script>
<script src="/assets/dist/js/queryLoader.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="/assets/plugins/select2/select2.full.min.js"></script>
<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- TableTools -->
<script src="//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.js"></script>
<script src = "//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.min.js"></script>

@yield('scripts')
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<!-- page script -->

</body>
</html>
