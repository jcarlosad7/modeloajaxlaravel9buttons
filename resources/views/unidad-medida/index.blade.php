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
                <h5 class="m-0">Unidades de Medida @can('unidadMedida-crear')<a href="javascript:void(0)" id="btnCrearNuevo" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>@endcan <!--<a href="" class="btn btn-success"><i class="fas fa-file-csv"></i> CSV</a> --></h5>
              </div>
              <div class="card-body">
                <div class="mt-2">
                  <table class="table table-striped table-bordered table-hover table-sm" style="width:100%" id="datatable-lista">
                      <thead>
                          <tr>
                            <th style="width: 10%">Id</th>
                            <th style="width: 20%">Opciones</th>
                            <th style="width: 60%">Nombre</th>
                          </tr>
                      </thead>
                  </table>                 
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!--Modal -->
    <div class="modal fade" id="modalRegistro" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalTitulo">Nueva Unidad de Medida</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="javascript:void(0)" id="formAddEdit" class="form-horizontal">
          @csrf
          <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>           
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nombre(*)</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="" maxlength="70" required="">
                    </div>
                </div>            
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btnGuardar" value="addNuevo" class="btn btn-primary">Guardar</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin Modal -->
    @endsection
    @push('scripts')
    <script>
      $('#liAlmacen').addClass("menu-open");
      $('#aAlmacen').addClass("active");     
      $('#liUnidadMedida').addClass("active");
    </script>
    <script>
      var _token = $("input[name='_token']").val();
      $(document).ready( function () {                    
            $('#datatable-lista').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('unidad-medida')}}",
                  columns: [
                      {data: 'id', name: 'id', 'visible': false},
                      {data: 'action', name: 'action', orderable: false},
                      {data: 'nombre', name: 'nombre' },
                  ],
                  order: [[0, 'desc']],
                  dom: 'Blfrtip',
                  "responsive": true, "lengthChange": false, "autoWidth": false,
                  buttons: [
                  {
                      extend: 'copyHtml5',
                      exportOptions: {
                        columns: [ 0, 2]
                      }
                  },
                  {
                      extend: 'csvHtml5',
                      exportOptions: {
                          columns: [ 0, 2]
                      }
                  },
                  {
                      extend: 'excelHtml5',
                      exportOptions: {
                          columns: [ 0, 2]
                      }
                  },
                  {
                      extend: 'pdfHtml5',
                      exportOptions: {
                          columns: [ 0, 2]
                      }
                  },
                  'colvis'
              ],
                  "language": {
                      "lengthMenu": "Visualizando _MENU_ registros por página",
                      "zeroRecords": "No hay registros para mostrar",
                      "info": "Mostrando página _PAGE_ de _PAGES_",
                      "infoEmpty": "No hay registros disponibles",
                      "infoFiltered": "(Filtrado de _MAX_ registros)",
                      "search": "Buscar"
                  }
            });
            //Click en el botón crear nuevo
            $('#btnCrearNuevo').click(function () {
              $('#formAddEdit').trigger("reset");
              $('#modalTitulo').html("Agregar");              
              $('#modalRegistro').modal('show');
              $("#nombre").focus();
              $('.alert-danger').empty();
              $('.alert-danger').hide();
            });
            //Click en el botón editar del listado
            $('body').on('click', '.edit', function () {
                var id = $(this).data('id');
                $('.alert-danger').empty();
                $('.alert-danger').hide();               
                // ajax
                $.ajax({
                    type:"GET",
                    url: "{{ route('unidad-medida-editar')}}",
                    data: { _token : _token,id: id },
                    dataType: 'json',
                    success: function(res){
                      $('#modalTitulo').html("Editar");
                      $('#modalRegistro').modal('show');
                      $('#id').val(res.id);
                      $('#nombre').val(res.nombre);
                      $("#btnGuardar").html('Editar');
                  }
                });
            });
            //Click en el botón eliminar
            $('body').on('click', '.delete', function () {
              var id = $(this).data('id');
              $('#modal-eliminar-'+id).modal('show');
            });
            //Click en el botón guardar
            $('body').on('click', '#btnGuardar', function (event) {
                  var mensaje="Registrado correctamente";
                  var id = $("#id").val();
                  var nombre = $("#nombre").val();
                  $("#btnGuardar").html('Porfavor espere...');
                  $("#btnGuardar"). attr("disabled", true);
                  if(id!=""){
                    mensaje="Editado correctamente";
                  }
                  // ajax
                  $.ajax({
                    type:"POST",
                    url: "{{ route('unidad-medida-guardar')}}",
                    data: {
                      _token : _token,
                      id:id,
                      nombre:nombre,                      
                    },
                    dataType: 'json',
                    success: function(res){
                      if(res.errors){
                        $('.alert-danger').empty();
                        $.each(res.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>'+value+'</p>');
                        });
                        $("#btnGuardar").html('Guardar');
                        $("#btnGuardar"). attr("disabled", false);
                      }else{
                        $("#modalRegistro").modal('hide');
                        var oTable = $('#datatable-lista').dataTable();
                        oTable.fnDraw(false);
                        $("#btnGuardar").html('Guardar');
                        $("#btnGuardar"). attr("disabled", false);
                        $("#id").val('');
                        $('.alert-danger').empty();
                        $('.alert-danger').hide();
                        toastr.success(mensaje)
                      }   
                  }
                });
            });
      });
      function eliminar(id){
        $.ajax({
          type:"POST",
          url: "{{ route('unidad-medida-eliminar')}}",
          data: { _token : _token,id: id },
          dataType: 'json',
          success: function(res){
            var oTable = $('#datatable-lista').dataTable();
            oTable.fnDraw(false);
            $("#modal-eliminar-"+id).modal('hide');
            toastr.success('Eliminado correctamente')
        }
      });
      }
    </script>
    @endpush