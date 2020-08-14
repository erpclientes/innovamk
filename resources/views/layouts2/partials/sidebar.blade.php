<!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-collapsible {{ (Auth::user()->menu_dark == 1)? 'sidenav-dark' : 'sidenav-light'}} sidenav-active-square {{ (Auth::user()->menu_colapsible == 1)? 'nav-collapsed' : 'nav-lock'}}">
      <div class="brand-sidebar">
        @if(Auth::user()->menu_colapsible == 0)
        <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 20px">
        @else
        <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 12px">
        @endif
              <a href="http://innova-tec.me" class="{{(Auth::user()->menu_dark == 1)? 'brand-logo' : ''}} darken-1" style="padding: 0 0">                
                @if(Auth::user()->menu_dark == 1)
                  @if(Auth::user()->menu_colapsible == 0)
                    <img id="logoInnova" src="{{asset('images/logo/InnovaWifi2.png')}}" alt="InnovaWifi" style=" height: 43px; background-image: url('{{asset('images/logo/Isotipo.png')}}') !importar;">               
                  @else
                    <img id="logoInnova" src="{{asset('images/logo/Isotipo_Blanco.png')}}" alt="InnovaWifi" style=" height: 43px">                      
                    <span id="LogoInnovaTec" class="logo-text hide-on-med-and-down"><b>Innova</b>Tec</span>            
                  @endif                
                @else
                  @if(Auth::user()->menu_colapsible == 0)
                    <img id="logoInnova" src="{{asset('images/logo/InnovaWifi.png')}}" alt="InnovaWifi1" style=" height: 43px">               
                  @else
                    <img id="logoInnova" src="{{asset('images/logo/Isotipo.png')}}" alt="InnovaWifi2" style=" height: 43px; background-image: url('{{asset('images/logo/Isotipo.png')}}') !importar;"> 
                    <span id="LogoInnovaTec" class="hide logo-text hide-on-med-and-down"><b>Innova</b>Tec</span>                          
                  @endif                
                @endif
                
              </a>
          <a class="navbar-toggler" href="#">
            @if(Auth::user()->menu_dark == 1)
            <i class="material-icons">radio_button_unchecked</i>
            @else
            <i class="material-icons">radio_button_checked</i>
            @endif
          </a>
        </h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">DashBoard</span>
                    <span class="badge badge pill orange float-right mr-10">3</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li>
                        <a href="{{ url('/home') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> General</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/dashboard/finanzas') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Finanzas</span>
                        </a>
                      </li>   
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">settings</i>
                    <span class="nav-text">Configuración</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li>
                        <a href="{{ url('/empresa') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Editor de Empresas</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/router') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Router</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/usuarios') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Usuarios del Sistema</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/zonas') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Zonas</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/perfiles') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Planes Internet</span>
                        </a>
                      </li>     
                      <li>
                        <a href="{{ url('/pool') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Ip pool</span>
                        </a>
                      </li>     
                      <li>
                        <a href="{{ url('/parametros') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parámetros</span>
                        </a>
                      </li>                      
                    </ul>
                  </div>
                </li>
                <li class="bold hide">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">wifi</i>
                    <span class="nav-text">Hotspot</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>   
                      <li><a href="{{ url('/hotspot/usuarios') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Usuarios Registrados</span></a>
                      </li> 
                      <li><a href="{{ url('/conexiones') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Conexiones</span></a>
                      </li>                   
                      <li><a href="{{ url('/carrusel') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Carrusel</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/bienvenida') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Bienvenida</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/lstPublicidad') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Publicidad</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/logout') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Logout</span></a>
                      </li> 
                      <li><a href="{{ url('/social') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Redes Sociales</span></a>
                      </li>                         
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header  waves-effect waves-cyan">
                    <i class="material-icons">art_track</i>
                    <span class="nav-text">Plantillas</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/aviso/mntAviso') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Aviso</span>
                      </a>
                      </li> 
                      <li>
                        <a href="{{ url('/corte/mntCorte') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Corte</span>
                        </a>
                      </li>                      
                      
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header  waves-effect waves-cyan">
                    <i class="material-icons">person</i>
                    <span class="nav-text">Clientes</span>
                    <span class="badge  badge pill pink accent-2 float-right mr-10">5</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/clientes') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Usuarios</span>
                      </a>
                      </li> 
                      <li><a href="{{ url('/proformas') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Proformas</span>
                      </a>
                      </li>
                      <li><a href="{{ url('/clientes/mapa') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Mapa Usuarios</span>
                      </a>
                      </li> 
                      <li><a href="{{ url('/clientes/notificaciones') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Notificaciones</span>
                      </a>
                      </li> 
                      <li>
                        <a href="{{ url('documento') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Doc. Personas</span>
                        </a>
                      </li>                      
                      <li><a href="{{ url('/clientes/importar') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Herramientas</span>
                      </a>
                      </li>  
                      <li>
                        <a href="{{ url('/parametros-clientes') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parámetros</span>
                        </a>
                      </li> 
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header  waves-effect waves-cyan">
                    <i class="material-icons">local_offer</i>
                    <span class="nav-text">Fichas</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/fichas') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Generador</span>
                      </a>
                      </li>             
                      <li><a href="{{ url('/fichas/plantillas') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Plantillas</span>
                      </a>
                      </li>  
                      <li>
                        <a href="#">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parámetros</span>
                        </a>
                      </li> 
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">credit_card</i>
                    <span class="nav-text">Facturación</span>
                    <span class="badge badge pill purple float-right mr-10">10</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/pagos') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Registar Pago</span>
                      </a>
                      </li>                            
                      <li><a href="{{ url('documentoVenta') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Documento de Venta</span></a>
                      </li> 
                      <li>
                        <a href="{{ url('formaPago') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Formas de Pago</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('moneda') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Tipo de Moneda</span>
                        </a>
                      </li>
                      <li><a href="{{ url('reporte-pagos') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Reporte de pagos</span></a>
                      </li> 
                      <li>
                        <a href="{{ url('/parametros-facturacion') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parámetros</span>
                        </a>
                      </li> 
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">store</i>
                    <span class="nav-text">Almacén</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/equipos') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Equipos</span></a>
                      </li> 
                      <li><a href="{{ url('grupo') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Grupos</span></a>
                      </li>                                       
                      <li><a href="{{ url('marca') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Marca</span></a>
                      </li> 
                      <li><a href="{{ url('modelo') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Modelo</span></a>
                      </li> 
                      <li><a href="{{ url('modo') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Tipo de Equipos</span></a>
                      </li> 
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class=" waves-effect waves-cyan" href="{{ url('correo') }}">
                    <i class="material-icons">email</i>
                    <span class="nav-text">Mensajes</span>
                  </a>                  
                </li>
                {{--  <li class="bold">
                  <a class="collapsible-header  waves-effect waves-cyan">
                    <i class="material-icons">build</i>
                    <span class="nav-text">Soporte Técnico</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('tickets') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Tickets</span>
                      </a>
                      </li>  
                    </ul>
                  </div>
                </li>  --}}
                <li class="navigation-header">
                  <a class="navigation-header-text">Mas opciones</a>
                  <i class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="li-hover">
              
            </li>
            <li>
              <a class=" waves-effect waves-cyan" href="{{ url('colores') }}" target="_blank">
                <i class="material-icons">palette</i>
                <span class="nav-text">Colores</span>
              </a>
            </li>
            <li>
              <a class=" waves-effect waves-cyan" href="" target="_blank">
                <i class="material-icons">help_outline</i>
                <span class="nav-text">Soporte</span>
              </a>
            </li>
          </ul>
          
       
       
      </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->