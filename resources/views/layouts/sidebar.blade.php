@if(Auth::User()->primer_logeo == null)
@else
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('inicio') }}" class="brand-link">
    <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">Patrimonio</span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('inicio') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                          Inicio
                        </p>
                    </a>
                </li>
                @can('usuarios.listaUsuarios')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                          Usuarios y Permisos
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
                                    <p>Roles Permisos</p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                    @endcan
                </li>

                @can('dependencias.dependencias')
                <li class="nav-item has-treeview">
                    <a href="{{ route('indexDependencia') }}" class="nav-link">
                        <i class="nav-icon fa fa-codepen"></i>
                        <p>
                          Dependencias
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                </li>
                @endcan
                @can('vehiculos.index')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-car"></i>
                        <p>
                          Vehiculos
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <ul>
                            <li class="nav-item noPuntos" id="pie">
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
                              Tipo de vehiculos
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.eliminar')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-times"></i>
                            <p>
                              Estados
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <ul>
                                
                                <li class="nav-item noPuntos" id="pie">
                                    <a href="{{ route('listadoEstadoVehiculo') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Fuera de servicio</p>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                        <ul class="nav nav-treeview">
                            <ul>
                                
                                <li class="nav-item noPuntos" id="pie">
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
                    <li class="nav-item has-treeview" id="pie">
                        <a href="{{ route('listaAsignacion') }}" class="nav-link">
                            <i class="nav-icon fa fa-share"></i>
                            <p>
                              Asignar
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li> 
                    @endcan
                    @can('vehiculos.siniestros')
                    <li class="nav-item has-treeview" id="pie">
                         <a href="{{ route('indexSiniestros') }}" class="nav-link">
                            <i class="nav-icon fa fa-road"></i>
                            <p>
                              Siniestros
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.informacion')
                    <li class="nav-item has-treeview" id="pie">
                        <a href="{{ route('detalleVehiculo') }}" class="nav-link">
                            <i class="nav-icon fa fa-edit"></i>
                            <p>
                              Detalles
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.repuestos')
                    <li class="nav-item has-treeview" id="pie">
                         <a href="{{ route('listaRepuestos') }}" class="nav-link">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                              Repuestos
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('vehiculos.graficos')
                    <li class="nav-item has-treeview" id="pie">
                         <a href="{{ route('ListaGraficos') }}" class="nav-link">
                            <i class="nav-icon fa fa-paste"></i>
                            <p>
                              Graficos
                              <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    @endcan 
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@endif
<style type="text/css">
    .noPuntos{
        list-style:none;
    }
</style>