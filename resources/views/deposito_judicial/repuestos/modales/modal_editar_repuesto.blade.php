<div class="panel panel-success"> 
  <div class="modal fade" id="modalEditarRepuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Editar repuesto DP</h4>
        </div>
        @if(!$errors->isEmpty())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach()
            </ul>
          </div>
        @endif
        <div class="modal-body col-md-12">
          <form action="{{ route('editarRepuestoDP') }}" class="form-group" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="id_usuario" readonly="" hidden="" placeholder="Entregado por" required class="form-control " value="{{ Auth::User()->id }}">

            <input type="text" name="id_detalle_repuesto" id="id_detalle_repuesto" readonly="" hidden="">
            <div class="form-group col-md-12">
                <label for="">Repuestos entregados</label>
                <textarea type="text" name="repuestos_entregados_editar" id="id_repuestos_entregados_editar" autocomplete="off" placeholder="Repuestos entregados" class="form-control" required value="{{ old('repuestos_entregados') }}"></textarea>
            </div>
            <div class="col-md-12 modal-footer" style="position:relative;">
                <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-4 d-inline" href="{{ route('indexDPRepuestos') }}">Cancelar</a>
            </div>
                              
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


