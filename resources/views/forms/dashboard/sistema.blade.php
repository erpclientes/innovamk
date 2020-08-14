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
  @include('forms.dashboard.dashboard')

@endsection

@section('script')
  
  <script type="text/javascript" src="highchart/js/highcharts.js"></script>
  <script type="text/javascript" src="highchart/js/themes/grid.js"></script>
  @include('forms.dashboard.scripts.monitor')
  @include('forms.dashboard.scripts.inicio')

@endsection