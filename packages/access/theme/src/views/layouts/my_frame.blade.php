<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Application') }}  @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!--select2-->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/plugins/fileinput/fileinput.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets/') }}/custom/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> <!-- jQuery 3 -->
    <!-- jQuery 3 -->
    <script src="{{ asset('admin_assets/') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('admin_assets/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin_assets/') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin_assets/') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin_assets/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin_assets/') }}/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- ckeditor -->
    <script src="{{ asset('admin_assets/') }}/bower_components/ckeditor/ckeditor.js"></script>
    <!--select2-->
    <script src="{{ asset('admin_assets/') }}/bower_components/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin_assets/') }}/plugins/fileinput/fileinput.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/') }}/dist/js/adminlte.min.js"></script>


    <script src="{{ asset('admin_assets/') }}/custom/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>A</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Bow</b>CMS</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                    <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('admin_assets/') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('admin_assets/') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since {{Auth::user()->created_at}}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @guest
    @else
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">
                        <a href="{{url('/')}}"><span>Go to Index Page</span>
                        </a>
                    </li>


                    {{-- Sidebar for Admin only --}}
                    @if(Auth::user()->scope->name == "Admin")                    
                    

                    <li class="treeview pages">
                        <a href="#">
                            <i class="fa fa-columns"></i> <span>Page</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="pages_create"><a href="{{url('admin/pages/create')}}"><i class="fa fa-circle-o"></i> Create Page</a></li>
                            <li class="pages_list"><a href="{{url('admin/pages')}}"><i class="fa fa-circle-o"></i> List Page</a></li>
                        </ul>
                    </li>

                    <li class="treeview posts types categories">
                        <a href="#">
                            <i class="fa fa-keyboard-o"></i>
                            <span>Posts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            <li class="types_create"><a href="{{url('admin/types/create')}}"><i class="fa fa-circle-o"></i> Create Type</a></li>
                            <li class="types_list"><a href="{{url('admin/types')}}"><i class="fa fa-circle-o"></i> List Type</a></li>
                            <li class="categories_create"><a href="{{url('admin/categories/create')}}"><i class="fa fa-circle-o"></i> Create Category</a></li>
                            <li class="categories_list"><a href="{{url('admin/categories')}}"><i class="fa fa-circle-o"></i> List Category</a></li>
                            <li class="posts_create"><a href="{{url('admin/posts/create')}}"><i class="fa fa-circle-o"></i> Create Post</a></li>
                            <li class="posts_list"><a href="{{url('admin/posts')}}"><i class="fa fa-circle-o"></i> List Post</a></li>
                        </ul>
                    </li>

                    <li class="treeview comments">
                        <a href="#">
                            <i class="fa fa-pencil-square"></i> <span>Comments</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="comments_create"><a href="{{url('admin/comments/create')}}"><i class="fa fa-circle-o"></i> Create Comments</a></li>
                            <li class="comments_list"><a href="{{url('admin/comments')}}"><i class="fa fa-circle-o"></i> List Comments</a></li>
                        </ul>
                    </li>

                    <li class="treeview subscribers">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Subscriber</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="messages_list"><a href="{{url('admin/messages')}}"><i class="fa fa-circle-o"></i> Messages </a></li>
                            <li class="subscribers_list"><a href="{{url('admin/subscribers')}}"><i class="fa fa-circle-o"></i> Subscribers </a></li>
                        </ul>
                    </li>

                    <li class="treeview users">
                        <a href="#">
                            <i class="fa fa-pencil-square"></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="scope_create"><a href="{{url('admin/scopes/create')}}"><i class="fa fa-circle-o"></i>Add Scope</a></li>
                            <li class="scope_list"><a href="{{url('admin/scopes')}}"><i class="fa fa-circle-o"></i> List Scopes</a></li>
                            <li class="users_create"><a href="{{url('admin/users/create')}}"><i class="fa fa-circle-o"></i> Create Users</a></li>
                            <li class="users_list"><a href="{{url('admin/users')}}"><i class="fa fa-circle-o"></i> List Users</a></li>
                        </ul>
                    </li>

                    <li class="treeview media galleries">
                        <a href="#">
                            <i class="fa fa-file-movie-o"></i> <span>Media</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="media_create"><a href="{{url('admin/media/create')}}"><i class="fa fa-circle-o"></i> Create Media</a></li>
                            <li class="media_list"><a href="{{url('admin/media')}}"><i class="fa fa-circle-o"></i> Media List</a></li>
                            <li class="galleries_create"><a href="{{url('admin/galleries/create')}}"><i class="fa fa-circle-o"></i> Create Gallery</a></li>
                            <li class="galleries_list"><a href="{{url('admin/galleries')}}"><i class="fa fa-circle-o"></i> Galleriy List</a></li>
                            <li class="gallery_media_create"><a href="{{url('admin/gallery_media_create')}}"><i class="fa fa-circle-o"></i>Add Media in Gallery</a></li>
                        </ul>
                    </li>


                    {{--
                    <li class="treeview advertisement">
                        <a href="#">
                            <i class="fa fa-image"></i>
                            <span>Advertisement</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="advertisement-create"><a href="{{url('admin/advertises/create')}}"><i class="fa fa-circle-o"></i> Create Advertise</a></li>
                            <li class="advertisement-list"><a href="{{url('admin/advertises')}}"><i class="fa fa-circle-o"></i> List Advertise</a></li>
                        </ul>
                    </li>

                    <li class="treeview seos">
                        <a href="#">
                            <i class="fa fa-google"></i>
                            <span>Seo</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="seos-create"><a href="{{url('admin/seos/create')}}"><i class="fa fa-circle-o"></i> Create Seo</a></li>
                            <li class="seos-list"><a href="{{url('admin/seos')}}"><i class="fa fa-circle-o"></i> List Seo</a></li>
                        </ul>
                    </li>
                    --}}

        <li class="treeview setup">
                        <a href="#">
                            <i class="fa fa-gg"></i> <span>Setup</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="setup_list"><a href="{{url('admin/setup')}}"><i class="fa fa-circle-o"></i> Setup</a></li>
                        </ul>
                    </li>

                    <li class="treeview themes">
                        <a href="#">
                            <i class="fa fa-newspaper-o"></i> <span>Theme</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="theme_list"><a href="{{url('admin/themes')}}"><i class="fa fa-circle-o"></i> Themes </a></li>
                        </ul>
                    </li>
                    @endif
                    {{-- Sidebar for other
                    @if(Auth::user()->scope->name == "Other")                                      
                    
                    @include('sidebar.other_menu')
                    @endif  --}}

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
@endguest

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @if(Session::has('success'))
            <div class="container alert alert-success" style="margin-top: 20px">
                {{Session::get('success')}}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="container alert alert-danger" style="margin-top: 20px">
                {{Session::get('error')}}
            </div>
            @endif

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014- <?php echo date("Y")?> <a href="#">Global Interface </a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
