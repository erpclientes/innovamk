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
                <li class="bold">
                  <a class=" waves-effect waves-cyan" href="{{ url('#') }}">
                    <i class="material-icons">highlight_off</i>
                    <span class="nav-text">Instalaciones</span>
                  </a>                  
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