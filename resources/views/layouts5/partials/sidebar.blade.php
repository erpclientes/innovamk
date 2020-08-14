<!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 20px">
              <a href="http://innovatec.me" class="darken-1">
                <span class="hide logo-text hide-on-med-and-down"><b style="color: #fafafa; font-style: normal;">INNOVA</b>Mk</span>
                <img src="{{asset('images/logo/InnovaWifi.png')}}" alt="InnovaWifi" style=" height: 43px">               
              </a>
          <a class="navbar-toggler" href="#">
            <i class="material-icons">radio_button_checked</i>
          </a>
        </h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold">
                  <a class=" waves-effect waves-cyan" href="{{ url('/home') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="nav-text">DashBoard</span>
                  </a>                  
                </li>
                <li class="no-padding">
                  <ul class="collapsible" data-collapsible="accordion">                
                    <li class="bold">
                      <a class=" waves-effect waves-cyan" href="{{url('usuario/mostrar')}}/{{Auth::user()->id}}">
                        <i class="material-icons">perm_identity</i>
                        <span class="nav-text">Pefil de Usuario</span>
                      </a>                  
                    </li>
                  </ul>
                </li>          
                <li class="no-padding">
                  <ul class="collapsible" data-collapsible="accordion">                
                    <li class="bold">
                      <a class=" waves-effect waves-cyan" href="{{url('/licencia')}}">
                        <i class="material-icons">content_paste</i>
                        <span class="nav-text">Licencias</span>
                      </a>                  
                    </li>
                  </ul>
                </li>            
                <li class="no-padding">
                  <ul class="collapsible" data-collapsible="accordion">                
                    <li class="bold">
                      <a class=" waves-effect waves-cyan" href="{{ url('/empresa') }}">
                        <i class="material-icons">people_outline</i>
                        <span class="nav-text">Clientes</span>
                      </a>                  
                    </li>
                  </ul>
                </li>                    
                
                
                <li class="navigation-header">
                  <a class="navigation-header-text">Mas opciones</a>
                  <i class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="li-hover">
              
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