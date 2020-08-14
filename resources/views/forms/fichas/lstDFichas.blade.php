@extends('layouts2.app')
@section('titulo','Detalle de Fichas')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>DETALLE FICHAS</h2>
                  </div>
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">
                          <a href="#vwFichas" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Generar fichas">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>                              
                        </div>  

                      
                               
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($fichas) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0; 
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($fichas) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Descripción</th>
                                     <th>Perfil</th>
                                     <th>usuarios</th>
                                     <th>Estado</th>
                                     <th>Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($fichas as $datos) {
                                      $i++;
                                   ?>
                                     <td><?php echo $i; ?></td>                                     
                                     <td>{{$datos->idfichas}}</td>
                                     <td>{{$datos->descripcion}}</td>
                                     <td>{{$datos->idperfil}}</td>
                                     <td>{{$datos->usuarios}}</td>
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
                                       <a href="{{ url('/equipos/mostrar') }}/{{$datos->idfichas}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a>
                                       <a href="#vwGFichas" id="genFichas{{$datos->idfichas}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-id="{{$datos->idfichas}}">
                                        <i class="material-icons" style="color: black ">vertical_align_bottom</i></a>     
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
</div>

@endsection


@section('script')
  
@endsection