@extends('layouts.menu')
@push('estilos')
<!--<meta name="csrf-token" content="{{ csrf_token() }}">-->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap5-theme/select2-bootstrap-5-theme.min.css')}}">
@endpush
@section('contenido')
<!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Usuario</h5>
              </div>
              <div class="card-body">
                @if ($errors->any())
                  <div class="col-sm-7">
                      <div class="alert alert-danger alert-sm">
                          <ul>
                              @foreach($errors->all() as $error)
                                  <li>{{$error}}</li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
                @endif
                <form action="{{route('usuario.update',['usuario'=>$registro])}}" method="post">
                    @method('PUT')
                    @csrf
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nombre (*)</label>
                            <input name="name" required value="{{$registro->name}}" class="form-control form-control-sm" type="text" placeholder="">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Email (*)</label>
                            <input name="email" required value="{{$registro->email}}" class="form-control form-control-sm" type="email" placeholder="">
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Password (*)</label>
                            <input name="password" required value="{{$registro->password}}" class="form-control form-control-sm" type="password" placeholder="">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Confirmar Password (*)</label>
                            <input name="confirm-password" required value="" class="form-control form-control-sm" type="password" placeholder="">
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Rol (*)</label>
                            <select name="roles[]" class="select2bs4" multiple="multiple" data-placeholder="Seleccione un rol" style="width: 100%;">
                              @foreach($roles as $rol)
                                @if (in_array($rol, $usuarioRoles)) 
                                <option selected value="{{$rol}}">{{$rol}}</option>
                                @else
                                <option value="{{$rol}}">{{$rol}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
                            <a href="{{route('usuario.index')}}" class="btn btn-default"><i class="fas fa-window-close"></i> Cancelar</a>
                        </div>
                      </div>
                  </div>
                </form>                 
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
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>    
    <script>
      $('#liSeguridad').addClass("menu-open");      
      $('#liUsuario').addClass("active");
      $('#aSeguridad').addClass("active");
      $("select").select2({
          theme: "bootstrap-5",
      });
    </script>
    @endpush