@extends('layouts2.app')
@section('titulo','Lista Pool de IPs')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE IP POOL</h2>
                  </div>
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">
                          <a href="#vwIpPool" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Generar fichas">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>                              
                        </div>  

                      @include('forms.poolIp.addPool')
                      @include('forms.poolIp.updPool')
                               
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($pool) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($pool) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Descripción</th>
                                     <th>Rango</th>
                                     <th>Fecha Creación</th>
                                     <th>Estado</th>
                                     <th class="center">Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($pool as $datos) {
                                      $i++;
                                   ?>
                                     <td><?php echo $i; ?></td>                                     
                                     <td>{{$datos->idrouter}}</td>
                                     <td>{{$datos->descripcion}}</td>
                                     <td>{{$datos->ip_inicial.' - '.$datos->ip_final}}</td>
                                     <td>{{$datos->fecha_creacion}}</td>
                                     <td>
                                        @if($datos->estado == 0)
                                        <div id="u_estado" class="chip center-align" style="width: 70%">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a href="#updIpPool" id="updPool{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-codigo="{{$datos->codigo}}" data-idrouter="{{$datos->idrouter}}" data-descripcion="{{$datos->descripcion}}" data-ip_inicial="{{$datos->ip_inicial}}" data-ip_final="{{$datos->ip_final}}" data-glosa="{{$datos->glosa}}" data-estado="{{$datos->estado}}">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#confirmacion{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a>                                       
                                     </td>
                                  </tr>
                                  @include('forms.poolIp.scripts.alertaConfirmacion')

                                    
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

@endsection

  
@section('script')
@include('forms.scripts.toast')
  @include('forms.poolIp.scripts.addPool')
  @include('forms.poolIp.scripts.updPool')
  @include('forms.poolIp.scripts.delPool')
  @include('forms.poolIp.scripts.validacion')
@endsection