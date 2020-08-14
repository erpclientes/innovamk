<!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar {{ (Auth::user()->cabecera_fija == 1)? 'navbar-fixed' : ''}}"> 
        @if(!is_null(Auth::user()->cabecera_color))
        @if(Auth::user()->cabecera_dark == 1)
          @if(trim(Auth::user()->cabecera_color) == '#37474f')
          <nav id="navbarMain" class="navbar-main navbar-color nav-collapsible {{ (Auth::user()->menu_colapsible == 1)? 'nav-collapsed' : 'nav-expanded sideNav-lock'}} navbar-dark no-shadow  navbar-dark" style="background-color: #37474f">
          @else
          <nav id="navbarMain" class="navbar-main navbar-color nav-collapsible {{ (Auth::user()->menu_colapsible == 1)? 'nav-collapsed' : 'nav-expanded sideNav-lock'}} navbar-dark no-shadow {{Auth::user()->cabecera_color}}  navbar-dark" >
          @endif        
        @else
         <nav id="navbarMain" class="navbar-main navbar-color nav-collapsible {{ (Auth::user()->menu_colapsible == 1)? 'nav-collapsed' : 'nav-expanded sideNav-lock'}} no-shadow  navbar-light" style="background-color: #fff">
        @endif
        
        @else
        <nav id="navbarMain" class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark no-shadow gradient-45deg-light-blue-cyan" >
        @endif
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Buscador">
            </div>
            <ul class="navbar-list right">
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light translation-button" href="javascript:void(0);" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li>
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only"><a class="hide waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li><a class=" hide waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{asset('images/avatar/avatar-7.png')}}" alt="avatar"><i></i></span></a></li>
              <li><a class="hide waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li>
            </ul>
            <!-- translation-button-->
            <ul class="dropdown-content" id="translation-dropdown">
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-gb"></i> English</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-fr"></i> French</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-cn"></i> Chinese</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-de"></i> German</a></li>
            </ul>
            <!-- notifications-dropdown-->
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>
              <li class="divider"></li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
              </li>
            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a href="{{url('usuario/mostrar')}}/{{(is_null(Auth::user()))? 0 : Auth::user()->id}}" style="color: black">
                <i class="material-icons">face</i> Perfil</a>
              </li>
              <li class="divider"></li>                              
              <li style="padding-top: 15px"><a href="{{url('/cerrar')}}"  style="color: black">
                <i class="material-icons">keyboard_tab</i> Cerrar</a>
              </li>
            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form>
                <div class="input-field">
                  <input class="search-box-sm" type="search" required="">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                </div>
              </form>
            </div>
          </nav>
        </nav>
      </div>
    </header>
    <!-- END: Header-->