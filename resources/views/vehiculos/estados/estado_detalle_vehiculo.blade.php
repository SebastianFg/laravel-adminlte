@extends('plantilla')

@section('seccion')
<div class="panel panel-success">
  <div class="panel-heading">Baja de vehiculo</div>

    @if(!$errors->isEmpty())
    <div class="alert alert-danger">
      <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach()
      </ul>
    </div>
      @endif
      <div>
    <form action="{{ route('eliminarVehiculos', $vehiculoEnProcesoDeEliminacion->id_vehiculo) }}" class="form-group" method="POST"enctype="multipart/form-data" >
      @method('PUT')
          @csrf
      <div class="panel-body">
          <div class="form-group col-md-6"  >
        
              <label>Vehiculo</label>
              <input type="text" readonly="" class="form-control col-md-4" value="Dominio: {{ $vehiculoEnProcesoDeEliminacion->dominio }}">
              <input type="text" readonly="" style="visibility:hidden" value="{{ $vehiculoEnProcesoDeEliminacion->id_vehiculo }}" class="form-control col-md-4"  name="vehiculo_id">
          </div>
          <div class="form-group col-md-6">
              <label for="">Fecha</label>
              <input type="datetime" readonly="" value="<?php echo date("d-m-Y H:i:s");?>"  name="fecha" min="<?php echo date("Y-m-d");?>" class="form-control" required >
          </div> 
          <div class="form-group col-md-12">
              <label for="">Motivo de baja</label>
              <textarea type="text" name="motivo_de_baja" placeholder="Motivo de la baja" class="form-control" value="{{ old('observaciones') }}"></textarea>
              {{-- <input type="text" name="otros" placeholder="Otras Caracteristicas" class="form-control" required value="{{ old('otros') }}"> --}}
          </div>

          <div class="col-md-12 modal-footer" >
              <button class="btn btn-success col-md-2 d-inline" type="submit">Guardar</button>
              <a class="btn btn-danger col-md-2 d-inline" href="{{ route('listadoEstadoVehiculo') }}">Cancelar</a> 
          </div>
        </div>
    </form>
 </div>
@endsection
