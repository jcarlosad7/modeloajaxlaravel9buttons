<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>seSecodisa- Sistema estandarizado SECODISA</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    
    <!-- Datatables -->    
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
    <!--
    <style>
      .sidebar-dark-blue{
        background: #455279 !important;
      }
    </style>
    -->
    @stack('estilos')
  </head>
  <body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @can('rol-listar')
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('rol.index')}}" class="nav-link"><i class="fas fa-file text-blue"></i> Roles</a>
        </li>
        @endcan
        @can('usuario-listar')
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('usuario.index')}}" class="nav-link"><i class="fa fa-user text-success"></i> Usuarios</a>
        </li> 
        @endcan       
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-user text-warning"></i> {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt text-danger"></i> Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('img/logo.png')}}" alt="Secodisa Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Secodisa</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <!--Inicio Menú admin-->
            <li id="liEscritorio" class="nav-item">
              <a id="aEscritorio" href="{{route('escritorio')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Escritorio
                </p>
              </a>
            </li>
            <li class="nav-header">General</li>
            <li id="liSeguridad"class="nav-item">
              <a id="aSeguridad" href="#" class="nav-link">
                <i class="nav-icon fa fa-users-cog"></i>
                <p>
                  Seguridad
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              @can('usuario-listar')
              <li class="nav-item">
                  <a id="liUsuario" href="{{route('usuario.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                @endcan
                @can('rol-listar')
                <li class="nav-item">
                  <a id="liRol" href="{{route('rol.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            <li id="liAcerca" class="nav-item">
              <a id="aAcerca" href="{{route('acercade')}}" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <p>
                  Acerca de
                </p>
              </a>
            </li>
            <!--Fin Menú admin-->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <!--
        <div class="m-3">
        </div>
        
      -->
      <div class="content-header">
            
      </div>
      
      <!-- /.content-header -->
      @yield('contenido')  
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        @Secodisa
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2022 <a href="https:incanatoit.com">IncanatoApps</a>.</strong> Derechos reservados.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  <!-- Datatables -->
  <!--<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>-->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>  
  <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  
  <!-- Toastr -->
  <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
  <!--
  <script src="{{asset('js/datatables/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('js/datatables/jszip.min.js')}}"></script>
  <script src="{{asset('js/datatables/pdfmake.min.js')}}"></script>
  <script src="{{asset('js/datatables/vfs_fonts.js')}}"></script>
  <script src="{{asset('js/datatables/buttons.html5.min.js')}}"></script>
    -->
  <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    -->
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>
  
  <!-- scripts de cada vista -->
  @stack('scripts')
  </body>
</html>