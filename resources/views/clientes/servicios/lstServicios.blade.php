@extends('layouts2.app')
@section('titulo','Registro de Servicios')

@section('main-content')

	<div class="row">
<br>
  
  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>SERVICIO DE INTERNET</h2>
                  </div>

                                                      
                  <div class="row">
                    <div class="col s12 m12 l12">                      
                        <div class="card-content">                          
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Código</th>
                                     <th>Router</th>
                                     <th>Tipo Acceso</th>
                                     <th>Perfil</th>
                                     <th>Costo</th>  
                                     <th>Fecha Pago</th>                    
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                               
                               <tbody>
                                <?php 
                                    $i = 0;
                                      foreach ($servicio as $valor) {
                                      $i++;
                                ?>
                                <tr>   
                                    <td><?php echo $i; ?></td>
                                    <td>{{$valor->idservicio}}</td>
                                    @foreach($router as $rou)
                                    @if($rou->idrouter == $valor->idrouter)
                                      <td>{{$rou->alias}}</td>
                                    @endif
                                    @endforeach
                                    @foreach($tipo as $tip)
                                    @if($tip->idrouter == $valor->idrouter and $tip->dsc_corta == $valor->tipo_acceso)
                                      <td>{{$tip->descripcion}}</td>
                                    @endif
                                    @endforeach  
                                    @foreach($perfiles as $perfil)
                                    @if($perfil->idperfil == $valor->perfil_internet)
                                      <td>{{$perfil->name}}</td>
                                    @endif
                                    @endforeach                   
                                    <td><?php echo $valor->precio ?></td>
                                    <td><?php echo $valor->dia_pago ?></td>
                                    <td style="width: 9rem">
                                    @if($valor->estado == 0)
                                    <div id="u_estado" class="chip center-align" style="width: 80%">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                    </div>
                                    @else
                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 80%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     
                                     <td class="center" style="width: 9rem">
                                       <a href="{{ url('/servicio/mostrar') }}/{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                      
                                     </td>
                                  </tr>
                                  <?php } ?>
                               </tbody>
                            </table>
                          </div> <br>                   
                  </div>

                </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>EQUIPOS</h2>
                  </div>

                  <div class="row">
                    <div class="col s12 m12 l12">                      
                        <div class="card-content">
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Equipo</th>
                                     <th>Marca</th>
                                     <th>Modelo</th>
                                     <th>Modo</th>  
                                     <th>IP</th>                    
                                     <th>Estado</th>
                               
                                  </tr>
                               </thead>
                              
                               

                               <tbody>
                                <?php 
                                    $i=0;
                                      foreach ($dequipos as $equipo) {
                                      $i++;
                                ?>
                                <tr>   
                                    <td>{{$i}}</td>
                                    <td>{{$equipo->descripcion}}</td>
                                    <td>{{$equipo->marca}}</td>
                                    <td>{{$equipo->modelo}}</td>
                                    <td>{{$equipo->modo}}</td>
                                    <td>{{$equipo->ip}}</td>
                                    <td>
                                    @if($equipo->idestado == 'AS')
                                      <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ASIGNADO</b>
                                          <i class="material-icons"></i>
                                      </div>
                                    @else
                                      <div id="u_estado" class="chip center-align" style="width: 70%">
                                            <b>SIN ASIGNAR</b>
                                          <i class="material-icons"></i>
                                      </div>                                        
                                    @endif
                                    </td>
                                     
                                    
                                  </tr>
                                  
                                  <?php } ?>
                               </tbody>
                            </table>
                           
                          </div> <br>                   
                  </div>

                </div>

    </div>
  </div>
</div>
      




<br><br><br>
@endsection


