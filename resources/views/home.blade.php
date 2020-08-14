@extends('layouts2.app')
@section('titulo','DashBoard')

@section('sub-cabecera')
    <div id="breadcrumbs-wrapper" class="hide">
            <div class="container">
              <div class="row">
                <div class="col s10 m6 l6">
                  <h5 class="breadcrumbs-title">DashBoard</h5>
                  <ol class="breadcrumbs">
                    <li><a href="#" style="color: #00796b">Indicadores</a></li>
                    <li><a href="#" style="color: #00796b">Estadísticas</a></li>
                    <li><a href="#" style="color: #00796b">Accesos directos</a></li>
                  </ol>
                </div>
               
              </div>
            </div>
          </div>
@endsection

@section('main-content')

  @if(Auth::user()->idtipo === 'ADM' and Auth::user()->usu_licencia == 1) 
    @include('forms.dashboard.licencia')
  @elseif(Auth::user()->idtipo === 'ADM' ) 
    @include('forms.dashboard.dashboard')
  @endif


  @if(Auth::user()->idtipo === 'CLE' ) 
    @include('clientes.dashboard.indicadores')
  @elseif(Auth::user()->idtipo === 'TEC' ) 
    @include('forms.dashboard.tecnicos')
  @endif
  @if (Auth::user()->idtipo === 'VEN')
    @include('forms.dashboard.vendedores')
  @endif
  

@endsection

@section('script')
  
  <script type="text/javascript" src="highchart/js/highcharts.js"></script>
  <script type="text/javascript" src="highchart/js/themes/grid.js"></script>
  @include('forms.dashboard.scripts.monitor')
  @include('forms.dashboard.scripts.inicio')

@endsection

