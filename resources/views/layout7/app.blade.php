<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" charset="UTF-8">
  
  @include('layout7.partials.htmlHead')
  @include('layout7.partials.header') 

  <div id="fondoColor" class="content-wrapper-before gradient-45deg-light-blue-cyan" style="background:"></div>

  <div class="col s12">
    <div class="container">
      <div class="section">
        @yield('main-content')      
      </div>
    </div>
  </div>

  @include('layouts2.partials.footer')
  @include('layouts2.partials.scripts')


 
</html>