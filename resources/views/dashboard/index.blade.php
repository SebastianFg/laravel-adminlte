@extends('layouts.master')
{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Búsqueda</h3>
            
{{--                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div> --}}
            </div>
            <div class="card-body">
              <form action="#" class="form-group" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Marca</label>
                      <select name="dependencia" id="id_marca" name="marca" class="form-control ">
                        <option value="" selected="">Seleccione una marca</option>
                        @foreach ($marca as $item)
                          <option value="{{ $item->marca }}">{{ $item->marca }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Año</label>
                      <br>
                      <select name="anio" id="id_anio"  class="form-control ">
                        <option value="" selected="">Seleccione un año</option>
                        @foreach ($anios as $item)
                          <option value="{{ $item->anio_de_produccion }}">{{ $item->anio_de_produccion }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label>Dominio</label>
                    <br>
                    <input type="text" name="dominio" id="id_dominio" placeholder="ingrese dominio" required class="form-control ">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Nº de identificación</label>
                      <br>
                      <input type="text" name="dominio" id="id_identificacion" placeholder="ingrese numero de identificación" required class="form-control ">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Seleccione Afectado</label>
                      <div id="select">
                          <select type="text" class="form-control" id="id_afectado" data-width="100%" name="id_afectado">
                          </select>
                      </div>
                    </div>
                  </div>
                <!-- /.row -->
                </div>
             </form>

            <!-- /.card body -->
            </div>
            <div class="card-body">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <button class="btn btn-success col-md-2 d-inline" style="padding: 5px;" id="btnBuscar" >
               <i class="glyphicon glyphicon-search">Buscar</i>
               
             </button>
              <button class="btn btn-warning col-md-2 d-inline" style="padding: 5px;" id="limpiar"> <i class="fa fa-paint-brush"> Limpiar</i> </button>
              <hr>
              <div id="tablaResultado"></div>
            </div>
          {{-- card --}}
          </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
  <!-- /.content -->
  </div>
  {{-- final --}}
</div>

@endsection

@section('javascript')
<!-- jQuery -->

<script src="/js/personalizado.js"></script>
<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/dist/plugins/chart.js/Chart.min.js"></script>
<script src="/dist/js/demo.js"></script>
<script src="/dist/js/pages/dashboard3.js"></script>
@stop
