
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLINICO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link  rel="shortcut icon"   href="{{asset('favicon.ico')}}" type="image/x-icon" />
  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css?cod='.date('Yidisus'))}}">
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/font.css')}}">
  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.min.css')}}">
  <script>
      window.App = {
          errors: {!! json_encode($errors->toArray()) !!},
          user: {!! json_encode(auth()->user()) !!}
      }
      @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
      @else
        window.Permissions = [];
      @endauth
  </script>
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!-- Message Start -->
            <div class="media">
              <i class="fas fa-user"></i>
              <div class="media-body">
                <h3 class="dropdown-item-title">
                   Cerrar sesión
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<div id="app">

  <menu-component></menu-component>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('cabecera')<!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section  class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>


<!-- fin modales -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; {{date("Y")}}</strong>, Desarrollado por:<strong> <a href="#">X</a></strong>. Todos los derechos reservados
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('js/app.js?cod='.date('Yidisus'))}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>

<!-- Bootstrap 4 -->
@yield('scripts')
</body>
</html>
