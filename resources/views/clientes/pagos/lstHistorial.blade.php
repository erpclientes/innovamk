@extends('layouts2.app')
@section('titulo','Historial de Pagos')

@section('main-content')
<div class="row cuerpo">
<br>

  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>HISTORIAL DE PAGOS</h2>
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
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
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
                  
                  
    </div>
  </div> 

</div>

@endsection
@include('forms.scripts.toast')

@section('script')
  @include('forms.pagos.scripts.addPago')
@endsection
