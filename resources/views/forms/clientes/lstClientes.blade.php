@extends('layouts2.app')
@section('titulo','Lista de Clientes')

@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row">
  @include('forms.clientes.indicadores')
  <div class="col s12 m12 l12">
                <?php 
                //dd("paso");
                      $bandera = false;

                      if (count($clientes) > 0) {
                        $bandera = true;
                        $i = 0;
                      }
                ?>
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2><b>LISTA DE CLIENTES |</b> <i style="color: #3f51b5">
                      Existen <?php echo ($bandera)? count($clientes): 0; ?> registros.</i></h2>
                  </div>
                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/clientes/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/avisos') }}" data-position="top" data-delay="500" data-tooltip="Avisos pendientes">
                            <i class="material-icons green-text text-lighten-2">add_alarm</i></a>
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" id="corte" href="#vwCorte" data-position="top" data-delay="500" data-tooltip="Cortes pendientes">
                            <i class="material-icons red-text text-lighten-2">not_interested</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/generarComprobante') }}" data-position="top" data-delay="500" data-tooltip="Generar comprobantes masivos">
                            <i class="material-icons light-blue-text text-lighten-2">note</i></a>
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/clientes/exportExcel') }}" data-position="top" data-delay="500" data-tooltip="Descargar excel">
                            <i class="material-icons" style="color: black">vertical_align_bottom</i></a>
                        </div>  
                        @include('forms.scripts.modalInformacion')  
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
                                     <th>Cod. Cliente</th>
                                     <th>Razón Social</th>
                                     <th>Dirección</th>
                                     <th class="center">IP</th>
                                     <th class="center">Día Pago</th>
                                     <th class="center">Importe</th>
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
                                      foreach ($clientes as $datos) {
                                      $i++;
                                      if( $datos->estado != 5 || $datos->estado != 3 ){
                                      
                                   ?>
                                     <td class="center">{{ $i }}</td>
                                     <td>{{ $datos->idcliente  }}</td>
                                     <td>
                                       @if(is_null($datos->razon_social) or empty($datos->razon_social))
                                          {{$datos->apaterno.' '.$datos->amaterno.' '.$datos->nombres}}
                                       @else
                                          {{$datos->razon_social}}
                                       @endif
                                     </td>
                                     <td><?php echo $datos->direccion ?></td>
                                     <td>{{$datos->ip}}</td>
                                     <td class="center">{{$datos->dia_pago}}</td>
                                     <td class="center">{{$datos->precio}}</td>
                                     <td class="center">
                                      @if($datos->estado == 0)
                                        <span class="badge grey darken-2 white-text text-accent-5">INACTIVO</span>
                                      @elseif($datos->estado == 1)
                                        <span class="badge green lighten-5 green-text text-accent-4">ACTIVO</span>      
                                      @elseif($datos->estado == 2)
                                        <span class="badge amber lighten-5 amber-text text-accent-4">EXONERADO</span>                                        
                                      @endif
                                     </td>
                                     <td class="center" style="width: 110px">
                                      <a href="{{ url('/cliente/') }}/{{$datos->idcliente}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Editar"><i class="material-icons" style="color: #7986cb">edit</i></a>
                                      <a href="#confirmacion{{$i}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar"><i class="material-icons" style="color: #dd2c00">remove</i></a>
                                      @if($datos->estado == 1)                             
                                      <a href="#confirmacion2{{$datos->idcliente}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Deshabilitar"><i class="material-icons" style="color: #757575">clear</i></a>         
                                      @else
                                      <a href="#confirmacion3{{$datos->idcliente}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar"><i class="material-icons" style="color: #66bb6a">check</i></a>
                                      @endif
                                      <a href="#confirmacion4{{$datos->idcliente}}" class="tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Exonerar pago"><i class="material-icons" style="color: #81d4fa">layers_clear</i></a>   
                                     </td>
                                  </tr>
                                    @include('forms.clientes.scripts.alertaConfirmacion')
                                    @include('forms.clientes.scripts.alertaConfirmacion2')
                                    @include('forms.clientes.scripts.alertaConfirmacion3')
                                    @include('forms.clientes.scripts.alertaConfirmacion4')
                                  <?php }}} ?>
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
  @include('forms.clientes.scripts.desabilitar')
  @include('forms.clientes.scripts.habilitar')
  @include('forms.clientes.scripts.corteMorosos')
  @include('forms.clientes.scripts.exonerar')
@endsection
@include('forms.scripts.toast')
