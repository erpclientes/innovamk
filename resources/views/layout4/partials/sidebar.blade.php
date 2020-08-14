<!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav" data-valor="0" class="nav-expanded nav-lock nav-collapsible">
          <div class="brand-sidebar">
            <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 15px">
              <a href="http://innovatec.me" class="brand-logo darken-1">
                <span class="hide logo-text hide-on-med-and-down"><b style="color: #fafafa; font-style: normal;">INNOVA</b>Mk</span>
                <img src="{{asset('images/logo/InnovaWifi3.png')}}" alt="InnovaWifi" style=" height: 43px">               
              </a>
              <a href="#" class="navbar-toggler" id="radio" onclick="Materialize.fadeInImage('#sideusuario')">
                <i class="material-icons" id="radio2">radio_button_checked</i>
              </a>
            </h1>
          </div>
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="no-padding">
              <ul class="collapsible" data-collapsible="accordion">
                <!--
                <li class="blue darken-4" id="sideusuario" style="height: 100px; padding-top: 10px; margin-bottom: 10px; background: url({{asset('images/fondo-perfil.png')}}); background-size: 270px">
                  <div class="row">
                      <div class="col col s5 m5 l5">
                          <img src="{{asset('images/usu-perfil.png')}}" alt="" class="circle responsive-img valign profile-image blue lighten-5" style="height: 70px; width: 70px">
                      </div>
                      <div class="col col s7 m7 l7" style="margin-left: -15px; width: 128px">
                          
                          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown" style="width: 130%">{{ substr(Auth::user()->nombre,0,9) }}<i class="mdi-navigation-arrow-drop-down right"></i></a><ul id="profile-dropdown" class="dropdown-content" style="width: 100px; padding-top: 20px; border: 10px">
                              <li><a href="#"><i class="mdi-action-face-unlock"></i> Perfil</a>
                              </li>
                              <li><a href="#"><i class="mdi-action-settings"></i> Config.</a>
                              </li>
                              <li><a href="#"><i class="mdi-communication-live-help"></i> Ayuda</a>
                              </li>
                              <li class="divider"></li>
                              
                              <li style="padding-top: 15px"><a href="http://localhost/innovamk/public/cerrar"><i class="mdi-hardware-keyboard-tab"></i> Cerrar</a>
                              </li>
                          </ul>
                          <p class="user-roal">Administrator</p>
                      </div>
                  </div>
              </li>
            -->
                <li class="bold">
                  <a class=" waves-effect waves-cyan" href="{{ url('/home') }}">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">DashBoard</span>
                  </a>                  
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
                        <a href="{{ url('/perfiles') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Planes Internet</span>
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
                <li class="bold">
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
                    <i class="material-icons">person</i>
                    <span class="nav-text">Clientes</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/clientes') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Usuarios</span>
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
                    </ul>
                  </div>
                </li>
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">credit_card</i>
                    <span class="nav-text">Facturación</span>
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
                <!--
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">equalizer</i>
                    <span class="nav-text">Reportes</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Mis Ventas</span></a>
                      </li> 
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Stock de Equipos</span></a>
                      </li>                                       
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Salidas de Almacen</span></a>
                      </li> 
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Historial Clientes</span></a>
                      </li> 
                    </ul>
                  </div>
                </li>  -->
              </ul>
            </li>
            <li class="li-hover">
              <p class="ultra-small margin more-text" id="mas_opciones">Mas opciones</p>
            </li>
            <li>
              <a href="{{ url('colores') }}" target="_blank">
                <i class="material-icons">palette</i>
                <span class="nav-text">Colores</span>
              </a>
            </li>
            <li>
              <a href="" target="_blank">
                <i class="material-icons">help_outline</i>
                <span class="nav-text">Soporte</span>
              </a>
            </li>
          </ul>
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only gradient-45deg-light-blue-cyan gradient-shadow">
            <i class="material-icons">menu</i>
          </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->