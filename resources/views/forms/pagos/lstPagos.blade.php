@extends('layouts2.app')
@section('titulo','Lista de Pagos Pendientes')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE PAGOS PENDIENTES</h2>
                  </div>
                
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($factura) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($factura) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th class="center">Código</th>
                                     <th>Documento</th>
                                     <th>Cliente</th>
                                     <th>Total</th>
                                     <th class="center">Fecha Emisión</th>
                                     <th class="center">Fecha Venc.</th>
                                     <th class="center">Estado</th>
                                     <th class="center">Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($factura as $datos) {
                                      $i++;
                                   ?>
                                     <td><?php echo $datos->codigo ?></td>
                                     @foreach($doc_venta as $doc)
                                     @if($doc->iddocumento == $datos->iddocumento)
                                     <td><?php echo $doc->dsc_corta.' '.$datos->serie.'-'.$datos->numero ?></td>
                                     @endif
                                     @endforeach
                                     @foreach($cliente as $val)
                                     @if($val->idcliente == $datos->idcliente)
                                     <td><?php echo $val->nombres.' '.$val->amaterno.' '.$val->apaterno ?></td>
                                     @endif  
                                     @endforeach                                   
                                     <td><?php echo $datos->total ?></td>
                                     <td class="center">{{ date_format(date_create($datos->fecha_emision),'d/m/Y') }}</td>
                                     <td class="center">{{ date_format(date_create($datos->fecha_vencimiento),'d/m/Y') }}</td>
                                     <td>
                                        @if($datos->idestado == 'EM')
                                        <div class="chip center-align red lighten-1 white-text" style="width: 80%">
                                          <b>PENDIENTE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @elseif($datos->idestado == 'PA')
                                        <div class="chip center-align green lighten-1 white-text" style="width: 80%">
                                          <b>PAGADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @elseif($datos->idestado == 'PV')
                                        <div class="chip center-align amber accent-2 white-text" style="width: 80%">
                                          <b>VERIFICANDO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @endif
                                     </td>
                                     <td class="center">
                                       <a href="{{ url('/pagos/detalle') }}/{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                      </a> 
                                      <a href="{{url('/descargarPDF')}}/{{$datos->codigo}}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF">
                                        <i class="material-icons grey-text text-darken-2">vertical_align_bottom</i>
                                      </a>
                                     </td>
                                  </tr>
                                    @include('forms.empresa.scripts.alertaConfirmacion')
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
