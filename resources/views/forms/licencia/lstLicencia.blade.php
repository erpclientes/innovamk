@extends('layouts2.app')
@section('titulo','Lista de empresas')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE LICENCIAS</h2>
                  </div>
                 
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/licencia/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          <a style="margin-left: 6px"></a>                          
                                                          
                        </div>  
                        @include('forms.scripts.modalInformacion')         
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($licencia) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($licencia) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Descripción</th>
                                     <th>Licencia</th>
                                     <th>Periodo</th>
                                     <th>Descuento</th>
                                     <th>Costo</th>
                                     <th class="center">Fecha creación</th>
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
                                      foreach ($licencia as $datos) {
                                      $i++;
                                   ?>
                                     <td class="center">{{$i}}</td>
                                     <td>
                                      @foreach($tipo as $val)
                                      @if($val->idtipo == $datos->idtipo_lic)
                                        {{$val->descripcion}}
                                      @endif
                                      @endforeach
                                     </td>
                                     <td>{{$datos->codigo}}</td>
                                     <td class="center">{{($datos->meses == 1)? $datos->meses.' mes' : $datos->meses.' meses'}}</td>
                                     <td class="center">{{$datos->descuento}}</td>
                                     <td class="center">{{$datos->total}}</td>
                                     <td class="center">{{date_format(date_create($datos->fecha_creacion),'d/m/Y')}}</td>
                                     <td>
                                        @if($datos->estado == 0)
                                        <div id="u_estado" class="chip center-align  grey darken-2 white-text" style="width: 70%">
                                            <b>CADUCADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @elseif($datos->estado == 1)
                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @elseif($datos->estado == 2)
                                        <div id="u_estado2" class="chip center-align blue darken-2 white-text" style="width: 70%">
                                          <b>ASIGNADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                        @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a href="{{ url('/liciencia/mostrar') }}/{{$datos->idlicencia}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                      </a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i>
                                      </a>
                                      @if($datos->estado == 1)                                      
                                       <a href="#h_confirmacion2{{$datos->idlicencia}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#h_confirmacion3{{$datos->idlicencia}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
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
