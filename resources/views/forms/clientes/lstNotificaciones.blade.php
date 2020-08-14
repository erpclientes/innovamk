@extends('layouts2.app2')
@section('titulo','Lista de Notificaciones')

@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row">
  
  <div class="col s12 m12 l12">
                <?php 
                      $bandera = false;

                      if (count($notificaciones) > 0) {
                        $bandera = true;
                        $i = 0;
                      }
                ?>
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2><b>LISTA DE NOTIFICACIONES |</b> <i style="color: #3f51b5">Existen <?php echo ($bandera)? count($notificaciones) : 0; ?> registros.</i></h2>
                  </div>
                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/clientes/exportExcel') }}" data-position="top" data-delay="500" data-tooltip="Descargar excel">
                            <i class="material-icons" style="color: black">vertical_align_bottom</i></a>
                        </div>  
                        
                        @include('forms.clientes.frmCorte')       
                  </div>
                                    
                  <div class="row cuerpo">
                    
                  
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th class="center">#</th>
                                     <th>Router</th>
                                     <th>Cliente</th>
                                     <th>Plan internet</th>
                                     <th>Día de pago</th>
                                     <th>Fecha de corte</th>
                                     <th class="center" style="width: 70px">Estado</th>
                                     <th class="center">Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($notificaciones as $datos) {
                                      $i++;
                                   ?>
                                     <td class="center">{{$i}}</td>
                                     <td>{{ $datos->alias }}</td>
                                     <td>{{ $datos->razon_social }}</td>
                                     <td>{{ $datos->name }}</td>
                                     <td class="center">{{ $datos->dia_pago }}</td>
                                     <td>
                                      @foreach($factura as $fac)
                                      @if($fac->idservicio == $datos->idservicio and $fac->idestado == 'EM')
                                        {{ $fac->fecha_corte }}
                                      @endif
                                      @endforeach
                                    </td>
                                     <td class="center">
                                      @if($datos->activar_notificacion == 0)
                                        <span class="badge grey darken-2 white-text text-accent-5">INACTIVO</span>
                                      @elseif($datos->activar_notificacion == 1)
                                        <span class="badge green lighten-5 green-text text-accent-4">AVISO</span>      
                                      @elseif($datos->activar_notificacion == 2)
                                        <span class="badge red lighten-5 red-text text-accent-4">CORTADO</span>                                        
                                      @endif
                                     </td>
                                     <td class="center" style="width: 100px">                                      
                                      @if($datos->activar_notificacion == 1)                             
                                      <a href="#confirmacion6{{$datos->idservicio}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Aplicar corte"><i class="material-icons red-text text-lighten-2">not_interested</i></a>         
                                      @elseif($datos->activar_notificacion == 2) 
                                      <a href="#confirmacion5{{$datos->idservicio}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Aplicar aviso"><i class="material-icons  green-text text-lighten-2">add_alarm</i></a>
                                      @endif     
                                      <a href="#confirmacion7{{$datos->idservicio}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Restablecer"><i class="material-icons" style="color: #7986cb">autorenew</i></a>     
                                      <a href="{{ url('/cliente') }}/{{$datos->idcliente}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ir a comprobantes" target="_blank"><i class="material-icons" style="color: #43a047">attach_file</i></a>                                
                                     </td>
                                  </tr>
                                  @include('forms.clientes.scripts.alertaConfirmacion5')
                                  @include('forms.clientes.scripts.alertaConfirmacion6')
                                  @include('forms.clientes.scripts.alertaConfirmacion7')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>
                    
                  </div>

                  </div>
                </div>
              </div>
            </div>
</div>
<br><br>

@endsection
@section('script')
  @include('forms.clientes.scripts.notificaciones')
@endsection

