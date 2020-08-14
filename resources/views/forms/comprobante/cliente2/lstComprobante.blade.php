<div class="row cuerpo">
<br>
  @if(count($notificaciones) > 0)
  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>COMPROBANTE DE PAGO</h2>
                  </div>
                
                <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                          
                          <a href="#addComprobante" id="compAdd" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top"  data-delay="500" data-tooltip="Crear comprobante">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>     
                        </div>    
  
                        @include('forms.comprobante.cliente.addComprobante')
                  </div>

              <div class="row">
                    <?php 
                      $bandera = false;

                      if (count($comprobantes) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                  
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($comprobantes) : 0; ?> registros. <br><br>
                          <table id="lstComprobante" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Documento</th>
                                     <th>F. Emisión</th>
                                     <th>F. Vencimiento</th> 
                                     <th>Total</th>
                                     <th class="center">Forma Pago</th>
                                     <th class="center">Fecha Pago</th>
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
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
                                     <td class="center">
                                      @foreach($forma_pagos as $val)
                                        @if($val->idforma_pago == $valor->idforma_pago)
                                          {{$val->descripcion}}
                                        @endif
                                      @endforeach
                                     </td>
                                     <td class="center">-</td>                                     
                                     <td>
                                      <span class="badge pink lighten-5 pink-text text-accent-2">PENDIENTE</span>
                                       
                                     </td>
                                     <td class="center" style="width: 9rem">
                                      <a id="vwFac{{$valor->codigo}}" href="#viewComprobante-{{$valor->codigo}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-codigo="{{$valor->codigo}}"><i class="material-icons" style="color: #7986cb">visibility</i></a>
                                      <a href="{{ url('/pagos/detalle') }}/{{$valor->codigo}}" class="tooltipped" data-position="top" data-delay="500" data-tooltip="Pagar"><i class="material-icons teal-text lighten-1 text-darken-2">credit_card</i></a> 
                                      <a href="#anularComprobante{{$i}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Anular"><i class="material-icons" style="color: #d84315">block</i></a>
                                      <a href="{{url('/descargarPDF')}}/{{$valor->codigo}}" target="_blank" class="tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF"><i class="material-icons grey-text text-darken-2">vertical_align_bottom</i></a>
                                     </td>
                                  </tr>
                                   @include('forms.comprobante.cliente.viewComprobante')  
                                   @include('forms.comprobante.cliente.scripts.alertaConfirmacion')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>                
                  </div>
              
        </div> 
                  
                  
    </div>
  </div> 

  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>HISTORIAL DE PAGOS</h2>
                  </div>

              <div class="row">
                    <?php 
                      $bandera = false;

                      if (count($comprobantes2) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                  
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($comprobantes2) : 0; ?> registros. <br><br>
                          <table id="lstComprobante" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Documento</th>
                                     <th>F. Emisión</th>
                                     <th>F. Vencimiento</th>                      
                                     <th>SubTotal</th>
                                     <th>Impuesto</th>
                                     <th>Total</th>
                                     <th>Forma Pago</th>
                                     <th>Fecha Pago</th>
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                            
                                      foreach ($comprobantes2 as $valor) {
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
                                     <td>{{$valor->subtotal}}</td>
                                     <td>{{$valor->impuesto}}</td>
                                     <td>{{$valor->total}}</td>
                                     <td>
                                      @foreach($forma_pagos as $val)
                                        @if($val->idforma_pago == $valor->idforma_pago)
                                          {{$val->descripcion}}
                                        @endif
                                      @endforeach
                                     </td>
                                     <td class="center">-</td>                                     
                                     <td style="width: 9rem">
                                       @if($valor->idestado == 'AN')
                                        <div class="chip center-align  grey  white-text" style="width: 70%">
                                          <b>ANULADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @elseif($valor->idestado == 'PA')
                                        <div class="chip center-align green lighten-1 white-text" style="width: 70%">
                                          <b>PAGADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a id="vwFac-{{$valor->codigo}}" href="#viewComprobante-{{$valor->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>
                                       <a href="{{url('/descargarPDF')}}/{{$valor->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF">
                                        <i class="material-icons grey-text text-darken-2">vertical_align_bottom</i></a> 
                                      
                                     </td>
                                  </tr>
                                   @include('forms.comprobante.cliente.viewComprobante')  
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>                
                  </div>
              
        </div> 
                  
                  
    </div>
  </div> 
</div>

@else
  <h5 class="center-align" style="padding-top: 20px; padding-bottom: 20px">No Existe registro de servicio</h5>    
@endif

