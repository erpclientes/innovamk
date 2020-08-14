@extends('layouts2.app2')
@section('titulo','Dashboard finanzas')

@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row">
  <div class="col s12 m6 l4">
    <div class="card gradient-shadow min-height-100 animate fadeLeft">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5 green lighten-2 gradient-shadow white-text">note</i>
              <p>Por cobrar</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="font-size: 26px">Lps {{$ingresos_por_cobrar}}</h4>
              <p class="no-margin">Total</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>
  <div class="col s12 m6 l4">
    <div class="card gradient-shadow min-height-100 animate fadeLeft">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons light-blue darken-1 background-round mt-5 white-text">new_releases</i>
              <p>Ingresos hoy</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="font-size: 26px">Lps {{$ingreso_total_hoy}}</h4>
              <p class="no-margin">Total</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>
  <div class="col s12 m6 l4">
    <div class="card gradient-shadow min-height-100 animate fadeRight">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons orange  darken-1 background-round mt-5 white-text">monetization_on</i>
              <p>Total ingresado</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="font-size: 26px">Lps {{$ingreso_total_mes}}</h4>
              <p class="no-margin">Este mes</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>
</div> 
<div class="row">
   
   <div class="col s12 m8 l8 animate fadeRight">
      <!-- Total Transaction -->
      <div class="card">
         <div class="card-content">
            <h4 class="card-title mb-0">Total Transaccines <i class="material-icons float-right">more_vert</i></h4>
            <p class="medium-small">Transacción de esta semana</p>
            <div class="total-transaction-container">
               <div id="total-transaction-line-chart" class="total-transaction-shadow"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="210" y2="210" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line><line y1="168" y2="168" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line><line y1="126" y2="126" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line><line y1="84" y2="84" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line><line y1="42" y2="42" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line><line y1="0" y2="0" x1="40" x2="757.6625366210938" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M40,197.4C72.621,197.4,72.621,168,105.242,168C137.863,168,137.863,193.2,170.484,193.2C203.105,193.2,203.105,126,235.726,126C268.347,126,268.347,180.6,300.968,180.6C333.589,180.6,333.589,21,366.21,21C398.831,21,398.831,189,431.452,189C464.073,189,464.073,63,496.694,63C529.315,63,529.315,126,561.936,126C594.557,126,594.557,8.4,627.178,8.4C659.799,8.4,659.799,84,692.42,84C725.042,84,725.042,0,757.663,0" class="ct-line"></path><circle cx="40" cy="197.4" ct:value="197.4" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="105.2420487837358" cy="168" ct:value="168" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="170.4840975674716" cy="193.2" ct:value="193.2" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="235.72614635120738" cy="126" ct:value="126" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="300.9681951349432" cy="180.6" ct:value="180.6" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="366.210243918679" cy="21" ct:value="21" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="431.45229270241475" cy="189" ct:value="189" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="496.69434148615056" cy="63" ct:value="63" r="5" class="ct-point ct-point-circle"></circle><circle cx="561.9363902698864" cy="126" ct:value="126" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="627.1784390536221" cy="8.400000000000006" ct:value="8.400000000000006" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="692.420487837358" cy="84" ct:value="84" r="5" class="ct-point ct-point-circle-transperent"></circle><circle cx="757.6625366210938" cy="0" ct:value="0" r="5" class="ct-point ct-point-circle-transperent"></circle></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="215" width="65.2420487837358" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="105.2420487837358" y="215" width="65.2420487837358" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="170.4840975674716" y="215" width="65.24204878373578" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="235.72614635120738" y="215" width="65.24204878373581" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="300.9681951349432" y="215" width="65.24204878373581" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="366.210243918679" y="215" width="65.24204878373575" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="431.45229270241475" y="215" width="65.24204878373581" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="496.69434148615056" y="215" width="65.24204878373581" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="561.9363902698864" y="215" width="65.24204878373575" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="627.1784390536221" y="215" width="65.24204878373587" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="692.420487837358" y="215" width="65.24204878373575" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 65px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" x="757.6625366210938" y="215" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;"></span></foreignObject><foreignObject style="overflow: visible;" y="168" x="0" height="42" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 42px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="126" x="0" height="42" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 42px; width: 30px;">10</span></foreignObject><foreignObject style="overflow: visible;" y="84" x="0" height="42" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 42px; width: 30px;">20</span></foreignObject><foreignObject style="overflow: visible;" y="42" x="0" height="42" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 42px; width: 30px;">30</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="42" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 42px; width: 30px;">40</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">50</span></foreignObject></g><defs><linearGradient id="lineLinearStats" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="rgba(255, 82, 249, 0.1)"></stop><stop offset="10%" stop-color="rgba(255, 82, 249, 1)"></stop><stop offset="30%" stop-color="rgba(255, 82, 249, 1)"></stop><stop offset="95%" stop-color="rgba(133, 3, 168, 1)"></stop><stop offset="100%" stop-color="rgba(133, 3, 168, 0.1)"></stop></linearGradient></defs></svg></div>
            </div>
         </div>
      </div>
   </div>

   <div class="col s12 m4 l4">
      <!-- Current Balance -->
      <div class="card animate fadeLeft">
         <div class="card-content">
            <h4 class="card-title mb-0">Saldo Actual <i class="material-icons float-right">more_vert</i></h4>
            <p class="medium-small">Ingreso hasta la fecha</p>
            <div class="current-balance-container">
               <div id="current-balance-donut-chart" class="current-balance-shadow" style="position: relative;"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;"><g class="ct-series ct-series-b ct-fill-donut"><path d="M169.913,9A76,76,0,0,0,97.551,61.767" class="ct-slice-donut" ct:value="20" ct:meta="Remaining" style="stroke-width: 8px;"></path></g><g class="ct-series ct-series-a ct-fill-donut"><path d="M97.632,61.515A76,76,0,1,0,169.913,9" class="ct-slice-donut" ct:value="80" ct:meta="Completed" style="stroke-width: 8px;"></path></g><g class="ct-series ct-series-a"><path d="M97.632,61.515A76,76,0,1,0,169.913,9" class="ct-slice-donut" ct:value="80" ct:meta="Completed" style="stroke-width: 8px;"></path></g><g class="ct-series ct-series-b"><path d="M169.913,9A76,76,0,0,0,97.551,61.767" class="ct-slice-donut" ct:value="20" ct:meta="Remaining" style="stroke-width: 8px;"></path></g></svg><div class="ct-fill-donut-label" data-fill-index="fdid-0" style="position: absolute; top: 60px; left: 137px;"><p class="small">Balance</p><h5 class="mt-0 mb-0">$ 10k</h5></div></div>
            </div>
            <h5 class="center-align">$ 50,150.00</h5>
            <p class="medium-small center-align">Total ingresado hasta ahora</p>
         </div>
      </div>
   </div>
</div>

<div class="row">              
              <div class="col s12 l4">
                  <!-- Recent Buyers -->
                  <div class="card recent-buyers-card animate fadeUp white">
                     <div class="card-content">
                        <h4 class="card-title mb-0">Pagos recientes <i class="material-icons float-right">more_vert</i></h4>
                        <p class="medium-small pt-2">Esta semana</p>
                        <ul class="collection mb-0">
                          @foreach($pagados as $datos)
                           <li class="collection-item avatar">
                              
                              <i class="material-icons circle">person</i>
                              <p class="font-weight-600">{{$datos->razon_social}}</p>
                              <p class="medium-small">{{$datos->fecha_pago}}</p>
                              <a href="#!" class="secondary-content"><i class="material-icons">star_border</i></a>
                           </li>           
                           @endforeach                
                        </ul>
                     </div>
                  </div>
               </div>

               <div class="col s12 m6 l8">
                  <div class="card subscriber-list-card animate fadeLeft">
                     <div class="card-content pb-1" style="text-align: left">
                        <h4 class="card-title mb-0">Lista de Comprobantes</h4>
                     </div>
                     <?php 
                      $bandera = false;

                      if (count($comprobantes) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                     <table class="subscription-table responsive-table highlight">
                        <thead>
                           <tr>
                              <th>#</th>
                                     <th>Documento</th>
                                     <th>F. Emisión</th>
                                     <th>F. Vencimiento</th> 
                                     <th>Total</th>
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                                    if($bandera){                                                           
                            
                                      foreach ($comprobantes as $valor) {
                                      $i++;
                                ?>
                                <tr id="fac{{$valor->codigo}}">                                  
                                     <td><?php echo $i; ?></td>
                                     <td>
                                      @foreach($tipo_documento_venta as $tipo)
                                      @if($tipo->iddocumento == $valor->iddocumento)  
                                        {{$tipo->dsc_corta.' '.$valor->serie.' '.$valor->numero}}
                                      @endif
                                      @endforeach
                                     </td>
                                     <td>{{ date_format(date_create($valor->fecha_emision),'d/m/Y') }}</td>
                                     <td>{{ date_format(date_create($valor->fecha_vencimiento),'d/m/Y') }}</td>
                                     <td>{{$valor->total}}</td>                     
                                     <td>
                                     @if($valor->idestado == 'EM')
                                      <span class="badge pink lighten-5 pink-text text-accent-2">PENDIENTE</span>
                                     @elseif($valor->idestado == 'PV')
                                      <span class="badge amber lighten-5 amber-text text-accent-2">VERIFICANDO</span>
                                     @endif
                                     @if($valor->idestado == 'AN')
                                      <span class="badge grey lighten-3 black-text text-accent-2">ANULADO</span>
                                     @elseif($valor->idestado == 'PA')
                                      <span class="badge green lighten-5 green-text text-accent-2">PAGADO</span>
                                     @endif
                                     </td>
                                     <td class="center" style="width: 7rem">
                                      <a href="{{ url('/pagos/detalle') }}/{{$valor->codigo}}" class="tooltipped" data-position="top" data-delay="500" data-tooltip="Pagar"><i class="material-icons teal-text lighten-1 text-darken-2">credit_card</i></a>
                                      <a href="{{url('/descargarPDF')}}/{{$valor->codigo}}" class="tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF"><i class="material-icons grey-text text-darken-2">vertical_align_bottom</i></a>
                                     </td>
                                  </tr>
                                   
                                  <?php }} ?>
                        </tbody>
                     </table>
                  </div>
               </div>
                
</div>
<br><br>
@endsection
@section('script')
  
@endsection

