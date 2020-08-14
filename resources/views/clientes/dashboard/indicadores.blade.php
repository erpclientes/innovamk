<div id="breadcrumbs-wrapper" style="padding: 0 0;">
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
<div class="container">
            <!--card stats start-->
            <div id="card-stats">
              <div class="row">
                <div class="col s12 m6 l4">
                  <div class="card padding-4 animate fadeLeft">
                     <div class="col s5 m5">
                        <h5 class="mb-0">{{count($comprobantes2)}}</h5>
                        <p class="no-margin">facturas</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5  purple darken-1 gradient-shadow white-text">payment</i>
                        <p class="mb-0">Pendientes de Pago</p>
                     </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card padding-4 animate fadeLeft">
                     <div class="col s5 m5">
                        <h5 class="mb-0">3</h5>
                        <p class="no-margin">Ticecks</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 teal darken-1 gradient-shadow white-text">note</i>
                        <p class="mb-0">Registro de Incidencias</p>
                     </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card padding-4 animate fadeRight">
                     <div class="col s5 m5">
                        <h5 class="mb-0">{{count($servicio)}}</h5>
                        <p class="no-margin">Activo</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 light-blue darken-2 gradient-shadow white-text">cast</i>
                        <p class="mb-0">Servicio de Internet</p>
                     </div>
                  </div>
                </div>
              </div>

              <div class="row">              
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
                <div class="col s12 m6 l4">
                  <div class="col s12 card-width">
                        <div class="card border-radius-6 blue lighten-5 animate fadeRight">
                              <div class="card-content center-align">
                                    <i class="material-icons light-blue darken-1 white-text small-ico-bg mb-5">get_app</i>
                                    <h4 class="m-0"><b>512M</b></h4>
                                    <p>Total Descarga</p>
                                    <p class="green-text  mt-3"><i class="material-icons vertical-align-middle">arrow_drop_up</i>
                                          119.71%</p>
                              </div>
                        </div>
                        <div class="card border-radius-6 deep-purple lighten-5 animate fadeRight">
                              <div class="card-content center-align">
                                    <i class="material-icons deep-purple lighten-1 white-text small-ico-bg mb-5">file_upload</i>
                                    <h4 class="m-0"><b>250M</b></h4>
                                    <p>Total Subida</p>
                                    <p class="green-text  mt-3"><i class="material-icons vertical-align-middle">arrow_drop_up</i>
                                          103.35%</p>
                              </div>
                        </div>
                  </div>
               </div>
            </div>
            </div>
          
        </div>
        <br><br>