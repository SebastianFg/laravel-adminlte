@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<title>@yield('titulo', 'Patrimonio') | Asignación</title>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <title>@yield('titulo', 'Patrimonio') | Jefatura</title>
  <!-- /.content-headesr -->
@php
$contador = 1;
@endphp

  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">


            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Lista de vehiculos por tipo</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="Numero de identificación">
                        </div>
                        <div class="form-group">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                        </div>
                         
                      </div>
                    </form>
                  </div>
                  <div class="row table-responsive ">
                        <table tableStyle="width:auto" id="tablaResultado" class="table table-striped table-hover table-sm table-condensed table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Marca</th>
                              <th>Año</th>
                              <th>Dominio</th>
                              <th>Motor</th>
                              <th>Chasis</th>
                              <th>N de identificacion</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($detalleTipo as $item)
                        
                              <tr>
                                <td>{{$contador}}</td>
                                <td>{{ $item->marca }}</td>
                                <td>{{ $item->anio_de_produccion }}</td>
                                <td>{{ $item->dominio }}</td>
                                <td>{{ $item->motor }}</td>
                                <td>{{ $item->chasis }}</td>
                                <td>{{ $item->numero_de_identificacion }}</td>
                               
                                <td>
                                  @can('vehiculos.informacion')
                                    <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                                  @endcan
                                </td>
                              
                              </tr>
                              @php
                                $contador ++;
                              @endphp
                            @endforeach
                          </tbody>
                        </table>
                       
                  </div>
                </div>
              </div>
                          </div>
          {{-- card --}}
          </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
  @endif
  <!-- /.content -->
  </div>
  {{-- final --}}
</div>

@endsection

@section('javascript')
<!-- jQuery -->

<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

{{-- select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 

@stop
