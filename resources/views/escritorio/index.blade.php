@extends('layouts.menu')
@section('contenido')
<!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Dashboard</h5>
              </div>
              <div class="card-body">
              Bienvenido al Sistema estandarizado SECODISA.                
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @endsection
    @push('scripts')
    <script>    
      $('#liEscritorio').addClass("active");
      $('#aEscritorio').addClass("active");
    </script>
    @endpush