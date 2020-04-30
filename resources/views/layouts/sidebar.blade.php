
@if(Auth::User()->primer_logeo == null)
@else

<!-- Main Sidebar Container -->
<aside class=" sticky-top main-sidebar sidebar-dark-primary elevation-5" style="min-height: 2631.04px;">
    <div class="sidebar-header">
        <!-- Brand Logo -->
        <a href="{{ route('inicio') }}" class="brand-link">
            <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
           style="opacity: .8">
            <span class="brand-text font-weight-light">Patrimonio</span>
        </a>

    </div>

    <!-- Sidebar -->
    <section class="sidebar" >
        <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <p class="textoBlanco">{{Auth::User()->nombre}}</p>
                <a href="#" id="id_jerarquia" class="d-block"> </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills  nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('inicio') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                          Inicio
                        </p>
                    </a>
                </li>
                @can('usuarios.listaUsuarios')
                <li class="nav-item has-treeview {{ request()->is('permisos*') ? 'menu-open' : '' }}  {{ request()->is('usuarios*') ? 'menu-open' : '' }} {{ request()->is('roles*') ? 'menu-open' : '' }} {{ request()->is('users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                          Usuarios y permisos
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{ route('listaUsuarios') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{ route('listaRoles') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{ route('listaPermisos') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Permisos</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    @endcan
                    @can('usuarios.asignarPermisosARoles')
                    <ul class="nav nav-treeview">
                        <ul>
                            <li class="nav-item noPuntos">
                                <a href="{{ route('rolPermisos') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Roles permisos</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    @endcan
                </li>
                @can('deposito.index')
                <li class="nav-item has-treeview {{ request()->is('deposito_judicial*') ? 'menu-open' : '' }}{{ request()->is('asignacion_deposito_judicial*') ? 'menu-open' : '' }}{{ request()->is('siniestros-deposito-judicial') ? 'menu-open' : '' }}{{ request()->is('detalleVehiculoDP*') ? 'menu-open' : '' }} {{ request()->is('repuestos-deposito-judicial') ? 'menu-open' : '' }}{{ request()->is('juzgados*') ? 'menu-open' : '' }}{{ request()->is('detalle-deposito-judicial') ? 'menu-open' : '' }}{{ request()->is('fuera-de-servicio-deposito-judicial') ? 'menu-open' : '' }}{{ request()->is('baja-definitiva-deposito-judicial') ? 'menu-open' : '' }}{{ request()->is('historial-completo-deposito-judicial') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>
                          Deposito Judicial
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{route('detallesJuzgadosVehiculos')}}" class="nav-link">
                                    <i class="fa fa-info nav-icon"></i>
                                    <p>Informe DP</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{route('indexDepositoJudicial')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Alta DP</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{route('listaAsignacionJudicial')}}" class="nav-link">
                                    <i class="fa fa-share nav-icon"></i>
                                    <p>Asignar DP</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            <li class="nav-item noPuntos">
                                <a href="{{route('indexDPRepuestos')}}" class="nav-link">
                                    <i class="fas fa-screwdriver nav-icon"></i>
                                    <p>Repuestos DP</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{route('indexSiniestrosDP')}}" class="nav-link">
                                    <i class="fas fa-car-crash nav-icon"></i>
                                    <p>Siniestros DP</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    @can('estados_deposito_judicial.index')
                    <ul class="nav nav-treeview">
                        <ul >

                                <li class="nav-item noPuntos" >
                                    <a href="{{ route('indexEstadoFueraServicioDP') }}" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Fuera de servicio DP</p>
                                    </a>
                                </li>
                        </ul>
                        
                    </ul>
                    <ul class="nav nav-treeview">
                        <ul >
                                <li class="nav-item noPuntos" >
                                    <a href="{{ route('listadoEstadoBajaDefinitivaDP') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Baja definitiva DP</p>
                                    </a>
                                </li>
                        </ul>
                        
                    </ul>
                    <ul class="nav nav-treeview">
                        
                        <ul >
                                <li class="nav-item noPuntos">
                                    <a href="{{ route('historialCompletoDP') }}" class="nav-link">
                                        <i class="fas fa-history nav-icon"></i>
                                        <p>Historial completo DP</p>
                                    </a>
                                </li>
                        </ul>
                    </ul>
                    @endcan
                    @can('juzgado.index')
                    <ul class="nav nav-treeview">
                        <ul>
                            
                            <li class="nav-item noPuntos">
                                <a href="{{route('indexJuzgado')}}" class="nav-link">
                                    <i class="fas fa-balance-scale nav-icon"></i>
                                    <p>Juzgados</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    @endcan
                    @endcan

                </li>
                @can('dependencias.dependencias')
                <li class="nav-item has-treeview">
                    <a href="{{ route('indexDependencia') }}" class="nav-link">
                        <i class="nav-icon fa fa-codepen"></i>
                        <p>
                          Dependencias
                        </p>
                    </a>
                </li>
                @endcan
                @can('municipios.index')
                <li class="nav-item has-treeview">
                    <a href="{{ route('indexMunicipios') }}" class="nav-link">
                        <i class="nav-icon fa fa-map-marker"></i>
                        <p>
                          Municipios
                        </p>
                    </a>
                </li>
                @endcan
                @can('vehiculos.indexMarca')

                <li class="nav-item has-treeview">
                    <a href="{{ route('indexMarcas') }}" class="nav-link">
                        <i class="nav-icon fa fa-codepen"></i>
                        <p>
                          Marcas vehículos
                        </p>
                    </a>
                </li>
                @endcan 
                @can('vehiculos.index')
                {{-- con el request->is nos sirve para mantener abierto el menu si es que estamos en el menu propiamente dicho --}}
                <li class="nav-item has-treeview  {{ request()->is('reportes*') ? 'menu-open' : '' }} {{ request()->is('repuestos') ? 'menu-open' : '' }} {{ request()->is('siniestros') ? 'menu-open' : '' }} {{ request()->is('asignacion') ? 'menu-open' : '' }} {{ request()->is('historial_completo*') ? 'menu-open' : '' }}  {{ request()->is('baja_definitiva*') ? 'menu-open' : '' }}  {{ request()->is('fuera_de_servicio*') ? 'menu-open' : '' }}  {{ request()->is('alta_vehiculos*') ? 'menu-open' : '' }} {{ request()->is('tipo_vehiculos*') ? 'menu-open' : '' }}  ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-car"></i>
                        <p>
                          Vehículos
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <ul>
                            <li class="nav-item noPuntos" >
                                <a href="{{ route('listaVehiculos') }}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Alta</p>
                                </a>
                            </li>
                        </ul>
  

                    <li class="nav-item has-treeview">
                        <a href="{{ route('listaTipoVehiculos') }}" class="nav-link">
                            <i class="nav-icon fa fa-asterisk"></i>
                            <p>
                              Tipo de vehículos
                 
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('estados.estadoIndex')
                    <li class="nav-item has-treeview {{ request()->is('historial_completo*') ? 'menu-open' : '' }}  {{ request()->is('baja_definitiva*') ? 'menu-open' : '' }}  {{ request()->is('fuera_de_servicio*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-times"></i>
                            <p>
                              Estados
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <ul>
                                
                                <li class="nav-item noPuntos" >
                                    <a href="{{ route('listadoEstadoVehiculo') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Fuera de servicio</p>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                        <ul class="nav nav-treeview">
                            <ul>
                                
                                <li class="nav-item noPuntos" >
                                    <a href="{{ route('listadoEstadoBajaDefinitiva') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Baja definitiva</p>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                        <ul class="nav nav-treeview">
                            <ul>
                                
                                <li class="nav-item noPuntos">
                                    <a href="{{ route('historialCompleto') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Historial completo</p>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </li>
                    @endcan
                    @can('vehiculos.listaAsignacion')
                    <li class="nav-item has-treeview" >
                        <a href="{{ route('listaAsignacion') }}" class="nav-link">
                            <i class="nav-icon fa fa-share"></i>
                            <p>
                              Asignar
                            
                            </p>
                        </a>
                    </li> 
                    @endcan
                    @can('vehiculos.siniestros')
                    <li class="nav-item has-treeview" >
                         <a href="{{ route('indexSiniestros') }}" class="nav-link">
                            <i class="nav-icon fa fa-road"></i>
                            <p>
                              Siniestros
           
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.repuestos')
                    <li class="nav-item has-treeview" >
                         <a href="{{ route('listaRepuestos') }}" class="nav-link">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                              Repuestos
                   
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.graficos')
                    <li class="nav-item has-treeview" >
                         <a href="{{ route('ListaGraficos') }}"  class="nav-link">
                            <i class="nav-icon fa fa-paste"></i>
                            <p>
                              Gráficos
                  
                            </p>
                        </a>
                    </li>
                    @endcan
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
@endif
<style type="text/css">
    .noPuntos{
        list-style:none;
    } 

    .sidebar {
      position: fixed;
      bottom: 0;

      width: 250px;

    }
    .sidebar_item:last-child {
      overflow-y:auto;
      height: calc( 100% - 215px);
    }
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #ff9d00;
        border-radius: 5px;
    }
    .textoBlanco{
        color:#FFF;
    }
</style>


<script src="/dist/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var csrftoken = $('meta[name=csrf-token]').attr('content');
        $.ajax({
          type:"post",
          url:'{{route('jerarquia')}}',

          data:{
            '_token':csrftoken,
            'Revista':{{substr(Auth::User()->usuario,3)}} },

          success: function(data){
        
            $("#id_jerarquia").text(data[0])
            
          },error:function(data){
            console.log( 'Error al agregar el articulo', data );
          }
        });
    });
</script>