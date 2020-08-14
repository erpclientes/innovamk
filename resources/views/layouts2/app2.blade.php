<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" charset="UTF-8">
  
  @if((Auth::user()->idtipo === 'ADM' and Auth::user()->usu_licencia == 1) OR empty(Auth::user()) )
    @include('layouts5.partials.htmlHead')
  @elseif(Auth::user()->idtipo === 'ADM' OR empty(Auth::user()) )
    @include('layouts2.partials.htmlHead')
  @endif
  @if(Auth::user()->idtipo === 'CLE')
    @include('layoutClientes.partials.htmlHead')
    @elseif(Auth::user()->idtipo === 'TEC' )  
    @include('layoutTecnicos.partials.htmlHead')
  @endif
  @if(Auth::user()->idtipo === 'VEN')
    @include('layoutVendedores.partials.htmlHead')
  @endif





  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    @if((Auth::user()->idtipo === 'ADM' and Auth::user()->usu_licencia == 1) OR empty(Auth::user()) )
      @include('layouts5.partials.header')
      @include('layouts5.partials.sidebar')
      
      <div id="main" class="full {{ (Auth::user()->menu_colapsible == 1)? 'main-full' : ''}}">
        <div class="row">                     
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layouts5.partials.footer')
      @include('layouts5.partials.scripts')  

    @elseif(Auth::user()->idtipo === 'ADM' OR empty(Auth::user()))

      @include('layouts2.partials.header')
      @include('layouts2.partials.sidebar')
      
      <div id="main" class="full {{ (Auth::user()->menu_colapsible == 1)? 'main-full' : ''}}">
        <div class="row">
          
            
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>

      </div>
      @include('layouts2.partials.personalizarPlantilla')

      @include('layouts2.partials.footer')
      @include('layouts2.partials.scripts')
    @endif    

    @if(Auth::user()->idtipo === 'CLE') 
      @include('layoutClientes.partials.header')
      @include('layoutClientes.partials.sidebar')
      
      <div id="main">
        <div class="row"> 
          @if(!is_null(Auth::user()->cabecera_color))
          <div id="fondoColor" class="content-wrapper-before {{Auth::user()->cabecera_color}} {{(Auth::user()->cabecera_fondo_ocultar == 1)? 'hide' : ''}}" style="background:"></div>
          @else
          <div id="fondoColor" class="content-wrapper-before gradient-45deg-light-blue-cyan" style="background:"></div>
          @endif 
          
          
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>
      </div>


      @include('layoutClientes.partials.personalizarPlantilla')

      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 706px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 453px;"></div></div></div>

      @include('layoutClientes.partials.footer')
      @include('layoutClientes.partials.scripts') 

    @elseif(Auth::user()->idtipo === 'TEC' ) 
      @include('layoutTecnicos.partials.header')
      @include('layoutTecnicos.partials.sidebar')
      
      <div id="main" class="full {{ (Auth::user()->menu_colapsible == 1)? 'main-full' : ''}}">
        <div class="row">
          @if(!is_null(Auth::user()->cabecera_color))
          <div id="fondoColor" class="content-wrapper-before {{Auth::user()->cabecera_color}} {{(Auth::user()->cabecera_fondo_ocultar == 1)? 'hide' : ''}}" style="background:"></div>
          @else
          <div id="fondoColor" class="content-wrapper-before gradient-45deg-light-blue-cyan" style="background:"></div>
          @endif
            
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>
      </div>
      
      @include('layoutTecnicos.partials.personalizarPlantilla')

      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 706px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 453px;"></div></div></div>

      @include('layoutTecnicos.partials.footer')
      @include('layoutTecnicos.partials.scripts')  
      @elseif(Auth::user()->idtipo === 'TEC' ) 
      @include('layoutTecnicos.partials.header')
      @include('layoutTecnicos.partials.sidebar')
      
      <div id="main" class="full {{ (Auth::user()->menu_colapsible == 1)? 'main-full' : ''}}">
        <div class="row">
          @if(!is_null(Auth::user()->cabecera_color))
          <div id="fondoColor" class="content-wrapper-before {{Auth::user()->cabecera_color}} {{(Auth::user()->cabecera_fondo_ocultar == 1)? 'hide' : ''}}" style="background:"></div>
          @else
          <div id="fondoColor" class="content-wrapper-before gradient-45deg-light-blue-cyan" style="background:"></div>
          @endif
            
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>
      </div>
      
      @include('layoutTecnicos.partials.personalizarPlantilla')

      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 706px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 453px;"></div></div></div>

      @include('layoutTecnicos.partials.footer')
      @include('layoutTecnicos.partials.scripts')  
    @endif 
    @if(Auth::user()->idtipo === 'VEN') 
      @include('layoutVendedores.partials.header') 
      @include('layoutVendedores.partials.sidebar')

      
      <div id="main" class="full {{ (Auth::user()->menu_colapsible == 1)? 'main-full' : ''}}">
        <div class="row">
          @if(!is_null(Auth::user()->cabecera_color))
          <div id="fondoColor" class="content-wrapper-before {{Auth::user()->cabecera_color}} {{(Auth::user()->cabecera_fondo_ocultar == 1)? 'hide' : ''}}" style="background:"></div>
          @else
          <div id="fondoColor" class="content-wrapper-before gradient-45deg-light-blue-cyan" style="background:"></div>
          @endif
            
          <div class="col s12">
            <div class="container">
              <div class="section">
                @yield('main-content')      
              </div>
            </div>
          </div>
        </div>
      </div>
      
      @include('layoutVendedores.partials.personalizarPlantilla')

      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 706px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 453px;"></div></div></div>

      @include('layoutVendedores.partials.footer')
      @include('layoutVendedores.partials.scripts')  
    @endif    
    
  </body>
</html>