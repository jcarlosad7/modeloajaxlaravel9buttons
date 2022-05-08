<div class="modal fade" id="modal-eliminar-{{$reg->id}}">
    <div class="modal-dialog">
        <form action="{{route('rol.destroy',$reg->id)}}" method="post">
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
                Deseas eliminar el registro {{$reg->name}} ?
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn  btn-danger btn-outline-light">Eliminar</button>
            </div>
        </div>        
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>