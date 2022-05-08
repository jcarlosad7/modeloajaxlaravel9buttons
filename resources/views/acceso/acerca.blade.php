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
                <h5 class="m-0">Acerca de</h5>
              </div>
              <div class="card-body">
                  <p><strong>Sistema web desarrollado por: </strong><a href="https://www.incanatoit.com" target="_blank" rel="noopener noreferrer">www.incanatoit.com</a></p>
                  <p><strong>Contacto: </strong>jcarlos.ad7@gmail.com</p>                
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
      $('#liAcerca').addClass("active");
      $('#aAcerca').addClass("active");
    </script>
    @endpush