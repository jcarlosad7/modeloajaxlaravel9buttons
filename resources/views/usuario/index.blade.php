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
                <h5 class="m-0">Usuarios @can('usuario-crear')<a href="{{route('usuario.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>@endcan <!--<a href="" class="btn btn-success"><i class="fas fa-file-csv"></i> CSV</a> --></h5>
              </div>
              <div class="card-body">
                <form action="{{route('usuario.index')}}" method="get">
                <div class="input-group">
                    <input name="texto" type="text" class="form-control" value="{{$texto}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>                      
                    </div>
                </div>
                </form>
                @if(Session::has('mensaje'))
                  <div class="alert alert-info alert-dismissible fade show mt-2">
                      <span class="alert-icon"><i class="fa fa-info"></i></span>
                      <span class="alert-text">{{Session::get('mensaje')}}</span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif
                @if(Session::has('error'))
                  <div class="alert alert-warning alert-dismissible fade show mt-2">
                      <span class="alert-icon"><i class="fa fa-times"></i></span>
                      <span class="alert-text">{{Session::get('error')}}</span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif
                @if(count($registros)<=0)
                <div class="alert alert-secondary mt-2" role="alert">
                  No hay registros para mostrar
                </div>
                @else
                <div class="mt-2 table-responsive">
                  <table class="table table-striped table-bordered table-hover table-sm">
                      <thead>
                          <tr>
                            <th style="width: 20%">Opciones</th>
                            <th style="width: 40%">Nombre</th>
                            <th style="width: 20%">Email</th>
                            <th style="width: 20%">Rol</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($registros)<=0)
                          <tr>
                              <td colspan="3">No hay resultados</td>
                          </tr>
                          @else
                          @foreach ($registros as $reg)
                          <tr>
                            <td>
                            @can('usuario-editar')
                              <a href="{{route('usuario.edit',['usuario'=>$reg->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a> 
                            @endcan
                            @can('usuario-eliminar')
                              <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{$reg->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            @endcan
                            </td>
                            <td>{{$reg->name}}</td>
                            <td>{{$reg->email}}</td>
                            <td>@if(!empty($reg->getRoleNames()))
                                @foreach($reg->getRoleNames() as $v)
                                  <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                              @endif</td>
                          </tr>
                          @can('usuario-desactivar')
                            @include('usuario.delete')
                          @endcan
                          @endforeach
                          @endif
                      </tbody>
                  </table>
                  {{$registros->appends(["texto" => $texto])}}
                </div>
                @endif
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
      $('#liSeguridad').addClass("menu-open");      
      $('#liUsuario').addClass("active");
      $('#aSeguridad').addClass("active");
    </script>
    @endpush