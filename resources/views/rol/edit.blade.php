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
                <h5 class="m-0">Rol</h5>
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
                <form action="{{route('rol.update',['rol'=>$registro])}}" method="post">
                    @method('PUT')
                    @csrf
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Nombre (*)</label>
                            <input name="name" required value="{{$registro->name}}" class="form-control form-control-sm" type="text" placeholder="">
                        </div>
                      </div> 
                  </div>
                  <?php
                    $cabeceras = array();
                    $detalles = array();
                  ?>
                  @foreach ($permissions as $per)
                    <?php
                    $first = strtok($per->name, '-');
                    array_push($cabeceras, $first);
                    array_push($detalles, (object)[
                      'id' => $per->id,
                      'nombre' => $per->name,
                      'grupo' => $first
                    ]);
                    ?>
                  @endforeach
                  <?php
                  $cabeceras = array_unique($cabeceras);
                  ?>
                  <div class="row">
                  @foreach ($cabeceras as $cab)
                      <div class="col-lg-3">
                        <div class="card">
                          <div class="card-header">
                            {{ucfirst($cab)}}
                          </div>
                          <div class="card-body">
                          <ul class="list-group">
                          @foreach ($detalles as $det)
                            @if ($det->grupo==$cab)
                            <li class="list-group-item">  
                              @if (in_array($det->id, $rolePermissions))                          
                              <input type="checkbox" checked name="permission[]" value="{{$det->id}}"> {{$det->nombre}}<br>
                              @else
                              <input type="checkbox" name="permission[]" value="{{$det->id}}"> {{$det->nombre}}<br>
                              @endif
                            </li>
                            @endif
                          @endforeach
                          </ul>
                          </div>
                        </div>
                      </div>
                  @endforeach
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
                            <a href="{{route('rol.index')}}" class="btn btn-default"><i class="fas fa-window-close"></i> Cancelar</a>
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
    <script>
      $('#liSeguridad').addClass("menu-open");      
      $('#liRol').addClass("active");
      $('#aSeguridad').addClass("active");
    </script>
    @endpush