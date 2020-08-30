@php

session_start();

@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ MetaTag::get('title') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
  <!-- LightBox CSS -->
  <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/plugins/summernote/summernote-bs4.css') }}">
  <!-- Formstone Upload -->
  <link rel="stylesheet" href="{{ asset('/css/upload.css') }}">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  <script type="text/javascript">
    $.ajaxSetup({
      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    })
  </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('shop.pages.home-page.index') }}" class="nav-link"><i class="fas fa-undo"></i> Вернуться</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img style="height: 34px; width: 34px;" src="{{ url('https://w7.pngwing.com/pngs/201/241/png-transparent-emoji-clown-youtube-emoticon-pennywise-the-clown-smiley-smile-nose.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{ route('shop.admin.dashboard.index') }}" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav id="sidebar" class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ route('shop.admin.dashboard.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('Главная') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('shop.admin.orders.index') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                {{ __('Заказы') }}
                <span class="badge badge-info right">{{ $countNewOrders }}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link treeview">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                {{ __('Товары') }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="{{ route('shop.admin.products.index') }}" class="nav-link has-treeview">
                  <i class="far fas fa-list nav-icon"></i>
                  <p>{{ __('Список товаров') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('shop.admin.products.create') }}" class="nav-link has-treeview">
                  <i class="far fas fa-plus nav-icon"></i>
                  <p>{{ __('Добавить товар') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('shop.admin.categories.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                {{ __('Категории') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('shop.admin.users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                {{ __('Пользователи') }}
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

    <!-- breadcrumbs -->
    @yield('breadcrumbs')
    <!-- /breadcrumbs -->

    <!-- Main content -->
    <section class="content">

      @if(count($errors))
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
          @endforeach
        </ul>
      </div>
      @endif
      @if(session()->has('error'))
      <div class="alert alert-danger">
        <ul>
          <li>
            {{ session('error') }}
          </li>
        </ul>
      </div>
      @endif
      @if(session()->has('success'))
      <div class="alert alert-success">
        <li>
          {{ session('success') }}
        </li>
      </div>
      @endif

      @yield('content')
    </section>
    <!-- /Main content -->
    
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>
    <!-- LightBox JS -->
    <script type="text/javascript" src="{{ asset('/js/lightbox.js') }}"></script>

    <script>

      $('.sidebar a').each(function() {
        var pathname = window.location.pathname;
        var path =  pathname.split('/')[1] + '/' + pathname.split('/')[2];
        if(pathname.split('/')[2] == 'products' && pathname.split('/')[3] == 'create'){
          var location = window.location.protocol + '//' + window.location.host + pathname;
        }
        else {
          var location = window.location.protocol + '//' + window.location.host + '/' + path;
        }
        console.log(location);
        var link = $(this).attr('href');
        var elClass = $(this).attr('class');
        if (link === location) {
          $(this).addClass('active');
          if(elClass == 'nav-link has-treeview') {
            $(this).parent().parent().parent().find('a.treeview').addClass('active');
            $(this).parent().parent().parent().addClass('menu-open');
          }
        }
      }); 

    </script>

    @yield('scripts')

  </body>
  </html>
