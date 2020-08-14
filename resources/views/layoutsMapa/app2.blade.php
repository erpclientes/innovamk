<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" charset="UTF-8">
  
  @if((Auth::user()->idtipo === 'ADM' and Auth::user()->usu_licencia == 1) OR empty(Auth::user()) )
    @include('layouts5.partials.htmlHead')
  @elseif(Auth::user()->idtipo === 'ADM' OR empty(Auth::user()) )
    @include('layouts2.partials.htmlHead')
  @endif
  @if(Auth::user()->idtipo === 'CLE')
    @include('layouts3.partials.htmlHead')
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
      @include('layouts3.partials.header')
      @include('layouts3.partials.sidebar')
      
      <div id="main">
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
      @include('layouts3.partials.footer')
      @include('layouts3.partials.scripts')   
    @endif   
    
  </body>
</html>