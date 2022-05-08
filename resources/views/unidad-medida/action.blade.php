@can('unidadMedida-editar')
<a href="javascript:void(0)" id="edit" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-warning btn-sm">
    <i class="fas fa-edit"></i>
</a>
@endcan
@can('unidadMedida-eliminar')
<a href="javascript:void(0);" id="delete" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
</a>
@endcan
<div class="modal fade" id="modal-eliminar-{{ $id }}">
    <div class="modal-dialog">
        @csrf
        @method('DELETE')
        <div class="modal-content bg-danger">        
            <div class="modal-header">
                <h4 class="modal-title">Eliminar registro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro {{$nombre}} ?
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                <button type="button" onClick="eliminar({{$id}})" class="btn  btn-danger btn-outline-light">Eliminar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>